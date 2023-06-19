<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Address extends Model
{
    use HasFactory;

    public function country() : BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
