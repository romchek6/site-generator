<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaValue extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function createEmptyFields($id){
        MetaValue::create([
            'domains_id' => $id,
            'name' => 'post',
            'value' => '{"domain":"","title":"","description":"","files":"","breadcrumbs":[""],"text_block":"","text":"","company_table_block":"","title_company":[""],"rating_company":[""],"link_company":[""],"gallery_block":"","img":[""],"text2_block":"","text2":"","data_table_block":"","name_data_company":[""],"value_data_company":[""],"faq_block":"","question":[""],"response":[""],"product_block":"","product_img":[""],"product_name":[""],"key":["1"],"product_attribute":{"product-1":[""]},"product_attribute-value":{"product-1":[""]},"product_price":[""],"regions_block":"","regions":"","video_block":"","video_link":[""],"reviews_block":"","reviews_img":[""],"reviews_name":[""],"reviews_rating":[""],"count_reviews":[""],"reviews_text":[""],"seo_block":"","seo":""}'
        ]);
        MetaValue::create([
            'domains_id' => $id,
            'name' => 'file',
            'value' => '{"img":[],"product_img":[],"reviews_img":[]}'
        ]);
    }
}
