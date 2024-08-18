<!-- resources/views/produtos/form.blade.php -->
<form id="produtoForm">
    <input type="hidden" id="produtoId">
    <label for="nome_produto">Nome:</label>
    <input type="text" id="nome_produto" required><br>
    
    <label for="valor_produto">Valor:</label>
    <input type="number" id="valor_produto" step="0.01" required><br>
    
    <label for="marca_produto">Marca:</label>
    <select id="marca_produto" required></select><br>
    
    <label for="estoque">Estoque:</label>
    <input type="number" id="estoque" step="0.01" required><br>
    
    <label for="cidade_id">Cidade:</label>
    <select id="cidade_id" required></select><br>
    
    <button type="submit">Salvar</button>

    <div id="error-messages"></div>

</form>
