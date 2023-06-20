<?php

namespace App\Services\IndexGenerator;

use Illuminate\Support\Facades\Storage;

class IndexService
{
    public string $index;
    private array $post;
    private array $files;

    public function __construct($Post , $Files){

        $blockArray = [
            'text_block',
            'company_table_block',
            'gallery_block',
            'text2_block',
            'data_table_block',
            'faq_block',
//            'product_block',
            'regions_block',
            'video_block',
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
        $this->footer();
    }

    public function indexConstruct()
    {
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
                    <link rel="stylesheet" href="/style.css">
                    <script src="/script.js"></script>
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
                    ' . $this->breadcrumbs() . '
                    ' . $this->faq() . '
                </head>
                <body>
                <div class="main-container">
                    <h1 id="h1_1">Строительство домов в Москве</h1>' . "\r\n";
    }

    private function footer(){
        $this->index .= "
            </div>
            <script>
                new ItcAccordion(document.querySelector('.accordion'), {
                    alwaysOpen: true
                });
            </script>
        </body>
        </html>";
    }

    private function breadcrumbs(){

        if($this->post['breadcrumbs'] == '') return;

        $breadcrumbsArray = explode('|', $this->post['breadcrumbs']);
        $count = count($breadcrumbsArray);
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

            $string .= '{
                "@type": "ListItem",
                "position": ' . $key + 1 . ',
                "item": {
                    "@type": "WebPage",
                    "@id": "' . $hrefArr[$key] . '",
                    "name": "' . $item . '"
                }
            }'. ($count-1 != $key?',':'');
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
        $count = count($this->post['question']);
        foreach($this->post['question'] as $key => $item){
            $string .= '{
                  "@type": "Question",
                  "name": "' . $item . '",
                  "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "' . $this->post['response'][$key] . '"
                    }
            }' . ($count-1 != $key?',':'');
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
        if(empty($this->post['text'])) return;
        $this->index .= '<div class="block text">' . $this->post['text'] . '</div>' . "\r\n";
    }
    private function text2_block()
    {
        if(empty($this->post['text2'])) return;
        $this->index .= '<div class="block text">' . $this->post['text2'] . '</div>' . "\r\n";
    }
    private function seo_block()
    {
        if(empty($this->post['seo'])) return;
        $this->index .= '<div class="seo block">' . $this->post['seo'] . '</div>' . "\r\n";
    }
    private function company_table_block(){
        if(empty($this->post['title-company'][0]) ) return;
        $this->index .= '<div id="h1_2"  class="company block">
            <div class="table">
                <div class="row">
                    <div class="column w-33">Название компании</div>
                    <div class="column w-33">Рейтинг</div>
                    <div class="column w-33">Сайт</div>
                </div>' . "\r\n";

        foreach ($this->post['title-company'] as $key => $value){

            $this->index .= '<div class="row">
                    <div class="column w-33">' . $value . '</div>
                    <div class="column w-33">
                        <div class="rating">
                            <div class="rating__body">
                                <div class="rating__active" style="width: ' . $this->post['rating-company'][$key] . '%"></div>
                                <div class="rating__items">
                                    <span class="rating__item"></span>
                                    <span class="rating__item"></span>
                                    <span class="rating__item"></span>
                                    <span class="rating__item"></span>
                                    <span class="rating__item"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column w-33"><a href="' . $this->post['link-company'][$key] . '">' . $this->post['link-company'][$key] . '</a></div>
                </div>' . "\r\n";

        }

        $this->index .= '</div>
                      </div>' . "\r\n";
    }

    private function data_table_block(){
        if(empty($this->post['name-data-company'][0]) ) return;
        $this->index .= '<div id="h1_4"  class="block data">
                            <div class="table">'. "\r\n";
        foreach ($this->post['name-data-company'] as $key => $value){
            $this->index.='<div class="row">
                                <div class="column w-50">' . $value . '</div>
                                <div class="column w-50">' . $this->post['value-data-company'][$key] . '</div>
                            </div>'. "\r\n";
        }
        $this->index .= '</div>
                      </div>' . "\r\n";
    }

    private function faq_block(){
        if($this->post['question'][0] == '' && $this->post['response'][0] == '') return;
        $this->index .= '<div id="h1_5"  class="faq block">
            <div id="accordion" class="accordion" style="margin: 1rem auto">' . "\r\n";
        foreach ($this->post['question'] as $key => $value){
            $this->index .= '<div class="accordion__item">
                    <div class="accordion__header">
                        ' . $value . '
                    </div>
                    <div class="accordion__body">
                        <div class="accordion__content">
                        ' . $this->post['response'][$key] . '
                        </div>
                    </div>
                </div>'. "\r\n";
        }
        $this->index .= '</div>
                      </div>' . "\r\n";
    }
    private function regions_block(){
        if(empty($this->post['regions'])) return;
        $regions = explode('|', $this->post['regions']);
        $this->index .= '<div class="regions block">' . "\r\n";
        foreach ($regions as $value){
            $this->index .= '<div>'. $value .'</div>' . "\r\n";
        }
        $this->index .= '</div>' . "\r\n";
    }
    private function video_block(){
        if(empty($this->post['video-link'][0])) return;
        $this->index .= '<div class="video block">' . "\r\n";
        foreach ($this->post['video-link'] as $value){
            $src = explode('?v=', $value);
            $this->index .= '<div class="img">
                <a href="' . $value . '">
                    <img src="https://i.ytimg.com/vi/' . $src[1] . '/hqdefault.jpg" alt="">
                    <span class="play"><img src="/play.png" alt=""></span>
                </a>
            </div>' . "\r\n";
        }
        $this->index .= '</div>' . "\r\n";
    }
    private function gallery_block(){
        return;
    }

}
