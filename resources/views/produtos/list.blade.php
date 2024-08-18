<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="{{ asset('js/script.js') }}" defer></script>

<div class="filters">
    <div class="filter-group">
        <label for="valor_min">Valor mínimo:</label>
        <input type="number" id="valor_min" step="0.01">
    </div>
    <div class="filter-group">
        <label for="valor_max">Valor máximo:</label>
        <input type="number" id="valor_max" step="0.01">
    </div>
    <div class="filter-group">
        <label for="cidade_filter">Cidade:</label>
        <select id="cidade_filter">
            <option value="">Todas</option>
            <!-- Cidades serão carregadas aqui via JS -->
        </select>
    </div>
    <div class="filter-group">
        <button id="applyFilters">Aplicar Filtros</button>
    </div>
</div>

<div class="statistics">
    <p>Média dos valores: R$ <span id="media_valores">0.00</span></p>
    <p>Soma dos valores: R$ <span id="soma_valores">0.00</span></p>
</div>


<div class="h2produto">
        <h2>Produtos</h2>
    </div>
    <div id="produtos">
    <!-- Exemplo de produto, você deve renderizar produtos dinamicamente -->
    <div class="produto">
        <p>Nome: Produto Exemplo</p>
        <p>Valor: R$ 100.00</p>
        <button type="button" onclick="editProduct(1, 'Produto Exemplo', 100.00, 'Marca Exemplo', 10, 'Cidade Exemplo')">Editar</button>
    </div>
</div>
<script>
    function editProduct(id, nome_produto, valor_produto, marca_produto, estoque, cidade_id) {
        // Preencher o formulário com os dados do produto
        preencherFormulario({
            id: id,
            nome_produto: nome_produto,
            valor_produto: valor_produto,
            marca_produto: marca_produto,
            estoque: estoque,
            cidade_id: cidade_id
        });

        // Alternar para a seção de formulário
        document.getElementById('formSection').style.display = 'block';
        document.getElementById('listSection').style.display = 'none';
    }
</script>
