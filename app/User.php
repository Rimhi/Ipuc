<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apellido', 'email', 'password', 'cedula', 'direccion', 'telefono', 'fecha_nacimiento', 'fecha_bautismo',
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

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function departamento(){
        return $this->belongsToMany(Departamento::class,'assigned_departamento')->withPivot('cargo');
    }
    
    public function hasRole(array $roles){
        foreach ($roles as $role) {
            foreach ($this->departamento as $userRole) {
                if ($userRole->pivot->cargo === $role) {
                    return true;
                }
            }
           
        }
        return false;
    }
    public function estado(){
        return $this->hasOne(Estado::class);
    }
   
}
