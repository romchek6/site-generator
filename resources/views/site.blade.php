<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')
    <div id="base" style="position: relative">
        <form action="/site/<?= $id ?>" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="_id" value="<?= $id ?>">
            <div class="update" ><button type="submit">Обновить</button></div>
        <div class="container">
            <form action="/generate" method="POST" class="form" enctype="multipart/form-data">
                <div class="flex-row">
                    <div class="left" id="sortable">
                        <div class="block" id="head-block">
                            <div class="block-title">Мета теги в &lt;head&gt;</div>
                            <div class="inputs">
                                <div class="input-block">
                                    <label for="domain">Домен</label>
                                    <div class="input">
                                        <input type="text" value="<?= $post['domain'] ?>" name="domain" id="domain">
                                    </div>
                                </div>
                                <div class="input-block">
                                    <label for="title">Title</label>
                                    <div class="input">
                                        <input type="text" value="<?= $post['title'] ?>" name="title" id="title">
                                    </div>
                                </div>
                                <div class="input-block">
                                    <label for="description">Description</label>
                                    <div class="input">
                                        <textarea class="text-editor" name="description" id="description"><?= $post['description'] ?></textarea>
                                    </div>
                                </div>
                                <div class="input-block breadcrumbs-wrap">
                                    <label for="breadcrumbs">Хлебные крошки</label>
                                    @if(!empty($post['breadcrumbs']))
                                            <?php foreach ($post['breadcrumbs'] as $item): ?>
                                        <div class="input breadcrumbs-item">
                                            <input name="breadcrumbs[]" value="<?= $item ?>" id="breadcrumbs">
                                            <div class="delete-item">+</div>
                                        </div>
                                        <?php endforeach; ?>
                                    @endif
                                </div>
                                <div class="add-row">
                                    <div class="add">+</div>
                                </div>
                            </div>
                        </div>
                        @foreach($block_position as $value)
                            @include('blocks.' . $value)
                        @endforeach
                        <button type="submit" class="submit">Получить архив</button>
                    </div>
                </div>
            </form>
        </div>
        </form>
    </div>
</div>
</body>
</html>
