<?php

namespace App\Http\Controllers;

use App\Models\MetaValue;
use Illuminate\Routing\Controller as BaseController;

class SiteController extends BaseController
{
    public function show($id){

        $post = MetaValue::where(['domains_id'=> $id, 'name' => 'post'])->get();
        $file = MetaValue::where(['domains_id'=> $id, 'name' => 'file'])->get();
        $post = json_decode($post[0]->value);
        $file = json_decode($file[0]->value);
        return view('site', compact('post', 'file', 'id'));
    }

    public function update($id){

        $post = $_POST;
        $file = $_FILES;

        MetaValue::where('domains_id', $id)->where('name', 'post')->update(['value' => json_encode($post)]);

        return redirect('/site/'. $id);

    }
}
