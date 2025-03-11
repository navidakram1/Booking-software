<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StaffSchedule extends Model
{
    protected $fillable = [
        'staff_id',
        'day_of_week',
        'start_time',
        'end_time',
        'break_times',
        'is_working_day'
    ];

    protected $casts = [
        'day_of_week' => 'integer',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'break_times' => 'array',
        'is_working_day' => 'boolean'
    ];

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function isAvailable(\DateTime $dateTime): bool
    {
        if (!$this->is_working_day || $dateTime->format('w') != $this->day_of_week) {
            return false;
        }

        $time = $dateTime->format('H:i');
        if ($time < $this->start_time || $time > $this->end_time) {
            return false;
        }

        foreach ($this->break_times ?? [] as $break) {
            if ($time >= $break['start'] && $time <= $break['end']) {
                return false;
            }
        }

        return true;
    }

    public function getWorkingHours(): array
    {
        $hours = [];
        $start = strtotime($this->start_time);
        $end = strtotime($this->end_time);

        while ($start <= $end) {
            $timeSlot = date('H:i', $start);
            $isBreak = false;

            foreach ($this->break_times ?? [] as $break) {
                if ($timeSlot >= $break['start'] && $timeSlot <= $break['end']) {
                    $isBreak = true;
                    break;
                }
            }

            if (!$isBreak) {
                $hours[] = $timeSlot;
            }

            $start = strtotime('+30 minutes', $start);
        }

        return $hours;
    }

    public function getDayName(): string
    {
        return [
            'Sunday', 'Monday', 'Tuesday', 'Wednesday',
            'Thursday', 'Friday', 'Saturday'
        ][$this->day_of_week];
    }
} 