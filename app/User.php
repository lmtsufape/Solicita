<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use Notifiable;

    // public function sendEmailVerificationNotification()
    // {
    //       $this->notify(new App\Notifications\VerificarEmail);
    // }
    // Enviar email traduziado
    // public function sendEmailVerificationNotification()
    // {
    //     // $this->notify(new App\Notifications\CustomVerifyEmail);
    // }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tipo',
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


    public function administrador(){
        return $this->hasOne('App\Administrador');
    }
    public function servidor(){
        return $this->hasOne('App\Servidor');
    }
    public function aluno(){
        return $this->hasOne('App\Aluno');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    
}
