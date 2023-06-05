<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'email',
        'surname',
        'name',
        'lastname',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // получить фио
    public function getName()
    {
        if($this->surname && $this->name && $this->lastname)
        {
            return "{$this->surname} {$this->name} {$this->lastname}";
        }

        if($this->surname && $this->name)
        {
            return "{$this->surname} {$this->name}";
        }
    }

    // получить книги пользователя
    public function books()
    {
        return $this->hasMany('App\Models\Book', 'user_id');
    }

    // получить читателей
    public function readerOfMine()
    {
        return $this->belongsToMany('App\Models\User', 'readers', 'user_id', 'reader_id');
    }

    public function readerOf()
    {
        return $this->belongsToMany('App\Models\User', 'readers', 'reader_id', 'user_id');
    }

}
