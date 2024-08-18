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
    
    <form id="produtoForm">
        <input type="hidden" id="produtoId">
        Nome: <input type="text" id="nome_produto" required><br>
        Valor: <input type="number" id="valor_produto" step="0.01" required><br>
        Marca: <select id="marca_produto" required></select><br>
        Estoque: <input type="number" id="estoque" step="0.01" required><br>
        Cidade: <select id="cidade_id" required></select><br>
        <button type="submit">Salvar</button>
    </form>

    <div class="h2produto">
        <h2>Produtos</h2>
    </div>
    
    <div id="produtos"></div>
</body>
</html>
