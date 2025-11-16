    BoardNet

Projeto com objetivo de criar uma plataforma especializada em troca e venda de boardgames, além de conectar jogadores por todo Brasil para apreciar este grande 
hobby que é a paixão de muitos.

Tecnologias Utilizadas:
- Ambiente - Docker
- Backend, API e Web - Laravel;
- Mobile - Flutter;
- Autenticação - Laravel Breeze para Web, Laravel Sanctum para API e Mobile

Histórico de commits:
- feat: first commit - Criação do repositório no github e no projeto local;
- feat: opening Repository - Criação do README geral e descrição do projeto e início do desenvolvimento em laravel;
- feat: database creation - Criação do banco de dados e seeders para testes;
- feat: controller creation - Criação das controllers básicas para tornar o sistema funcional;
- feat: authentication - Instalação do Laravel Breeze para autenticação de usuário;
- feat: Layouts and Views - Criação do layout base e views e customização das paginas de autenticação;
- feat: Contact and Covers - Adição de coluna de contato tipo telefone para users e de coluna de capas para jogos;
- feat: Services and Repositories - Criação de Services, Repositories e requests para utilizar com API;
- feat: API - Construção da API para uso com o flutter;
- feat: Flutter - Instalação do flutter para projeto mobile e criação de paginas de login, registro e anúncios;
- feat: Trade Details - Criação da página de detalhes do anúncio;
- feat: Edit Register - Criação da página de edição de dados de registro;
- feat: Resource - Criação de resources para filtrar as informações enviadas pela API;
- feat: Refactoring - Refatoração do código;

API:
- As endpoints da API se encontram no arquivo laravel/routes/api.php;
- Para testar a API, utilizar a url http://api.localhost:8080/api/{route}
