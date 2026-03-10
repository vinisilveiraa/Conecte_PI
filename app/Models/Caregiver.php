<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caregiver extends Model
{
    protected $fillable = ['user_id', 'coren', 'certificado_cuidador', 'bio', 'rating', 'verified'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
