<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Thumbnail
{
    private $image;
    private $width;
    private $height;
    private $crop;
    private $name;

    public function __construct($image, $width, $height, $name, $crop) {
        $this->image = $image;
        $this->width = $width;
        $this->height = $height;
        $this->crop = $crop;
        $this->name = $name;
    }

    public function save()
    {
        $this->image->resize(1600, 1200, function ($constraint) {
            $constraint->upsize();
        });
        $this->image->save($this->name);

    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
