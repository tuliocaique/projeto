
Esse projeto foi desenvolvido baseado nas frameworks CakePHP e Laravel. <br>
O diretório Projeto contém suas principais funcionalidades onde foram aplicado os conceitos mais interessantes que ambas as frameworks.


Instruções de execução
-------------
1. Instalar o composer
2. Configurar as credenciais do banco de dados no arquivo config/database.php

Especificações do ambiente de desenvolvimento
-------------
* PHP >= 8.1.11
* Apache/2.4.47 (Win64)
* MySQL Community Server 5.7.33
* Laragon Full 5.0.0

Rotas do sistema
-------------
* `/` - Página inicial do projeto, html localizado no diretorio `src/Views/home.php` 
* `/cidadao/cadastrar` - Rota para cadastro de um novo cidadão, aceita os metodos GET e POST, html localizado no diretorio `src/Views/cidadao/cadastrar.php`
* `/cidadaos` - Página de listagem dos cidadaos cadastrados, html localizado no diretorio `src/Views/cidadao/listar.php`
* `/cidadao/excluir/{id}` - Rota para exclusão de um cidadão, html localizado no diretorio `src/Views/cidadao/excluir.php`
* `/busca` - Página de busca de cidadão pelo  número do NIS cadastrado, html localizado no diretorio `src/Views/cidadao/busca.php`

Detalhes de cada pasta do sistema
-------------
```
.
├── config/ - Nesse diretório se encontra arquivos de configurações do sistema
│   ├── database.php - Arquivo contendo as credencias do banco de dados
│   └── rotas.php - Aqui são definido as rotas do sistema
├── Projeto/ - Esse diretório possui o core de todo o projeto, foram criados classes e metodos com a finalidade de facilitar o desenvolvimento e reutilização de código
│   ├── Conexao.php - Classe responsável por criar a conexão com o banco de dados utilizando o PDO
│   ├── Controller.php - Classe contendo o método view que é responsável por renderizar as views do sistema
│   ├── Flash.php - Classe responsável por criar mensagens de sucesso e erro na sessão para que possa ser exibida posteriormente
│   ├── Index.php - Index é a classe principal do sistema, ela é responsável por receber as requisições e direcionar para o controller correto
│   ├── Model.php - Essa classe contem toda a lógica de comunicação com o banco de dados, ela é responsável por executar as queries e retornar os dados para as Models de cada tabela
│   ├── Request.php - Essa classe contem funcionalidades uteis para manipulação de dados vindos da requisição do usuário
│   ├── Router.php - Essa classe é responsável por receber as rotas definidas no arquivo `config/rotas.php` e direcionar para o controller correto
│   └── View.php - Essa classe é responsável por renderizar as views do sistema
├── src/ - Esse diretório contem a lógica de negócio do sistema
│   ├── Controllers/ - Nesse diretório se encontra os controllers do sistema
│   │   ├── AppController.php - Controller principal do sistema, contem métodos que são utilizados em todos os controllers, esse controller extende a classe Controller do core
│   │   ├── CidadaoController.php - Controller responsável por gerenciar as rotas relacionadas a entidade Cidadao
│   │   └── HomeController.php - Controller responsável por gerenciar as rotas relacionadas a página inicial do sistema
│   ├── Models/ - Nesse diretório se encontra as models do sistema
│   │   └── Cidadao.php - Model responsável por gerenciar as operações relacionadas a entidade Cidadao, o campo fields contem os campos da tabela cidadao
│   ├── public/ - Nesse diretório se encontra os arquivos estáticos do sistema
│   │   ├── css/ - Nesse diretório se encontra os arquivos css do sistema
│   │   │   ├── bootstrap-grid.css 
│   │   │   ├── iziToast.min.css
│   │   │   └── style.css - Arquivo css principal do sistema
│   │   └── js/ - Nesse diretório se encontra os arquivos js do sistema
│   │       └── iziToast.min.js
│   └── Views/ - Nesse diretório se encontra as páginas html do sistema
│       ├── cidadao/ - Nesse diretório se encontra as páginas html relacionadas a entidade Cidadao
│       │   ├── buscar.php
│       │   ├── cadastrar.php
│       │   └── listar.php
│       ├── flash/ - Nesse diretório se encontra as páginas html relacionadas a mensagens de sucesso e erro
│       │   └── flash_message.php
│       └── home.php 
├── 404.php - Está página será exibida sempre que uma rota que não existe no arquivo `config/rotas.php` for acessada
├── .htaccess - Arquivo de configuração do apache, esse arquivo redireciona todo o tráfego para o arquivo `Index.php` que será o responsável pelo rotacionamento das requisições
├── composer.json
└── readme.md
```