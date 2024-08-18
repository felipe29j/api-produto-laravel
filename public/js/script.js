document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Função para carregar produtos com filtros opcionais
    function loadProdutos(filters = {}) {
        const queryString = new URLSearchParams(filters).toString();
        fetch(`/api/produtos?${queryString}`)
            .then(response => response.json())
            .then(data => {
                const produtosContainer = document.getElementById('produtos');
                produtosContainer.innerHTML = ''; // Limpa o container

                let somaValores = 0;
                let totalProdutos = data.length;

                data.forEach(produto => {
                    const marcaNome = produto.marca ? produto.marca.nome : 'N/A';
                    const cidadeNome = produto.cidade ? produto.cidade.nome : 'N/A';
                    somaValores += parseFloat(produto.valor_produto);

                    produtosContainer.innerHTML += `
                        <div class="produto-item" id="produto-${produto.id}" data-id="${produto.id}" data-estoque="${produto.estoque}">
                            <h3>${produto.nome_produto}</h3>
                            <div class="produto-info">
                                <p><span>Valor:</span> R$ ${produto.valor_produto}</p>
                                <p><span>Marca:</span> ${marcaNome}</p>
                                <p><span>Cidade:</span> ${cidadeNome}</p>
                                <p><span>Estoque:</span> ${produto.estoque}</p>
                            </div>
                            <button onclick="editProduto(${produto.id})">Editar</button>
                            <button onclick="deleteProduto(${produto.id})" class="delete-btn">Excluir</button>
                        </div>
                    `;
                });

                updateStatistics(somaValores, totalProdutos);
            })
            .catch(error => console.error('Erro ao carregar produtos:', error));
    }

    // Função para atualizar estatísticas de soma e média
    function updateStatistics(somaValores, totalProdutos) {
        const mediaValores = (totalProdutos > 0) ? (somaValores / totalProdutos).toFixed(2) : 0;
        document.getElementById('media_valores').innerText = `${mediaValores}`;
        document.getElementById('soma_valores').innerText = `${somaValores.toFixed(2)}`;
    }

    // Função para carregar cidades no filtro e no formulário de produto
    function loadCidades() {
        fetch('/api/cidades')
            .then(response => response.json())
            .then(data => {
                const cidadeSelectFilter = document.getElementById('cidade_filter');
                const cidadeSelectForm = document.getElementById('cidade_id');
                
                // Limpa os selects
                cidadeSelectFilter.innerHTML = '<option value="">Selecione uma cidade</option>';
                cidadeSelectForm.innerHTML = '<option value="">Selecione uma cidade</option>';
                
                data.forEach(cidade => {
                    const option = `<option value="${cidade.id}">${cidade.nome}</option>`;
                    cidadeSelectFilter.innerHTML += option;
                    cidadeSelectForm.innerHTML += option;
                });
            })
            .catch(error => console.error('Erro ao carregar cidades:', error));
    }

    // Função para carregar marcas no formulário de produto
    function loadMarcas() {
        fetch('/api/marcas')
            .then(response => response.json())
            .then(data => {
                const marcaSelectForm = document.getElementById('marca_produto');
                
                // Limpa o select
                marcaSelectForm.innerHTML = '<option value="">Selecione uma marca</option>';
                
                data.forEach(marca => {
                    marcaSelectForm.innerHTML += `<option value="${marca.id}">${marca.nome}</option>`;
                });
            })
            .catch(error => console.error('Erro ao carregar marcas:', error));
    }

    // Função para salvar ou atualizar um produto
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
                return response.json().then(data => {
                    console.log('Produto salvo com sucesso:', data);

                    // Limpa o formulário
                    clearForm();

                    // Alterna para a seção de listagem
                    document.getElementById('formSection').style.display = 'none';
                    document.getElementById('listSection').style.display = 'block';

                    // Recarrega a lista de produtos
                    loadProdutos();

                    // Aguarda um momento para garantir que o DOM foi atualizado
                    setTimeout(() => {
                        const produtoElement = document.getElementById(`produto-${data.id}`);
                        if (produtoElement) {
                            produtoElement.scrollIntoView({ behavior: 'smooth' });
                        }
                    }, 500);
                });
            } else {
                return response.text().then(text => {
                    console.error('Resposta inesperada do servidor:', text);
                    alert(`Erro ao salvar produto: Produto com esse nome já existente!`);
                });
            }
        })
        .catch(error => {
            console.error('Erro ao salvar produto:', error);
        });
    });

    // Função para limpar o formulário
    function clearForm() {
        document.getElementById('produtoId').value = '';
        document.getElementById('nome_produto').value = '';
        document.getElementById('valor_produto').value = '';
        document.getElementById('marca_produto').value = '';
        document.getElementById('estoque').value = '';
        document.getElementById('cidade_id').value = '';
    }

    // Função para exibir o formulário e preencher com os dados do produto
    function showFormWithData(produto) {
        document.getElementById('produtoId').value = produto.id;
        document.getElementById('nome_produto').value = produto.nome_produto;
        document.getElementById('valor_produto').value = produto.valor_produto;
        document.getElementById('marca_produto').value = produto.cod_marca;
        document.getElementById('estoque').value = produto.estoque;
        document.getElementById('cidade_id').value = produto.cod_cidade;

        // Alterna para a seção do formulário
        document.getElementById('formSection').style.display = 'block';
        document.getElementById('listSection').style.display = 'none';

        // Rola para o topo da página suavemente
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Função para editar um produto
    window.editProduto = function(id) {
        fetch(`/api/produtos/${id}`)
            .then(response => response.json())
            .then(produto => {
                showFormWithData(produto);
            })
            .catch(error => console.error('Erro ao carregar produto:', error));
    };

    // Função para excluir um produto
    window.deleteProduto = function(id) {
        const produtoItem = document.querySelector(`.produto-item[data-id="${id}"]`);
        const estoque = produtoItem.getAttribute('data-estoque');
        
        if (parseInt(estoque) > 0) {
            alert('Não é possível excluir um produto com estoque.');
            return;
        }

        fetch(`/api/produtos/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(() => loadProdutos())
        .catch(error => console.error('Erro ao excluir produto:', error));
    };

    function clearFilters() {
        document.getElementById('valor_min').value = '';
        document.getElementById('valor_max').value = '';
        document.getElementById('cidade_filter').value = '';
    }

    // Função para aplicar filtros e carregar produtos
    document.getElementById('applyFilters')?.addEventListener('click', function() {
        const valorMin = document.getElementById('valor_min').value;
        const valorMax = document.getElementById('valor_max').value;
        const cidadeId = document.getElementById('cidade_filter').value;

        const filters = {};
        if (valorMin) filters['valor_min'] = valorMin;
        if (valorMax) filters['valor_max'] = valorMax;
        if (cidadeId) filters['cidade_id'] = cidadeId;

        loadProdutos(filters);
    });

    // Inicializar
    function initialize() {
        loadProdutos();  // Carregar produtos sem filtros iniciais
        loadCidades();   // Carregar cidades para filtros e formulário
        loadMarcas();    // Carregar marcas para o formulário
    }

    // Alternar entre seções de formulário e listagem
    document.getElementById('menuForm').addEventListener('click', function() {
        document.getElementById('formSection').style.display = 'block';
        document.getElementById('listSection').style.display = 'none';
        clearFilters();

    });

    document.getElementById('menuList').addEventListener('click', function() {
        document.getElementById('formSection').style.display = 'none';
        document.getElementById('listSection').style.display = 'block';
    });

    initialize();
});
