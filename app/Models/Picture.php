<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $table = 'pictures';

    protected $fillable = ['name', 'desc'];

    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
