<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
     protected $table = 'users';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cpf',
        'rg',
        'password',
        'foto',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }

    public function caregiver(): HasOne
    {
        return $this->hasOne(Caregiver::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function avaliacao_feita(): HasMany
    {
        return $this->hasMany(Review::class, 'revisor_id');
    }

    public function avaliacao_recebida(): HasMany
    {
        return $this->hasMany(Review::class, 'revisado_id');
    }









    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
