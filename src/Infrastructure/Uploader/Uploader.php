<?php

namespace App\Infrastructure\Uploader;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * Class Uploader
 * @package App\Infrastructure\Uploader
 */
class Uploader implements UploaderInterface
{
    /**
     * @var SluggerInterface
     */
    private SluggerInterface $slugger;

    /**
     * @var string
     */
    private string $uploadsAbsoluteDir;

    /**
     * @var string
     */
    private string $uploadsRelativeDir;

    /**
     * Uploader constructor.
     * @param SluggerInterface $slugger
     * @param string $uploadsAbsoluteDir
     * @param string $uploadsRelativeDir
     */
    public function __construct(SluggerInterface $slugger, string $uploadsAbsoluteDir, string $uploadsRelativeDir)
    {
        $this->slugger = $slugger;
        $this->uploadsAbsoluteDir = $uploadsAbsoluteDir;
        $this->uploadsRelativeDir = $uploadsRelativeDir;
    }

    /**
     * @inheritDoc
     */
    public function upload(UploadedFile $file): string
    {
        $filename = sprintf(
            "%s_%s.%s",
            $this->slugger->slug($file->getClientOriginalName()),
            uniqid(),
            $file->getClientOriginalExtension()
        );

        $file->move($this->uploadsAbsoluteDir, $filename);

        return $this->uploadsRelativeDir . "/" . $filename;
    }
}
