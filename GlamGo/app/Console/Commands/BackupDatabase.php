<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class BackupDatabase extends Command
{
    protected $signature = 'db:backup {--filename= : Custom filename for the backup}';
    protected $description = 'Create a backup of the database';

    protected $backupPath = 'backups/database';
    protected $keepBackups = 7; // Number of backups to keep

    public function handle()
    {
        try {
            // Create backup filename
            $filename = $this->option('filename') ?? 'backup_' . Carbon::now()->format('Y-m-d_H-i-s') . '.sql';
            
            // Ensure backup directory exists
            if (!Storage::exists($this->backupPath)) {
                Storage::makeDirectory($this->backupPath);
            }

            // Get database configuration
            $host = Config::get('database.connections.mysql.host');
            $database = Config::get('database.connections.mysql.database');
            $username = Config::get('database.connections.mysql.username');
            $password = Config::get('database.connections.mysql.password');

            // Build backup command
            $command = sprintf(
                'mysqldump -h %s -u %s -p%s %s > %s',
                escapeshellarg($host),
                escapeshellarg($username),
                escapeshellarg($password),
                escapeshellarg($database),
                storage_path('app/' . $this->backupPath . '/' . $filename)
            );

            // Execute backup
            exec($command, $output, $returnVar);

            if ($returnVar !== 0) {
                throw new \Exception('Database backup failed');
            }

            // Cleanup old backups
            $this->cleanOldBackups();

            $this->info('Database backup completed successfully: ' . $filename);
            Log::info('Database backup created', ['filename' => $filename]);

            return 0;
        } catch (\Exception $e) {
            $this->error('Backup failed: ' . $e->getMessage());
            Log::error('Database backup failed', ['error' => $e->getMessage()]);
            return 1;
        }
    }

    protected function cleanOldBackups()
    {
        $files = Storage::files($this->backupPath);
        if (count($files) > $this->keepBackups) {
            $oldFiles = collect($files)
                ->sortByDesc(function ($file) {
                    return Storage::lastModified($file);
                })
                ->slice($this->keepBackups);

            foreach ($oldFiles as $file) {
                Storage::delete($file);
                Log::info('Deleted old backup file', ['file' => $file]);
            }
        }
    }
} 