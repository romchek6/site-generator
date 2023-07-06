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
    <div class="container domains">

        <div class="flex-row">
            <div class="left">
                <div class="block">
                    <form action="/domain" method="POST" class="form" enctype="multipart/form-data">
                        @csrf
                        <div  class="input-block">
                            <label for="domain">Введите домен</label>
                            <div class="input">
                                <input type="text" name="domain_name" id="domain">
                            </div>
                        </div>
                        <button class="btn btn-success" type="submit">
                            Добавить
                        </button>
                    </form>
                </div>
                <div class="block">
                    <div class="domains-columns">
                        @foreach($domains as $domain)
                        <div style="position: relative;" >
                            <a href="/site/<?= $domain['id'] ?>" class="domain">
                                <div class="inner-domain"><?= $domain['name'] ?></div>

                            </a>
                            <form action="/domain/<?= $domain['id'] ?>" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="delete-item delete-domain">+</button>
                            </form>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
