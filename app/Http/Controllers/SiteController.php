<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\MetaValue;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class SiteController extends BaseController
{
    public function show($id){

        $post = MetaValue::where(['domains_id'=> $id, 'name' => 'post'])->get();
        $file = MetaValue::where(['domains_id'=> $id, 'name' => 'file'])->get();
        $name = Domain::where(['id' => $id])->get()[0]->name;
        $post = (array)json_decode($post[0]->value);
        $file = (array)json_decode($file[0]->value);
        $block_position = $this->block_position($post);
        $file['reviews_img'] = (array)$file['reviews_img'];
        $file['product_img'] = (array)$file['product_img'];

        return view('site', compact('post', 'file', 'id', 'block_position', 'name'));
    }

    public function update($id){

        $post = $_POST;
        $file = $_FILES;
        $domen = Domain::where(['id'=>$id])->get()[0]->name;

        $old_files = (array)json_decode(MetaValue::where(['domains_id'=>$id, 'name' => 'file'])->get()[0]->value);

        $files = $this->downloadImg($file, $domen, $old_files);

        MetaValue::where('domains_id', $id)->where('name', 'post')->update(['value' => json_encode($post)]);
        MetaValue::where('domains_id', $id)->where('name', 'file')->update(['value' => json_encode($files)]);

        return redirect('/site/'. $id);
    }

    private function downloadImg($files, $domen, $old_files)
    {
        if(!empty($files['img']['name'][0])){
            foreach($files['img']['name'] as $key => $value){
                $time = time();
                Storage::disk('public')->put($domen . '/' . $time . '_' . basename($value), file_get_contents($files['img']['tmp_name'][$key]));
                $old_files['img'][] = '/' . $domen .'/' . $time . '_' . basename($value);
            }
        }
        $old_files['reviews_img'] = (array)$old_files['reviews_img'];
        $old_files['product_img'] = (array)$old_files['product_img'];
        foreach($files as $key => $item){
            if(strpos($key, 'reviews_img_') !== false){
                if(empty($item['name']) ) continue;
                $time = time();
                Storage::disk('public')->put($domen . '/' . $time . '_' . basename($item['name']), file_get_contents($item['tmp_name']));
                $old_files['reviews_img'][$key] = '/' . $domen .'/' . $time . '_' . basename($item['name']);
            }
        }
        foreach($files as $key => $item){
            if(strpos($key, 'product_img_') !== false){
                if(empty($item['name']) ) continue;
                $time = time();
                Storage::disk('public')->put($domen . '/' . $time . '_' . basename($item['name']), file_get_contents($item['tmp_name']));
                $old_files['product_img'][$key] = '/' . $domen .'/' . $time . '_' . basename($item['name']);
            }
        }
        return $old_files;
    }

    private function block_position($post)
    {
        $blocks = [
            'text_block',
            'company_table_block',
            'gallery_block',
            'text2_block',
            'data_table_block',
            'faq_block',
            'product_block',
            'regions_block',
            'video_block',
            'reviews_block',
            'seo_block'
        ];

        $block_position = [];

        foreach ($post as $key => $item){
            if(in_array($key, $blocks)){
                $block_position[] = $key;
            }
        }
        return $block_position;
    }

    public function deleteImg()
    {
        $path = $_POST['path'];
        $id = $_POST['id'];
        $old_files = MetaValue::where(['domains_id'=>$id, 'name' => 'file'])->get()[0]->value;
        $old_files = (array)json_decode($old_files);
        $old_files['img'] = (array)$old_files['img'];
        $key = array_search($path, $old_files['img']);
        unset($old_files['img'][$key]);
        MetaValue::where('domains_id', $id)->where('name', 'file')->update(['value' => json_encode($old_files)]);
        Storage::disk('public')->delete($path);
    }
}
