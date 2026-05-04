<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

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

    // email reset de senha
    public function sendPasswordResetNotification($token)
    {
        $url = url(route('password.reset', [
            'token' => $token,
            'email' => $this->email,
        ], false));

        Mail::to($this->email)
            ->send(new ResetPasswordMail($url, $this));
    }






    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
