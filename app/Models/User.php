<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'name',
        'surname',
        'date_of_birth',
        'motto',
        'description',
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
        'date_of_birth' => 'date:Y-m-d'
    ];

    protected $dates = [
        'deleted_at',
    ];

    const LEVEL_USER = 0;
    const LEVEL_ADMIN = 1;


    public function isAdmin()
    {
        return $this->level == User::LEVEL_ADMIN;
    }

    /**
     * Restituisce la label del livello utente
     *
     * @return void
     */
    public function getLevelLabelAttribute()
    {
        switch ($this->level){
            case self::LEVEL_ADMIN:
                return 'Amministratore';
            break;
            case self::LEVEL_USER:
            default:
                return 'Utente';
            break;
        }
    }
}
