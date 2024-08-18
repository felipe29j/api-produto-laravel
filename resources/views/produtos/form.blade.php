<form id="produtoForm">
    <input type="hidden" id="produtoId" name="produtoId">
    <label for="nome_produto">Nome:</label>
    <input type="text" id="nome_produto" name="nome_produto" required><br>
    
    <label for="valor_produto">Valor:</label>
    <input type="number" id="valor_produto" name="valor_produto" step="0.01" required><br>
    
    <label for="marca_produto">Marca:</label>
    <select id="marca_produto" name="marca_produto" required></select><br>
    
    <label for="estoque">Estoque:</label>
    <input type="number" id="estoque" name="estoque" step="0.01" required><br>
    
    <label for="cidade_id">Cidade:</label>
    <select id="cidade_id" name="cidade_id" required></select><br>
    
    <button type="submit">Salvar</button>

    <div id="error-messages"></div>
</form>

<script>
    function preencherFormulario(produto) {
        document.getElementById('produtoId').value = produto.id;
        document.getElementById('nome_produto').value = produto.nome_produto;
        document.getElementById('valor_produto').value = produto.valor_produto;
        document.getElementById('marca_produto').value = produto.marca_produto;
        document.getElementById('estoque').value = produto.estoque;
        document.getElementById('cidade_id').value = produto.cidade_id;
    }
</script>
