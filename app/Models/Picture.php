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

    public function getFileName($pictureSize = PictureSize::SIZE_ORG)
    {
        $pattern = Storage::disk('public')->path('images\\' . $this->hash_name . '%s.jpg');
        switch ($pictureSize) {
            case PictureSize::SIZE_ORG:
                return sprintf($pattern,'_org');
            case PictureSize::SIZE_RX:
                return sprintf($pattern, '_rx');
            case PictureSize::SIZE_RL:
                return sprintf($pattern, '_rl');
            case PictureSize::SIZE_RM:
                return sprintf($pattern, '_rm');
            case PictureSize::SIZE_RS:
                return sprintf($pattern, '_rs');
            case PictureSize::SIZE_SX:
                return sprintf($pattern, '_sx');
            case PictureSize::SIZE_SL:
                return sprintf($pattern, '_sl');
            case PictureSize::SIZE_SM:
                return sprintf($pattern, '_sm');
            case PictureSize::SIZE_SS:
                return sprintf($pattern, '_ss');
        }
    }
}
