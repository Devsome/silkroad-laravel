<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    const TODO_PROGRESS = 'progress';
    const TODO_DONE = 'done';

    protected $fillable = [
        'user_id', 'body', 'state'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getUserName()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
