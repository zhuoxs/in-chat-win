<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
            'setting_id',
            'keyword',
            'message',
            'is_default',
            'user_id'
    ];

    protected $casts = [
        'message' => 'json',
        'is_default' => 'boolean',
    ];

    public function setting ()
    {
        return $this->belongsTo(Settings::class , 'setting_id');
    }

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

}
