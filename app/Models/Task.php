<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'task_name',
        'description',
        'status',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function getIsCompletedAttribute(): bool
    {
        return $this->status === 'Completed';
    }

    public function getIsPendingAttribute(): bool
    {
        return $this->status === 'Pending';
    }

    public function toggleStatus(): void
    {
        $this->status = $this->is_completed ? 'Pending' : 'Completed';
        $this->save();
    }
}