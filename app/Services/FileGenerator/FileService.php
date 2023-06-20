<?php

namespace App\Services\FileGenerator;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class FileService
{
    public function __construct()
    {

    }

    public function createIndex($index){
        Storage::disk('local')->put('public/site/index.html', $index);
        $this->createZip();
    }

    private function createZip()
    {
        $zip = new ZipArchive();
        $fileName = 'storage/generated-site.zip';
        if($zip->open('storage/site/images.zip', ZipArchive::CREATE)){
            $files = File::files(public_path('storage/site/images'));
            foreach ($files as $file){
                $nameInZipFile = basename($file);
                $zip->addFile($file, $nameInZipFile);
            }
            $zip->close();
        }
        if($zip->open($fileName, ZipArchive::CREATE)){
            $files = File::files(public_path('storage/site'));
            foreach ($files as $file){
                $arr[] = $file;
                $nameInZipFile = basename($file);
                $zip->addFile($file, $nameInZipFile);
            }
            $zip->close();
        }
    }

    public function downloadImage(){

    }

}
