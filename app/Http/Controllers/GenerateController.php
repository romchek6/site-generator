<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\MetaValue;
use App\Services\FileGenerator\FileService;
use App\Services\IndexGenerator\IndexService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Ftp\FtpAdapter;

class GenerateController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public $fileService;
    public $indexService;

    public function generate($id)
    {
        $this->clearDirecory();

        $post = MetaValue::where(['domains_id'=> $id, 'name' => 'post'])->get();
        $file = MetaValue::where(['domains_id'=> $id, 'name' => 'file'])->get();
        $domen = Domain::where(['id' => $id])->get()[0]->name;
        $post = (array)json_decode($post[0]->value);
        $file = (array)json_decode($file[0]->value);

        $this->fileService = new FileService();
        $this->indexService = new IndexService($post, $file);

        $index = $this->indexService->indexConstruct();
        $this->fileService->createIndex($index);
        $this->fileService->createZip($domen);

        $path = Storage::disk('local')->path('public/generated-site.zip');
//        Storage::disk('ftp')->put('generated_site.zip', file_get_contents($path));
        return response()->download($path, basename($path));
    }

    private function clearDirecory(){
        Storage::disk('public')->delete('generated-site.zip');
    }

}
