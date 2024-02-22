# Instruções de Configuração e Execução do Projeto

## Backend:

### Configuração do Ambiente:

1. Renomeie o arquivo `.env.example` para `.env` e preencha as informações do banco de dados, incluindo nome do banco de dados, nome de usuário e senha.

### Execução do Docker:

1. Navegue até a pasta `api` do projeto.
2. Execute `docker-compose up -d` para iniciar os containers Docker.
3. Verifique se os containers estão em execução com `docker ps`.

### Configuração Adicional e Migrações:

1. Acesse o container do backend com `docker-compose exec -it (id ou nome container) bash`.
2. Dentro do container, execute `composer install` para instalar as dependências do PHP.
3. Gere a chave de criptografia com `php artisan key:generate`.
4. Execute as migrações do banco de dados com `php artisan migrate`.

Após seguir esses passos, a API estará pronta para uso.

## Frontend:

### Configuração do Ambiente:

1. Renomeie o arquivo `.env.example` para `.env` e defina a variável `VITE_API_URL` como a URL da API, por exemplo: `'http://localhost:8989/api'`.

### Construção e Execução do Docker:

1. Execute `docker build -t web-teste:web-teste .` para construir a imagem Docker do frontend.
2. Execute `docker run -d -p 3333:3333 web-teste:web-teste` para iniciar o contêiner Docker do frontend. Se desejar usar outra porta, ajuste também no arquivo `vite.config.js`.

Agora você pode acessar o frontend em `localhost:3333`.

# Dúvidas ou Sugestões?

Se surgir qualquer dúvida durante o processo de configuração ou execução do projeto, não hesite em entrar em contato!

LinkedIn: [Gabriel Gomes](https://www.linkedin.com/in/gabriel-gomes99)

GitHub: [Gabriel-Gomes-Amorim](https://github.com/Gabriel-Gomes-Amorim)
