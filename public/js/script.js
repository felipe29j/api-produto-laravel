document.addEventListener('DOMContentLoaded', function() {
    // Obtém o token CSRF do meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Função para carregar produtos
    function loadProdutos() {
        fetch('/api/produtos')
            .then(response => response.json())
            .then(data => {
                const produtosContainer = document.getElementById('produtos');
                produtosContainer.innerHTML = ''; // Limpa o container
                data.forEach(produto => {
                    const marcaNome = produto.marca ? produto.marca.nome : 'N/A';
                    const cidadeNome = produto.cidade ? produto.cidade.nome : 'N/A';
                    produtosContainer.innerHTML += `
                        <div class="produto-item">
                            <h3>${produto.nome_produto}</h3>
                            <div class="produto-info">
                                <p><span>Valor:</span> R$ ${produto.valor_produto}</p>
                                <p><span>Marca:</span> ${marcaNome}</p>
                                <p><span>Cidade:</span> ${cidadeNome}</p>
                                <p><span>Estoque:</span> ${produto.estoque}</p>
                            </div>
                            <button onclick="editProduto(${produto.id})">Editar</button>
                            <button onclick="deleteProduto(${produto.id})">Excluir</button>
                        </div>
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
            valor_produto: parseFloat(document.getElementById('valor_produto').value).toFixed(2),
            cod_marca: document.getElementById('marca_produto').value,
            estoque: parseFloat(document.getElementById('estoque').value).toFixed(2),
            cod_cidade: document.getElementById('cidade_id').value,
        };

        const url = id ? `/api/produtos/${id}` : '/api/produtos';
        const method = id ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(produtoData),
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                return response.text().then(text => {
                    console.error('Resposta inesperada do servidor:', text);
                    throw new Error(`Erro ${response.status}: ${text}`);
                });
            }
        })
        .then(data => {
            console.log('Produto salvo com sucesso:', data);
            loadProdutos();
            clearForm();
        })
        .catch(error => {
            console.error('Erro ao salvar produto:', error);
        });
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
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(() => loadProdutos())
        .catch(error => console.error('Erro ao excluir produto:', error));
    };

    // Função para limpar o formulário
    function clearForm() {
        document.getElementById('produtoId').value = '';
        document.getElementById('nome_produto').value = '';
        document.getElementById('valor_produto').value = '';
        document.getElementById('marca_produto').value = '';
        document.getElementById('estoque').value = '';
        document.getElementById('cidade_id').value = '';
    }

    // Carregar dados ao iniciar a página
    loadProdutos();
    loadMarcas();
    loadCidades();
});
