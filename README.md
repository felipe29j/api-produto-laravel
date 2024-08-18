## Gerenciamento de Produtos

Este é um projeto de gerenciamento de produtos com uma API RESTful desenvolvida em Laravel e um frontend simples usando HTML e jQuery. O sistema permite o gerenciamento de produtos, marcas e cidades com operações CRUD completas.

# Funcionalidades

+ Backend:

 - Gerenciamento de Produtos
 - Gerenciamento de Marcas
 - Gerenciamento de Cidades
 - Validações e relacionamentos entre produtos, marcas e cidades
 - APIs RESTful com endpoints para listar, buscar, criar, editar e excluir produtos, marcas e cidades

+ Frontend:

 - Interface para adicionar, editar e listar produtos
 - Filtros dinâmicos para produtos (ex. média, soma, intervalo de valores, produtos por cidade)
 - Não permite exclusão de produtos com estoque

 ## Tecnologias Utilizadas

+ Backend:

 - Laravel
 - MySQL

+ Frontend:

 - HTML
 - jQuery

  ## Instalação e Configuração

  # Passo 1: Clone o Repositório
    
    git clone https://github.com/usuario/repositorio.git

    cd repositorio

  # Passo 2: Instale as Dependências do Composer

    composer install
 
  # Passo 3: Configure o Banco de Dados

    Renomeie o arquivo .env.example para .env, se já não houver o .env.

    Atualize as configurações do banco de dados no arquivo .env:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nome_do_banco
    DB_USERNAME=usuario
    DB_PASSWORD=senha


  # Passo 4: Crie as Migrations e Popule o Banco de Dados

    php artisan migrate

    php artisan db:seed

  # Passo 5: Inicie o Servidor de Desenvolvimento

     php artisan serve

     O servidor estará disponível em http://localhost:8000.


  ## Endpoints da API

  # Produtos

  + GET /api/produtos - Lista todos os produtos
  + GET /api/produtos/{id} - Busca um produto por ID
  + POST /api/produtos - Cria um novo produto
  + PUT /api/produtos/{id} - Edita um produto
  + DELETE /api/produtos/{id} - Deleta um produto

  # Cidades

  + GET /api/cidades - Lista todas as cidades

  # Marcas

  + GET /api/marcas - Lista todas as marcas

  ## Validações

  # Produtos

  + Nome do produto: obrigatório e único
  + Valor do produto: obrigatório e numérico
  + Marca: obrigatório e existente
  + Estoque: obrigatório e numérico
  + Cidade: obrigatório e existente

  # Cidade e Marca

  + Nome: obrigatório e único

  ## Testes

  Para executar os testes unitários, use o comando:

  php artisan test

