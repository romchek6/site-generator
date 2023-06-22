<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @vite(['resources/js/app.js'])
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>
<body>
<header>
    <div class="container">
        <div class="inner-header">
            <div class="logo">Site Generator</div>
        </div>
    </div>
</header>
<div id="base">
    <div class="container">
        <form action="/generate" method="POST" class="form" enctype="multipart/form-data">
            @csrf
            <div class="flex-row">
            <div class="left" id="sortable">
                <div class="block" id="head-block">
                    <div class="block-title">Мета теги в &lt;head&gt;</div>
                    <div class="inputs">
                        <div class="input-block">
                            <label for="domain">Домен</label>
                            <div class="input">
                                <input type="text" name="domain" id="domain">
                            </div>
                        </div>
                        <div class="input-block">
                            <label for="title">Title</label>
                            <div class="input">
                                <input type="text" name="title" id="title">
                            </div>
                        </div>
                        <div class="input-block">
                            <label for="description">Description</label>
                            <div class="input">
                                <textarea class="text-editor" name="description" id="description"></textarea>
                            </div>
                        </div>
                        <div class="input-block breadcrumbs-wrap">
                            <label for="breadcrumbs">Хлебные крошки</label>
                            <div class="input breadcrumbs-item">
                                <input name="breadcrumbs[]" id="breadcrumbs">
                            </div>
                        </div>
                        <div class="add-row">
                            <div class="add">+</div>
                            <div class="remove disabled">-</div>
                        </div>
                    </div>
                </div>
                <div class="block sortable" id="text-block">
                    <input type="hidden" name="text_block">
                    <div class="block-title">Текстовый блок</div>
                    <div class="inputs">
                        <div class="input-block">
                            <label for="text">Текст</label>
                            <div class="input">
                                <textarea class="text-editor"  name="text" id="text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block sortable" id="company-table-block">
                    <input type="hidden" name="company_table_block">
                    <div class="block-title">Таблица с компаниями</div>
                    <div class="table">
                        <div class="header-table">Название компании</div>
                        <div class="header-table">Рейтинг</div>
                        <div class="header-table">Сайт</div>
                        <input type="text" class="cell" name="title-company[]">
                        <input type="text" class="cell" name="rating-company[]">
                        <input type="text" class="cell" name="link-company[]">
                    </div>
                    <div class="add-row">
                        <div class="add">+</div>
                        <div class="remove disabled">-</div>
                    </div>
                </div>
                <div class="block sortable" id="gallery-block">
                    <input type="hidden" name="gallery_block">
                    <div class="block-title">Галлерея фото</div>
                    <input type="file" name="img[]" id="img" multiple accept="image/*" >
                    <div class="gallery"></div>
                </div>
                <div class="block sortable" id="text-block">
                    <input type="hidden" name="text2_block">
                    <div class="block-title">Текстовый блок</div>
                    <div class="inputs">
                        <div class="input-block">
                            <label for="text2">Текст</label>
                            <div class="input">
                                <textarea class="text-editor" name="text2" id="text2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block sortable" id="data-table-block">
                    <input type="hidden" name="data_table_block">
                    <div class="block-title">Таблица с данными</div>
                    <div class="table">
                        <div class="header-table">Название</div>
                        <div class="header-table">Описание</div>
                        <input type="text" class="cell" name="name-data-company[]">
                        <textarea class="cell" style="height: 32px" name="value-data-company[]"></textarea>
                    </div>
                    <div class="add-row">
                        <div class="add">+</div>
                        <div class="remove disabled">-</div>
                    </div>
                </div>
                <div class="block sortable" id="faq-block">
                    <input type="hidden" name="faq_block">
                    <div class="block-title">Вопрос - Ответ</div>
                    <div class="table">
                        <div class="header-table">Вопрос</div>
                        <div class="header-table">Ответ</div>
                        <input type="text" class="cell" name="question[]">
                        <textarea class="cell" style="height: 32px" name="response[]"></textarea>
                    </div>
                    <div class="add-row">
                        <div class="add">+</div>
                        <div class="remove disabled">-</div>
                    </div>
                </div>
                <div class="block sortable" id="product-block">
                    <input type="hidden" name="product_block">
                    <div class="block-title">Товары</div>
                    <div class="text-about">
                        Характеристики записываются (НАЗВАНИЕ)|(ЗНАЧЕНИЕ)
                        <br>
                        Если нужно добавить в название ссылку используй запись (НАЗВАНИЕ)|(ССЫЛКА)
                    </div>
                    <div class="product-table">
                        <div class="product-item" data-number="1">
                            <input type="file" name="product-img[]" class="product-img-input">
                            <div class="product-img" style="z-index: -1">
                                <div class="delete-img"></div>
                            </div>
                            <div class="product-title">
                                <div class="input-name">Название</div>
                                <input type="text" name="product-name[]">
                            </div>
                            <div class="product-attribute">
                                <div class="input-name">Характеристики</div>
                                <div class="attribute-wrap">
                                    <input type="text" name="product-attribute[product-1][]">
                                </div>
                                <div class="add-row">
                                    <div class="add add-attribute">+</div>
                                    <div class="remove remove-attribute disabled">-</div>
                                </div>
                            </div>
                            <div class="product-price">
                                <div class="input-name">Цена</div>
                                <input type="text" name="product-price[]">
                            </div>
                        </div>
                        <div class="add-row add-row-product">
                            <div class="add add-product">+</div>
                            <div class="remove remove-product disabled">-</div>
                        </div>
                    </div>
                </div>
                <div class="block sortable" id="regions-block">
                    <input type="hidden" name="regions_block">
                    <div class="block-title">Регионы</div>
                    <div class="text-about">
                        Города записываются через раздилитель (Город_1)|(Город_2)|(Город_3)
                    </div>
                    <div class="input-block">
                        <div class="input">
                            <textarea name="regions" id="regions"></textarea>
                        </div>
                    </div>
                </div>
                <div class="block sortable" id="video-block">
                    <input type="hidden" name="video_block">
                    <div class="block-title">Видео</div>
                    <div class="text-about">
                        Ссылка на видео в форматe https://www.youtube.com/watch?v=xRModWEEuE8
                    </div>
                    <div class="video-table">
                        <div class="video-item" data-video="1">
                            <div class="video-img">

                            </div>
                            <div class="video-link">
                                <div class="input-name">Ссылка</div>
                                <input type="text" name="video-link[]">
                            </div>
                        </div>
                        <div class="add-row add-row-video">
                            <div class="add add-video">+</div>
                            <div class="remove remove-video disabled">-</div>
                        </div>
                    </div>
                </div>
                <div class="block sortable" id="reviews-block">
                    <input type="hidden" name="reviews_block">
                    <div class="block-title">Отзывы</div>
                    <div class="text-about">
                        Если нужно добавить в название ссылку используй запись (НАЗВАНИЕ)|(ССЫЛКА)
                    </div>
                    <div class="reviews-table">
                        <div class="reviews-item" data-number="1">
                            <input type="file" name="reviews-img[]" class="reviews-logo-input">
                            <div class="reviews-img" style="z-index: -1">
                                <div class="delete-img"></div>
                            </div>
                            <div class="reviews-title input-block">
                                <div class="input-name">Название компании</div>
                                <input type="text" name="reviews-name[]">
                            </div>
                            <div class="reviews-rating input-block">
                                <div class="input-name">Рейтинг</div>
                                <input type="text" name="reviews-rating[]">
                            </div>
                            <div class="count-reviews input-block">
                                <div class="input-name">Количество отзывов</div>
                                <input type="text" name="count-reviews[]">
                            </div>
                            <div class="reviews-text input-block">
                                <div class="input-name">Отзыв</div>
                                <textarea  name="reviews-text[]"></textarea>
                            </div>
                        </div>
                        <div class="add-row add-row-reviews">
                            <div class="add add-reviews">+</div>
                            <div class="remove remove-reviews disabled">-</div>
                        </div>
                    </div>
                </div>
                <div class="block" id="seo-block">
                    <input type="hidden" name="seo_block">
                    <div class="block-title">SEO блок</div>
                    <div class="inputs">
                        <div class="input-block">
                            <label for="seo">Текст</label>
                            <div class="input">
                                <textarea class="text-editor" style="min-height: 250px" name="seo" id="seo"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="submit">Получить архив</button>
            </div>
        </div>

        </form>
    </div>
</div>
<footer>
</footer>
</body>
</html>
