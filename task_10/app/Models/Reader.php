<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    protected $fillable = [
        'user_id',
        'reader_id'
    ];

    public function userR()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
