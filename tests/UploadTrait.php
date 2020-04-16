<?php

namespace App\Tests;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Trait UploadTrait
 * @package App\Tests
 */
trait UploadTrait
{
    /**
     * @return UploadedFile
     * @throws \Exception
     */
    public static function createTextFile(): UploadedFile
    {
        $filename = md5(random_bytes(10)) . ".txt";

        copy(__DIR__ . '/../public/uploads/file.txt', __DIR__ . '/../public/uploads/' . $filename);

        return new UploadedFile(
            __DIR__ . '/../public/uploads/' . $filename,
            $filename,
            null,
            null,
            true
        );
    }

    /**
     * @return UploadedFile
     * @throws \Exception
     */
    public static function createImage(): UploadedFile
    {
        $filename = md5(random_bytes(10)) . ".png";

        copy(__DIR__ . '/../public/uploads/image.png', __DIR__ . '/../public/uploads/' . $filename);

        return new UploadedFile(
            __DIR__ . '/../public/uploads/' . $filename,
            $filename,
            null,
            null,
            true
        );
    }
}
