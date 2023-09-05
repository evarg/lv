<?php

namespace App\Services;

use App\Models\Enums\PictureSize;
use App\Models\File;
use App\Models\Picture;
use App\Models\Thumbnail;
use App\Interfaces\ErrorMessageInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as ImageManager;
use RuntimeException;

use function PHPSTORM_META\type;

class PictureService implements ErrorMessageInterface
{
    protected $user;
    protected $request;
    protected string $errorMessage = '';
    protected \Illuminate\Filesystem\FilesystemAdapter $storage;
    protected string $folder;
    protected $thumbnailsAvaiable;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->storage = $this->getStorage();
        $this->folder = 'images';
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function setErrorMessage(string $message): void
    {
        $this->errorMessage = $message;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function createAndStoreThumbnails()
    {
        foreach (config('packet.thumbs') as $thumbConfig) {
            var_dump($thumbConfig);
        }
    }

    protected function getStorage(): \Illuminate\Filesystem\FilesystemAdapter
    {
        return Storage::disk('public');
    }

    protected function saveOrginal($request)
    {
    }

    private function storeUploadFile($fileUpload): ?array
    {
        try {
            $fileName = $this->storage->putFile($this->folder, $fileUpload);
            return [
                'fileName' => $fileName,
                'orginalName' => $fileUpload->getClientOriginalName(),
                'mimeType' => $fileUpload->getClientMimeType(),
                'size' => $fileUpload->getSize(),
            ];
        } catch (RuntimeException $e) {
            $this->setErrorMessage($e->getMessage());
            return null;
        }
    }

    private function createDbRecord(array $file): ?Picture
    {
        $image = ImageManager::make($this->getStorage()->path($file['fileName']));
        $picture = new Picture($this->request->all());
        $picture->size = $file['size'];
        $picture->orginal_name = $file['orginalName'];
        $picture->hash_name = 'hasshh';
        $picture->mime_type = $file['mimeType'];
        $picture->width = $image->height();
        $picture->height = $image->width();
        $picture->creator()->associate(Auth::user());
        $picture->save();
        return $picture;
    }

    private function thumbnailFileName(string $pictureFileName, PictureSize $pictureSize, bool $absolutePath = false): string
    {
        $pattern = config('packet.thumbs.' . $pictureSize . '.file_name');

        return
            sprintf($pattern, pathinfo($pictureFileName, PATHINFO_FILENAME), pathinfo($fileName, PATHINFO_EXTENSION));
    }

    private function thumbnailFileNameWithPath(string $pattern, string $fileName): string
    {
        return
            $this->getStorage()->path($this->folder) .
            DIRECTORY_SEPARATOR .
            sprintf($pattern, pathinfo($fileName, PATHINFO_FILENAME), pathinfo($fileName, PATHINFO_EXTENSION));
    }

    private function createThumbnails(string $fileName)
    {
        foreach (config('packet.thumbs_avaiable') as $thumb) {
            $image = ImageManager::make($this->storage->path($fileName));
            $thumbConfig = config('packet.thumbs.' . $thumb);
            $image->resize($thumbConfig['width'], $thumbConfig['height'], function ($constraint) use ($thumbConfig) {
                if ($thumbConfig['crop']) {
                    $constraint->upsize();
                }
            });
            $image->save($this->thumbnailFileNameWithPath($thumbConfig['file_name'], $fileName));
        }
        return true;
    }

    public function storeOne()
    {
        $uploadedFile = $this->storeUploadFile($this->request->file('picture'));
        if (!$uploadedFile) {
            return null;
        }

        $createdTuhumbnails = $this->createThumbnails($uploadedFile['fileName']);
        if (!$createdTuhumbnails) {
            return null;
        }

        $picture = $this->createDbRecord($uploadedFile);

        return $picture;
    }

    public function createAndStoreThumbnail(int $width, int $height, bool $ratio, string $fileName)
    {
    }

    public function update(File $file, Request $request): File
    {
        $file->fill($request->all());
        $fileUpload = $request->file('file');
        if ($fileUpload) {
            if (Storage::exists($file->hash_name)) {
                Storage::delete($file->hash_name);
            }
            $fileName = Storage::putFile('uploads', $fileUpload);
            $file->hash_name = $fileName;
            $file->orginal_name = $fileUpload->getClientOriginalName();
            $file->size = $fileUpload->getSize();
            $file->mime_type = $fileUpload->getClientMimeType();
        }
        $file->save();
        return $file;
    }

    public function delete(File $file)
    {
        if (Storage::exists($file->hash_name)) {
            Storage::delete($file->hash_name);
        }
        $file->delete();
    }
}
