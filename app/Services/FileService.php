<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
    public function upload(object $file, string $folder)
    {
        $basePath = $this->getStoragePath($file);
        $path = $this->getFileFullPath($basePath, $folder);
        $storagePath = Storage::putFile($path, $file);
        return str_replace('public/', '', $storagePath);
    }

    public function getExtension(object $file)
    {
        $ext = $file->getClientOriginalExtension();
        return strtolower($ext);
    }

    public function getStoragePath(object $file)
    {
        $ext = $file->getClientOriginalExtension();
        $arImageExtensions = ['jpg', 'png', 'jpeg'];
        $arImageDocuments = ['txt', 'docx', 'doc', 'pdf', 'xlsx'];

        if (in_array($ext, $arImageExtensions)) {
            $storagePath = 'public/images';
        } elseif (in_array($ext, $arImageDocuments)) {
            $storagePath = 'public/documents';
        }

        return $storagePath;
    }

    private function getFileFullPath(string $basePath, string $folder): string
    {
        return $basePath . '/' . $folder;
    }
}
