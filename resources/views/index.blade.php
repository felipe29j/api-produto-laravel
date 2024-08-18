<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gerenciamento de Produtos</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>
<body>
    <header>
        <h1>Gerenciamento de Produtos</h1>
        <br>
    <nav class="main-nav">
        <a href="#" id="menuForm" class="nav-link">Cadastrar</a>
        <a href="#" id="menuList" class="nav-link">Listar Produtos</a>
    </nav>
    </header>

    <main>
        <section id="formSection">
            @include('produtos.form')
        </section>

        <section id="listSection" style="display: none;">
            @include('produtos.list')
        </section>
    </main>

