<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Address extends Model
{
    use HasFactory;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
