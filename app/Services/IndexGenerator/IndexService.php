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
            'product_block',
            'regions_block',
            'video_block',
            'reviews_block',
            'seo_block'
        ];

        $this->post = $Post;
        $this->files = $Files;

        if(isset($this->post['product_attribute'])){
            $this->post['product_attribute'] = (array)$this->post['product_attribute'];
            $this->post['product_attribute-value'] = (array)$this->post['product_attribute-value'];
        }
        if(isset($this->files['reviews_img'])){
            $this->files['reviews_img'] = (array)$this->files['reviews_img'];
            $this->files['product_img'] = (array)$this->files['product_img'];
        }

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
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <link rel="canonical"  href="' . $domain . '">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>' . $this->post['title'] . '</title>
                    <meta name="description" content="' . $this->post['description'] . '">
                    <link rel="stylesheet" href="/style.css">
                    <script src="/script.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
                    <link
                      rel="stylesheet"
                      href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
                    />
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
                    ' . $this->breadcrumbs() . '
                    ' . $this->faq() . '
                </head>
                <body>
                <div class="main-container">
                    <h1 id="h1_1">' . $this->post['title'] . '</h1>' . "\r\n";
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

        if(empty($this->post['breadcrumbs'][0])) return;
        $count = count($this->post['breadcrumbs']);
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
        foreach($this->post['breadcrumbs'] as $key => $item){

            if(empty($item)) continue;

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
        if(empty($this->post['question'][0]) && empty($this->post['response'][0])) return;
        $string = '';
        $count = count($this->post['question']);
        foreach($this->post['question'] as $key => $item){
            if(empty($item)) continue;
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
        if(empty($this->post['title_company'][0]) ) return;
        $this->index .= '<div id="h1_2"  class="company block">
            <div class="table">
                <div class="row">
                    <div class="column w-33">Название компании</div>
                    <div class="column w-33">Рейтинг</div>
                    <div class="column w-33">Сайт</div>
                </div>' . "\r\n";

        foreach ($this->post['title_company'] as $key => $value){

            if(empty($value)) continue;

            $link = explode('|', $this->post['link_company'][$key]);

            $this->index .= '<div class="row">
                    <div itemprop="aggregateRating" itemtype="https://schema.org/AggregateRating" itemscope>
                        <meta itemprop="reviewCount" content="98" />
                        <meta itemprop="ratingValue" content="' . $this->post['rating_company'][$key] . '" />
                        <meta itemprop="bestRating" content="100" />
                        <meta itemprop="worstRating" content="1" />
                    </div>
                    <div class="column w-33" itemprop="name">' . $value . '</div>
                    <div class="column w-33">
                        <div class="rating">
                            <div class="rating__body">
                                <div class="rating__active" style="width: ' . $this->post['rating_company'][$key] . '%"></div>
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
                    <div class="column w-33"><a href="' . (isset($link[1])? 'https://' . $link[0] : '#') . '">' . $link[0] . '</a></div>
                </div>' . "\r\n";

        }

        $this->index .= '</div>
                      </div>' . "\r\n";
    }

    private function data_table_block(){
        if(empty($this->post['name_data_company'][0]) ) return;
        $this->index .= '<div id="h1_4"  class="block data">
                            <div class="table">'. "\r\n";
        foreach ($this->post['name_data_company'] as $key => $value){
            if(empty($value)) continue;
            $this->index.='<div class="row">
                                <div class="column w-50">' . $value . '</div>
                                <div class="column w-50">' . $this->post['value_data_company'][$key] . '</div>
                            </div>'. "\r\n";
        }
        $this->index .= '</div>
                      </div>' . "\r\n";
    }

    private function faq_block(){
        if(empty($this->post['question'][0]) && empty($this->post['response'][0])) return;
        $this->index .= '<div id="h1_5"  class="faq block">
            <div id="accordion" class="accordion" style="margin: 1rem auto">' . "\r\n";
        foreach ($this->post['question'] as $key => $value){
            if(empty($value)) continue;
            $this->index .= '<div class="accordion__item">
                    <div class="accordion__header">
                        ' . $value . '
                    </div>
                    <div class="accordion__body">
                        <div class="accordion__content">
                        ' . $this->post['response'][$key] . '
                        </div>
                    </div>
                </div>' . "\r\n";
        }
        $this->index .= '</div>
                      </div>' . "\r\n";
    }
    private function regions_block(){
        if(empty($this->post['regions'])) return;
        $regions = explode('|', $this->post['regions']);
        $this->index .= '<div class="regions block">' . "\r\n";
        foreach ($regions as $value){
            if(empty($value)) continue;
            $this->index .= '<div>' . $value . '</div>' . "\r\n";
        }
        $this->index .= '</div>' . "\r\n";
    }
    private function video_block(){
        if(empty($this->post['video-link'][0])) return;
        $this->index .= '<div class="video block">' . "\r\n";
        foreach ($this->post['video-link'] as $value){
            if(empty($value)) continue;
            $src = explode('?v=', $value);
            $this->index .= '<div class="img">
                <a href="' . $value . '" data-fancybox>
                    <img src="https://i.ytimg.com/vi/' . $src[1] . '/hqdefault.jpg" alt="">
                    <span class="play"><img src="/play.png" alt=""></span>
                </a>
            </div>' . "\r\n";
        }
        $this->index .= '</div>' . "\r\n";
    }
    private function gallery_block(){
        if(empty($this->files['img'])) return;
        $this->index .= '<div id="h1_3" class="gallery block" data-fancybox>' . "\r\n";
        foreach ($this->files['img'] as $key => $value){
            if(empty($value)) continue;
            $value = explode('/', $value)[2];
            $this->index .= '<div class="img">
                                <img src="/images/' . $value . '" alt="">
                             </div>' . "\r\n";
        }
        $this->index .= '</div>' . "\r\n";
    }
    private function reviews_block(){
        if(empty($this->post['reviews_name'][0])) return;
        $this->index .= '<div class="reviews block">
            <div class="wrap">' . "\r\n";
        foreach ($this->post['reviews_name'] as $key => $value){
            if(empty($value)) continue;
            $link = explode('|' , $value);
            $this->files['reviews_img']['reviews_img_' . $this->post['review_number'][$key]] = explode('/', $this->files['reviews_img']['reviews_img_' . $this->post['review_number'][$key]])[2];
            $this->index .= '<div class="item">
                    <div class="info">
                        <div class="img">
                            <img src="/images/' . $this->files['reviews_img']['reviews_img_' . $this->post['review_number'][$key]] . '" alt="">
                        </div>
                        <div class="info2">
                            <div class="title"><a href="' . (isset($link[1])? 'https://' . $link[1]:'#') . '">' . $link[0] . '</a></div>
                            <div class="rating">
                                <div class="rating__body">
                                    <div class="rating__active" style="width: ' . $this->post['reviews_rating'][$key] . '%"></div>
                                    <div class="rating__items">
                                        <span class="rating__item"></span>
                                        <span class="rating__item"></span>
                                        <span class="rating__item"></span>
                                        <span class="rating__item"></span>
                                        <span class="rating__item"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="count">' . $this->post['count_reviews'][$key] . $this->sklonenie($this->post['count_reviews'][$key]) . '</div>
                        </div>
                    </div>
                    <div class="text">' . $this->post['reviews_text'][$key] . '</div>
                </div>' . "\r\n";
        }
        $this->index .= '</div>
        </div>' . "\r\n";
    }

    private function product_block(){
        if(empty($this->post['product_name'][0])) return;
        $this->index .= '<div class="block product">
            <div class="wrap">' . "\r\n";
        foreach ($this->post['product_name'] as $key => $value){
            if(empty($value)) continue;
            $this->files['product_img']['product_img_' . $this->post['key'][$key]] = explode('/', $this->files['product_img']['product_img_' . $this->post['key'][$key]])[2];
            $link = explode('|' , $value);
            $this->index .= '<div class="item">
                    <div class="img">
                        <img src="/images/' . $this->files['product_img']['product_img_' . $this->post['key'][$key]] . '" alt="">
                    </div>
                    <div class="title"><a href="' . (isset($link[1])? 'https://'. $link[1]:'#') . '">' . $link[0] . '</a></div>
                    <div class="attributes">' . "\r\n";

                    foreach ($this->post['product_attribute']['product_'.$this->post['key'][$key]] as $i => $item){
                        if(empty($item)) continue;
                        $this->index .= '<div class="attribute"><span>'. $item .':</span><span>'. $this->post['product_attribute-value']['product_'.$this->post['key'][$key]][$i] .'</span></div>' . "\r\n";
                    }


            $this->index .= '</div>
                    <div class="price">Цена: <b>'. $this->post['product_price'][$key] .'</b> руб</div>
                </div>' . "\r\n";
        }
        $this->index .= '</div>
        </div>' . "\r\n";
    }

    private function sklonenie($i)
    {
        $i = (int)$i;
        if($i%10 == 1) return ' отзыв';
        if($i%10 >1 && $i%10 < 5) return ' отзыва';
        if($i%10 >= 5) return ' отзывов';
    }

}
