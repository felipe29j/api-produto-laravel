<!-- resources/views/produtos/index.blade.php -->
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
    </header>

    @include('produtos.form') <!-- Inclui o formulário -->

    <div class="h2produto">
        <h2>Produtos</h2>
    </div>
    @include('produtos.list') <!-- Inclui a listagem e filtros -->

</body>
</html>
