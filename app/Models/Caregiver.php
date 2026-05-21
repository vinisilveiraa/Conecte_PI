<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Caregiver extends Model
{
    protected $fillable =
    [
        'user_id',
        'slug',
        'public_code',
        'coren',
        'certificado_cuidador',
        'headline',
        'bio',
        'experience_years',
        'hour_price',
        'available_morning',
        'available_afternoon',
        'available_night',
        'available_weekends',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function specialties(): BelongsToMany
    {
        return $this->belongsToMany(
            Specialty::class,
            'caregiver_specialty',
        )->withPivot('preco_minimo')
            ->withTimestamps();
    }

    public function proposals(): HasMany
    {
        return $this->hasMany(Proposal::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function avgReviews()
    {
        return round($this->reviews()->avg('rating'), 1);
    }

    // faz uma conta do c*ralho pra pega cuidadores por perto usando latitude e longitude
    public static function getNearby($lat, $lng, $radius = null)
    {
        $query = DB::table('caregivers')
            ->join('users', 'caregivers.user_id', '=', 'users.id')
            ->join('addresses', 'users.id', '=', 'addresses.user_id')
            ->selectRaw("
            caregivers.*,
            users.nome,
            addresses.latitude,
            addresses.longitude,
            (6371 * acos(
                cos(radians(?)) *
                cos(radians(addresses.latitude)) *
                cos(radians(addresses.longitude) - radians(?)) +
                sin(radians(?)) *
                sin(radians(addresses.latitude))
            )) AS distance
        ", [$lat, $lng, $lat])
            ->whereNotNull('addresses.latitude');

        if ($radius) {
            $query->having('distance', '<=', $radius);
        }

        return $query->orderBy('distance');
    }
}
