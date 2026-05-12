<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use App\Models\Caregiver;

class SlugHelper
{
    // formata
    public static function format(string $value): string
    {
        return Str::slug(trim($value));
    }

    // slug unico
    public static function generateUnique(string $value, ?int $ignoreId = null): string
    {
        $baseSlug = self::format($value);

        $slug = $baseSlug;
        $counter = 1;

        while (
            Caregiver::where('slug', $slug)
            ->when($ignoreId, function ($query) use ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            })
            ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    // ve se ta disponivel
    public static function isAvailable(string $slug, ?int $ignoreId = null): bool
    {
        return !Caregiver::where('slug', self::format($slug))
            ->when($ignoreId, function ($query) use ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            })
            ->exists();
    }
}
