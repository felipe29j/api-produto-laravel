<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/produtos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/produtos.js" defer></script>
    <style>
        /* Estilos básicos para a página */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1, h2 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        input, select {
            margin-bottom: 10px;
        }
        #produtos div {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Página Inicial</a></li>
                <!-- Adicione mais links conforme necessário -->
            </ul>
        </nav>
    </header>

    <h1>Gerenciamento de Produtos</h1>
    <form id="produtoForm">
        <input type="hidden" id="produtoId">
        Nome: <input type="text" id="nome_produto" required><br>
        Valor: <input type="number" id="valor_produto" step="0.01" required><br>
        Marca: <select id="marca_produto" required></select><br>
        Estoque: <input type="number" id="estoque" step="0.01" required><br>
        Cidade: <select id="cidade_id" required></select><br>
        <button type="submit">Salvar</button>
    </form>

    <h2>Produtos</h2>
    <div id="produtos"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Função para carregar produtos
            function loadProdutos() {
                fetch('/api/produtos')
                    .then(response => response.json())
                    .then(data => {
                        const produtosContainer = document.getElementById('produtos');
                        produtosContainer.innerHTML = ''; // Limpa o container
                        data.forEach(produto => {
                            produtosContainer.innerHTML += `
                                <div>
                                    <strong>${produto.nome_produto}</strong><br>
                                    Valor: R$ ${produto.valor_produto}<br>
                                    Marca: ${produto.marca ? produto.marca.nome : 'N/A'}<br>
                                    Cidade: ${produto.cidade ? produto.cidade.nome : 'N/A'}<br>
                                    Estoque: ${produto.estoque}<br>
                                    <button onclick="editProduto(${produto.id})">Editar</button>
                                    <button onclick="deleteProduto(${produto.id})">Excluir</button>
                                </div>
                                <hr>
                            `;
                        });
                    })
                    .catch(error => console.error('Erro ao carregar produtos:', error));
            }

            // Função para carregar marcas
            function loadMarcas() {
                fetch('/api/marcas')
                    .then(response => response.json())
                    .then(data => {
                        const marcaSelect = document.getElementById('marca_produto');
                        marcaSelect.innerHTML = ''; // Limpa o select
                        data.forEach(marca => {
                            marcaSelect.innerHTML += `<option value="${marca.id}">${marca.nome}</option>`;
                        });
                    })
                    .catch(error => console.error('Erro ao carregar marcas:', error));
            }

            // Função para carregar cidades
            function loadCidades() {
                fetch('/api/cidades')
                    .then(response => response.json())
                    .then(data => {
                        const cidadeSelect = document.getElementById('cidade_id');
                        cidadeSelect.innerHTML = ''; // Limpa o select
                        data.forEach(cidade => {
                            cidadeSelect.innerHTML += `<option value="${cidade.id}">${cidade.nome}</option>`;
                        });
                    })
                    .catch(error => console.error('Erro ao carregar cidades:', error));
            }

            // Função para salvar ou atualizar produto
            document.getElementById('produtoForm').addEventListener('submit', function(event) {
                event.preventDefault();
                const id = document.getElementById('produtoId').value;
                const produtoData = {
                    nome_produto: document.getElementById('nome_produto').value,
                    valor_produto: document.getElementById('valor_produto').value,
                    cod_marca: document.getElementById('marca_produto').value,
                    estoque: document.getElementById('estoque').value,
                    cod_cidade: document.getElementById('cidade_id').value,
                };

                const url = id ? `/api/produtos/${id}` : '/api/produtos';
                const method = id ? 'PUT' : 'POST';

                fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(produtoData),
                })
                .then(response => response.json())
                .then(() => {
                    loadProdutos();
                    clearForm();
                })
                .catch(error => console.error('Erro ao salvar produto:', error));
            });

            // Função para editar um produto
            window.editProduto = function(id) {
                fetch(`/api/produtos/${id}`)
                    .then(response => response.json())
                    .then(produto => {
                        document.getElementById('produtoId').value = produto.id;
                        document.getElementById('nome_produto').value = produto.nome_produto;
                        document.getElementById('valor_produto').value = produto.valor_produto;
                        document.getElementById('marca_produto').value = produto.cod_marca;
                        document.getElementById('estoque').value = produto.estoque;
                        document.getElementById('cidade_id').value = produto.cod_cidade;
                    })
                    .catch(error => console.error('Erro ao carregar produto:', error));
            };

            // Função para excluir um produto
            window.deleteProduto = function(id) {
                fetch(`/api/produtos/${id}`, {
                    method: 'DELETE',
                })
                .then(() => loadProdutos())
                .catch(error => console.error('Erro ao excluir produto:', error));
            };

            // Função para
