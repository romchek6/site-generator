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
    }

    public function createZip($domen)
    {
        $zip = new ZipArchive();
        $fileName = 'storage/generated-site.zip';
        if($zip->open($fileName, ZipArchive::CREATE)){
            $files = File::files(public_path('storage/site'));
            $images = File::files(public_path('storage/' . $domen));
            $zip->addEmptyDir('images');
            if(!empty($images)){
                foreach ($images as $image){
                    $nameInZipFile = basename($image);
                    $zip->addFile($image,  'images/' . $nameInZipFile);
                }
            }
            foreach ($files as $file){
                $nameInZipFile = basename($file);
                $zip->addFile($file, $nameInZipFile);
            }
            $zip->close();
        }
    }

}
