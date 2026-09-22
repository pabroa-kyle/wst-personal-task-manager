<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected function casts(): array
    {
        return [
            'due_date' => 'date',
        ];
    }

    protected $fillable = [
        'task_name',
        'description',
        'status',
        'priority',
        'due_date',
    ];
}
