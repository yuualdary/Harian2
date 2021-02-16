<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected static function boot(){
        static::creating(function ($model){
            if (! $model->getKey()){
                $model->{$model->getKeyName()}=(string) Str::uuid();//str adalah helper uuid
            }
        });

     }

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'authtoken',
    ];

    public function roleuser(){

        return $this->hasOne(roleuser::class);
        

    }

    public function otp_codes(){

        return $this->hasOne(otp_codes::class);
        

    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getIncrementing()
    {
        return false;
    }
    

    public function getKeyType()
    {
        return 'string';
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
