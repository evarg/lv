<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code_alpha_2', 'code_alpha_3', 'code_numeric'
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
