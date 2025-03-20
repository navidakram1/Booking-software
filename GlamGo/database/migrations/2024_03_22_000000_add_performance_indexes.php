<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        $this->addIndexIfNotExists('bookings', ['created_at', 'status']);
        $this->addIndexIfNotExists('bookings', ['start_time', 'end_time', 'status']);
        $this->addIndexIfNotExists('bookings', ['service_id', 'status']);
        $this->addIndexIfNotExists('bookings', ['specialist_id', 'status']);
        $this->addIndexIfNotExists('bookings', ['total_price']);
        $this->addIndexIfNotExists('bookings', ['scheduled_at']);

        $this->addIndexIfNotExists('services', ['is_active', 'created_at']);
        $this->addIndexIfNotExists('services', ['category_id']);
        $this->addIndexIfNotExists('services', ['price']);

        $this->addIndexIfNotExists('staff', ['is_active', 'created_at']);
        $this->addIndexIfNotExists('staff', ['name']);
        $this->addIndexIfNotExists('staff', ['position']);

        $this->addIndexIfNotExists('customers', ['is_active', 'created_at']);
        $this->addIndexIfNotExists('customers', ['name']);
        $this->addIndexIfNotExists('customers', ['phone']);
    }

    public function down()
    {
        $this->dropIndexIfExists('bookings', ['created_at', 'status']);
        $this->dropIndexIfExists('bookings', ['start_time', 'end_time', 'status']);
        $this->dropIndexIfExists('bookings', ['service_id', 'status']);
        $this->dropIndexIfExists('bookings', ['specialist_id', 'status']);
        $this->dropIndexIfExists('bookings', ['total_price']);
        $this->dropIndexIfExists('bookings', ['scheduled_at']);

        $this->dropIndexIfExists('services', ['is_active', 'created_at']);
        $this->dropIndexIfExists('services', ['category_id']);
        $this->dropIndexIfExists('services', ['price']);

        $this->dropIndexIfExists('staff', ['is_active', 'created_at']);
        $this->dropIndexIfExists('staff', ['name']);
        $this->dropIndexIfExists('staff', ['position']);

        $this->dropIndexIfExists('customers', ['is_active', 'created_at']);
        $this->dropIndexIfExists('customers', ['name']);
        $this->dropIndexIfExists('customers', ['phone']);
    }

    private function addIndexIfNotExists($table, $columns)
    {
        $indexName = $this->getIndexName($table, $columns);
        
        // Check if index exists
        $indexExists = collect(DB::select("SHOW INDEXES FROM {$table}"))->pluck('Key_name')->contains($indexName);
        
        if (!$indexExists) {
            Schema::table($table, function (Blueprint $table) use ($columns) {
                $table->index($columns);
            });
        }
    }

    private function dropIndexIfExists($table, $columns)
    {
        $indexName = $this->getIndexName($table, $columns);
        
        // Check if index exists
        $indexExists = collect(DB::select("SHOW INDEXES FROM {$table}"))->pluck('Key_name')->contains($indexName);
        
        if ($indexExists) {
            Schema::table($table, function (Blueprint $table) use ($columns) {
                $table->dropIndex($columns);
            });
        }
    }

    private function getIndexName($table, $columns)
    {
        $columns = (array) $columns;
        return $table . '_' . implode('_', $columns) . '_index';
    }
}; 