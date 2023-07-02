{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--    <head>--}}
{{--        <meta charset="utf-8">--}}
{{--        <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--        <meta name="csrf-token" content="{{ csrf_token() }}">--}}
{{--        <title>{{ config('app.name', 'Laravel') }}</title>--}}
{{--        <!-- Fonts -->--}}
{{--        <link rel="preconnect" href="https://fonts.bunny.net">--}}
{{--        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />--}}
{{--        <!-- Scripts -->--}}
{{--        @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
{{--        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">--}}
{{--        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">--}}
{{--    </head>--}}
{{--    <body class="font-sans antialiased">--}}
{{--        <div class="min-h-screen bg-gray-100">--}}
{{--            @include('layouts.navigation')--}}
{{--            <div id="base">--}}
{{--                <div class="container">--}}
{{--                    <form action="/generate" method="POST" class="form" enctype="multipart/form-data">--}}
{{--                        @csrf--}}
{{--                        <div class="flex-row">--}}
{{--                            <div class="left" id="sortable">--}}
{{--                                <div class="block" id="head-block">--}}
{{--                                    <div class="block-title">Мета теги в &lt;head&gt;</div>--}}
{{--                                    <div class="inputs">--}}
{{--                                        <div class="input-block">--}}
{{--                                            <label for="domain">Домен</label>--}}
{{--                                            <div class="input">--}}
{{--                                                <input type="text" name="domain" id="domain">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="input-block">--}}
{{--                                            <label for="title">Title</label>--}}
{{--                                            <div class="input">--}}
{{--                                                <input type="text" name="title" id="title">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="input-block">--}}
{{--                                            <label for="description">Description</label>--}}
{{--                                            <div class="input">--}}
{{--                                                <textarea class="text-editor" name="description" id="description"></textarea>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="input-block breadcrumbs-wrap">--}}
{{--                                            <label for="breadcrumbs">Хлебные крошки</label>--}}
{{--                                            <div class="input breadcrumbs-item">--}}
{{--                                                <input name="breadcrumbs[]" id="breadcrumbs">--}}
{{--                                                <div class="delete-item">+</div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="add-row">--}}
{{--                                            <div class="add">+</div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="block sortable" id="text-block">--}}
{{--                                    <input type="hidden" name="text_block">--}}
{{--                                    <div class="block-title">Текстовый блок</div>--}}
{{--                                    <div class="inputs">--}}
{{--                                        <div class="input-block">--}}
{{--                                            <label for="text">Текст</label>--}}
{{--                                            <div class="input">--}}
{{--                                                <textarea class="text-editor"  name="text" id="text"></textarea>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="block sortable" id="company-table-block">--}}
{{--                                    <input type="hidden" name="company_table_block">--}}
{{--                                    <div class="block-title">Таблица с компаниями</div>--}}
{{--                                    <div class="text-about">--}}
{{--                                        Если нужно сделать сайт ссылкой используй запись сайт|+--}}
{{--                                    </div>--}}
{{--                                    <div class="table">--}}
{{--                                        <div class="header-table">Название компании</div>--}}
{{--                                        <div class="header-table">Рейтинг</div>--}}
{{--                                        <div class="header-table">Сайт</div>--}}
{{--                                        <div class="input">--}}
{{--                                            <input type="text" class="cell" name="title-company[]">--}}
{{--                                            <input type="text" class="cell" name="rating-company[]">--}}
{{--                                            <input type="text" class="cell" name="link-company[]">--}}
{{--                                            <div class="delete-item">+</div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="add-row">--}}
{{--                                        <div class="add">+</div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="block sortable" id="gallery-block">--}}
{{--                                    <input type="hidden" name="gallery_block">--}}
{{--                                    <div class="block-title">Галлерея фото</div>--}}
{{--                                    <input type="file" name="img[]" id="img" multiple accept="image/*" >--}}
{{--                                    <div class="gallery"></div>--}}
{{--                                </div>--}}
{{--                                <div class="block sortable" id="text-block">--}}
{{--                                    <input type="hidden" name="text2_block">--}}
{{--                                    <div class="block-title">Текстовый блок</div>--}}
{{--                                    <div class="inputs">--}}
{{--                                        <div class="input-block">--}}
{{--                                            <label for="text2">Текст</label>--}}
{{--                                            <div class="input">--}}
{{--                                                <textarea class="text-editor" name="text2" id="text2"></textarea>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="block sortable" id="data-table-block">--}}
{{--                                    <input type="hidden" name="data_table_block">--}}
{{--                                    <div class="block-title">Таблица с данными</div>--}}
{{--                                    <div class="table">--}}
{{--                                        <div class="header-table">Название</div>--}}
{{--                                        <div class="header-table">Описание</div>--}}
{{--                                        <div class="input">--}}
{{--                                            <input type="text" class="cell" name="name-data-company[]">--}}
{{--                                            <textarea class="cell" style="height: 32px" name="value-data-company[]"></textarea>--}}
{{--                                            <div class="delete-item no_rotate">-</div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="add-row">--}}
{{--                                        <div class="add">+</div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="block sortable" id="faq-block">--}}
{{--                                    <input type="hidden" name="faq_block">--}}
{{--                                    <div class="block-title">Вопрос - Ответ</div>--}}
{{--                                    <div class="table">--}}
{{--                                        <div class="header-table">Вопрос</div>--}}
{{--                                        <div class="header-table">Ответ</div>--}}
{{--                                        <div class="input">--}}
{{--                                            <input type="text" class="cell" name="question[]">--}}
{{--                                            <textarea class="cell" style="height: 32px" name="response[]"></textarea>--}}
{{--                                            <div class="delete-item no_rotate">-</div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="add-row">--}}
{{--                                        <div class="add">+</div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="block sortable" id="product-block">--}}
{{--                                    <input type="hidden" name="product_block">--}}
{{--                                    <div class="block-title">Товары</div>--}}
{{--                                    <div class="text-about">--}}
{{--                                        Если нужно добавить в название ссылку используй запись (НАЗВАНИЕ)|(ССЫЛКА)--}}
{{--                                    </div>--}}
{{--                                    <div class="product-table">--}}
{{--                                        <div class="product-item" data-number="1">--}}
{{--                                            <input type="file" name="product-img[]" class="product-img-input">--}}
{{--                                            <div class="product-img" style="z-index: -1">--}}
{{--                                                <div class="delete-img"></div>--}}
{{--                                            </div>--}}
{{--                                            <div class="product-title">--}}
{{--                                                <div class="input-name">Название</div>--}}
{{--                                                <input type="text" name="product-name[]">--}}
{{--                                            </div>--}}
{{--                                            <div class="product-attribute">--}}
{{--                                                <input type="hidden" name="key[]" value="1">--}}
{{--                                                <div class="input-name">Характеристики</div>--}}
{{--                                                <div class="attribute-wrap">--}}
{{--                                                    <input type="text" name="product-attribute[product-1][]">--}}
{{--                                                    <input type="text" name="product-attribute-value[product-1][]">--}}
{{--                                                </div>--}}
{{--                                                <div class="add-row">--}}
{{--                                                    <div class="add add-attribute">+</div>--}}
{{--                                                    <div class="remove remove-attribute disabled">-</div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="product-price">--}}
{{--                                                <div class="input-name">Цена</div>--}}
{{--                                                <input type="text" name="product-price[]">--}}
{{--                                            </div>--}}
{{--                                            <div class="delete-item2">+</div>--}}
{{--                                        </div>--}}
{{--                                        <div class="add-row add-row-product">--}}
{{--                                            <div class="add add-product">+</div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="block sortable" id="regions-block">--}}
{{--                                    <input type="hidden" name="regions_block">--}}
{{--                                    <div class="block-title">Регионы</div>--}}
{{--                                    <div class="text-about">--}}
{{--                                        Города записываются через раздилитель (Город_1)|(Город_2)|(Город_3)--}}
{{--                                    </div>--}}
{{--                                    <div class="input-block">--}}
{{--                                        <div class="input">--}}
{{--                                            <textarea name="regions" id="regions"></textarea>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="block sortable" id="video-block">--}}
{{--                                    <input type="hidden" name="video_block">--}}
{{--                                    <div class="block-title">Видео</div>--}}
{{--                                    <div class="text-about">--}}
{{--                                        Ссылка на видео в форматe https://www.youtube.com/watch?v=xRModWEEuE8--}}
{{--                                    </div>--}}
{{--                                    <div class="video-table">--}}
{{--                                        <div class="video-item" data-video="1">--}}
{{--                                            <div class="video-img">--}}

{{--                                            </div>--}}
{{--                                            <div class="video-link">--}}
{{--                                                <div class="input-name">Ссылка</div>--}}
{{--                                                <input type="text" name="video-link[]">--}}
{{--                                                <div class="delete-item2">+</div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="add-row add-row-video">--}}
{{--                                            <div class="add add-video">+</div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="block sortable" id="reviews-block">--}}
{{--                                    <input type="hidden" name="reviews_block">--}}
{{--                                    <div class="block-title">Отзывы</div>--}}
{{--                                    <div class="text-about">--}}
{{--                                        Если нужно добавить в название ссылку используй запись (НАЗВАНИЕ)|(ССЫЛКА)--}}
{{--                                    </div>--}}
{{--                                    <div class="reviews-table">--}}
{{--                                        <div class="reviews-item" data-number="1">--}}
{{--                                            <input type="file" name="reviews-img[]" class="reviews-logo-input">--}}
{{--                                            <div class="reviews-img" style="z-index: -1">--}}
{{--                                                <div class="delete-img"></div>--}}
{{--                                            </div>--}}
{{--                                            <div class="reviews-title input-block">--}}
{{--                                                <div class="input-name">Название компании</div>--}}
{{--                                                <input type="text" name="reviews-name[]">--}}
{{--                                            </div>--}}
{{--                                            <div class="reviews-rating input-block">--}}
{{--                                                <div class="input-name">Рейтинг</div>--}}
{{--                                                <input type="text" name="reviews-rating[]">--}}
{{--                                            </div>--}}
{{--                                            <div class="count-reviews input-block">--}}
{{--                                                <div class="input-name">Количество отзывов</div>--}}
{{--                                                <input type="text" name="count-reviews[]">--}}
{{--                                            </div>--}}
{{--                                            <div class="reviews-text input-block">--}}
{{--                                                <div class="input-name">Отзыв</div>--}}
{{--                                                <textarea  name="reviews-text[]"></textarea>--}}
{{--                                            </div>--}}
{{--                                            <div class="delete-item2">+</div>--}}
{{--                                        </div>--}}
{{--                                        <div class="add-row add-row-reviews">--}}
{{--                                            <div class="add add-reviews">+</div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="block" id="seo-block">--}}
{{--                                    <input type="hidden" name="seo_block">--}}
{{--                                    <div class="block-title">SEO блок</div>--}}
{{--                                    <div class="inputs">--}}
{{--                                        <div class="input-block">--}}
{{--                                            <label for="seo">Текст</label>--}}
{{--                                            <div class="input">--}}
{{--                                                <textarea class="text-editor" style="min-height: 250px" name="seo" id="seo"></textarea>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <button type="submit" class="submit">Получить архив</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </body>--}}
{{--</html>--}}
