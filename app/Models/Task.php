<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    const PRIORITY_LOW = 'LOW';
    const PRIORITY_MEDIUM = 'MEDIUM';
    const PRIORITY_HIGH = 'HIGH';

    const STATE_OPEN = 'OPEN';
    const STATE_CLOSE = 'CLOSE';
    const STATE_REJECTED = 'REJECTED';
    const STATE_TO_DO = 'TO_DO';
    const STATE_IN_PROGRESS = 'IN_PROGRESS';
    const STATE_TESTING = 'TESTING';
    const STATE_DONE = 'DONE';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'priority',
        'state',
        'due_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'category_id' => 'integer',
        'due_date' => 'datetime',
    ];

    /**
     * Get the category info.
     */
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
