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

    public function __construct($image, $thumbConfig)
    {
        $this->image = $thumbConfig['image'];
        $this->width = $thumbConfig['width'];
        $this->height = $thumbConfig['height'];
        $this->crop = $thumbConfig['crop'];
        $this->name = $thumbConfig['name'];
    }

    public function save()
    {
        $this->image->resize(1600, 1200, function ($constraint) {
            if ($this->crop) {
                $constraint->upsize();
            }
        });
        $this->image->save($this->name);
    }

    public static function getName($fileName, $filePattern)
    {
    }
}
