<?php

namespace App\Uploader;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Interface UploaderInterface
 * @package App\Uploader
 */
interface UploaderInterface
{
    /**
     * @param UploadedFile $file
     * @return string
     */
    public function upload(UploadedFile $file): string;
}
