<?php

namespace App\Http\Controllers;

use App\Services\FileGenerator\FileService;
use App\Services\IndexGenerator\IndexService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class GenerateController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public $fileService;
    public $indexService;

    public function __construct(FileService $fileService, IndexService $indexService){
        $this->fileService = $fileService;
        $this->indexService = $indexService;
    }

    public function generate(){

//        echo '<pre>';
//        dd($_POST);
//        echo '</pre>';

        echo $this->indexService->indexConstruct($_POST, $_FILES);


    }

}
