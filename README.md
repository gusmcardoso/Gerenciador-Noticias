Sistema Gerenciador de Notícias
Este é um projeto desenvolvido como parte de uma avaliação técnica, construído com o framework Laravel. A aplicação é um sistema de gerenciamento de notícias multiusuário, onde cada usuário pode criar, gerenciar e visualizar suas próprias publicações de forma segura e isolada.

✨ Funcionalidades Principais
O sistema foi construído com um conjunto robusto de funcionalidades para proporcionar uma experiência completa e profissional:

🔐 Gerenciamento de Usuários: Sistema completo de autenticação (registro e login).

📝 CRUD Completo de Notícias: Funcionalidades para Criar, Ler, Atualizar e Excluir notícias.

🛡️ Isolamento de Dados: Regra de negócio estrita que garante que um usuário só pode ver e gerenciar suas próprias notícias.

🖼️ Upload de Imagem: Permite o upload de uma imagem de destaque para cada notícia.

✍️ Editor de Texto Rico: Implementação do editor TinyMCE para formatação avançada do conteúdo das notícias.

🏷️ Sistema de Múltiplas Categorias (Tags): Uma notícia pode ser associada a várias categorias, que são exibidas como tags.

🔍 Filtros Avançados: A listagem de notícias pode ser filtrada por:

Título da notícia.

Múltiplas categorias.

Intervalo de datas (Data Inicial e Data Final).

🔗 URLs Amigáveis (Slugs): As URLs das notícias são geradas a partir do título (ex: /noticias/minha-primeira-noticia), melhorando a legibilidade e o SEO.

📄 Paginação: A lista de notícias é paginada automaticamente para melhor performance.

👁️ Interface Limpa: Design baseado no template White Dashboard, com melhorias de usabilidade como menus de ação e layout responsivo.

🚀 Tecnologias Utilizadas
Backend: PHP 8+ / Laravel 10+

Frontend: White Dashboard (Bootstrap 4, SASS)

Banco de Dados: MySQL

JavaScript:

jQuery

Select2 (para seleção múltipla de categorias)

TinyMCE (para o editor de texto rico)

⚙️ Instalação e Configuração Local
Siga os passos abaixo para executar o projeto em seu ambiente de desenvolvimento.

Pré-requisitos:

PHP >= 8.1

Composer

Node.js e NPM

Um servidor local (XAMPP, WAMP, etc.) com um banco de dados MySQL.

Passos:

Clone o repositório:

git clone https://github.com/seu-usuario/nome-do-repositorio.git
cd nome-do-repositorio

Instale as dependências do PHP:

composer install

Instale as dependências do JavaScript:

npm install

Configure o arquivo de ambiente:
Copie o arquivo de exemplo .env.example para um novo arquivo chamado .env.

cp .env.example .env

Gere a chave da aplicação:

php artisan key:generate

Configure o banco de dados:
Abra o arquivo .env e edite as seguintes variáveis com as credenciais do seu banco de dados local:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha

Execute as migrações e os seeders:
Este comando irá criar todas as tabelas e popular o banco com categorias iniciais.

php artisan migrate:fresh --seed

Crie o link simbólico para o armazenamento:
Isso tornará as imagens que você fizer upload publicamente acessíveis.

php artisan storage:link

Compile os assets do frontend:

npm run dev

Inicie o servidor de desenvolvimento:

php artisan serve

A aplicação estará disponível em http://127.0.0.1:8000.

👨‍💻 Autor
[Seu Nome Completo]

E-mail: [seu.email@exemplo.com]

LinkedIn: [https://linkedin.com/in/seu-perfil]