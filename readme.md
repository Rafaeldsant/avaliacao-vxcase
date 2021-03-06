# Avaliação para vaga de DEV VX CASE

## Candidato: Rafael Santana  
Finalizado em 17/06/2021

## Instalação

 1. Clone este repositório  
 ` git clone https://github.com/Rafaeldsant/avaliacao-vxcase.git`  
 `cd avaliacao-vxcase`  
 2. Configure o ambiente:  
 `cp .env.example .env`  
 Obs: importante que a variável `DB_HOST` do arquivo `.env` seja setada com `db` para fácil identificação do Docker.
 3. Compile a imagem do app com o seguinte comando:  
 `docker-compose build app`  
 4. Execute o ambiente em segundo plano com:  
 `docker-compose up -d`
 5. Instale as dependências do aplicativo:  
 `docker-compose exec app composer install`
 6. Gere uma key e popule o banco de dados:  
 `docker-compose exec app php artisan key:generate`  
    - Popule o banco de dados mysql  
 `docker-compose exec app php artisan migrate --seed`  
 7. Acesse o servidor  
 `localhost:8000`  


## Resolução dos desafios

- **Implementar o conceito de Repositories no projeto (Nível Básico):**  

	Pattern implementado seguindo as especificações.

- **Implementar FormRequest nos Controllers (Nível Básico):**  

	Validações criadas seguindo as especificações.

- **Criar um command para inserir um produto via terminal (Nível Intermediário):**  

	Para inserir produtos na base de dados através do console basta inserir a entrada `docker-compose exec app php artisan product:create` seguido pelo nome do produto.  
	
	Exemplo: `docker-compose exec app php artisan product:create "Camisa"`  
	
	Siga os passos descritos pelo console.

- **Adicionar Docker ao projeto (Nível Intermediário):**  

	Docker configurado e funcional, para executar o aplicativo siga os passos descritos na tag `Instalação` do arquivo `readme.md`

- **Organizar os Models em uma pasta (Nível Básico):**  

	Todas as Models foram movidas para `app/Models/`

- **Criar uma Job (Nível Avançado):**  

	`docker-compose exec app php artisan schedule:run`  
	Obs:Para utilizar um channel real do Slack, adicione a variável `LOG_SLACK_WEBHOOK_URL` no arquivo `.env` e preencha com uma webhook url válida.
