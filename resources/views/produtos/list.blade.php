<!-- resources/views/produtos/list.blade.php -->
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

<div id="produtos"></div>
