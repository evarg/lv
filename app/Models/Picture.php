<?php

namespace App\Models;

use App\Models\Enums\PictureSize;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Picture extends Model
{
    use HasFactory;

    protected $table = 'pictures';

    protected $fillable = ['name', 'desc'];

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function getPattern($withPath = true)
    {
        $pattern = Storage::disk('public')->path('images\\' . $this->hash_name . '%s.jpg');

        return $pattern;
    }

    public function getFileNameBySizeEnum($pictureSize = PictureSize::SIZE_ORG)
    {
        return sprintf($this->getPattern(), config('picture.thumbs'.$pictureSize.'suffix'));
    }

    public function getFileNameBySuffix(string $fileNameSuffix)
    {
        return sprintf($this->getPattern(), $fileNameSuffix);
    }

}
