<?php

namespace App\Services\IndexGenerator;

class IndexService
{
    public string $index;
    private array $post;
    private array $files;

    public function indexConstruct($Post, $Files)
    {
        $blockArray = [
            'text_block',
//            'company_table_block',
//            'gallery_block',
            'text2_block',
//            'data_table_block',
//            'faq_block',
//            'product_block',
//            'regions_block',
//            'video_block',
//            'reviews_block',
            'seo_block'
        ];

        $this->post = $Post;
        $this->files = $Files;
        $this->header();

        foreach($this->post as $key => $value){
             if(array_search($key, $blockArray) !== false){
                $this->$key();
             };
        };

        return $this->index;
    }

    private function header()
    {
        $domain = stripos($this->post['domain'], 'https') ? $this->post['domain'] :'https://' . $this->post['domain'];

        $this->index = '<!doctype html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <link rel="canonical"  href="' . $domain . '">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>' . $this->post['title'] . '</title>
                    <meta name="description" content="' . $this->post['description'] . '">
                    ' . $this->breadcrumbs() . '
                    ' . $this->faq() . '
                </head>
                <body>';
    }

    private function breadcrumbs(){

        if($this->post['breadcrumbs'] == '') return;

        $breadcrumbsArray = explode('|', $this->post['breadcrumbs']);
        $string = '';
        $hrefArr = [
                '/',
                '/#h1_1',
                '/#h1_2',
                '/#h1_3',
                '/#h1_4',
                '/#h1_5',
                '/#h1_6',
        ];
        foreach($breadcrumbsArray as $key => $item){
            $string .= '
                "@type": "ListItem",
                "position": ' . $key + 1 . ',
                "item": {
                    "@type": "WebPage",
                    "@id": "' . $hrefArr[$key] . '",
                    "name": "' . $item . '"
                }
            },';
        }

        return '<script type = "application/ld+json">
        {
            "@context": "http://www.schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [ ' . $string . ' ]
        }
        </script>';

    }

    private function faq()
    {
        if($this->post['question'][0] == '' && $this->post['response'][0] == '') return;
        $string = '';
        foreach($this->post['question'] as $key => $item){
            $string .= '{
                  "@type": "Question",
                  "name": "' . $item . '",
                  "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "' . $this->post['response'][$key] . '"
                    }
            },';
        }

        return ' </script><script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "FAQPage",
          "mainEntity": [' . $string . ']
        }
        </script>';
    }

    private function text_block()
    {
        if($this->post['text'] == '') return;
        $this->index .= '<div class="test_block">' . $this->post['text'] . '</div>';
    }
    private function text2_block()
    {
        if($this->post['text2'] == '') return;
        $this->index .= '<div class="test_block">' . $this->post['text2'] . '</div>';
    }
    private function seo_block()
    {
        if($this->post['seo'] == '') return;
        $this->index .= '<div class="seo_block">' . $this->post['seo'] . '</div>';
    }

}
