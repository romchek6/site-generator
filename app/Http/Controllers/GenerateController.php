<?php

namespace App\Http\Controllers;

use App\Services\FileGenerator\FileService;
use App\Services\IndexGenerator\IndexService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class GenerateController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public $fileService;
    public $indexService;

    public function generate()
    {
        $this->clearDirecory();

        $this->fileService = new FileService();
        $this->indexService = new IndexService($_POST, $_FILES);

        $index = $this->indexService->indexConstruct();
        $this->fileService->createIndex($index);

        $path = Storage::disk('local')->path('public/generated-site.zip');
        return response()->download($path, basename($path));
    }

    private function clearDirecory(){
        Storage::disk('public')->deleteDirectory('site/images');
        Storage::disk('public')->put('site/images/1.txt', 'images create');
        Storage::disk('public')->delete('generated-site.zip');
        Storage::disk('public')->delete('site/images.zip');
    }

}
