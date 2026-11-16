# Archiv

API REST para organizar projetos e estudos de desenvolvimento.

Cada usuário tem seus projetos, aprendizados e dificuldades. Cada projeto tem tarefas, e cada tarefa tem etapas ordenadas, que funcionam como um checklist.

## Tecnologias

- Laravel 13 (PHP 8.4)
- PostgreSQL
- Laravel Sanctum (autenticação por token)
- Docker Compose

## Como rodar

Copie o `.env.example` para `.env` e preencha `DB_DATABASE`, `DB_USERNAME` e `DB_PASSWORD` (o Docker usa esses valores para criar o banco).

```bash
cp .env.example .env
docker compose up -d
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate:fresh --seed
```

A API fica em `http://localhost:8000/api`.

## Usuários de demonstração

- `demo@archiv.test` / `password`: dados de exemplo
- `other@archiv.test` / `password`: segundo usuário, para testar as restrições de acesso

## Recursos

- Autenticação: cadastro, login, logout e usuário logado
- Projetos
- Tarefas (dentro de um projeto)
- Etapas (dentro de uma tarefa)
- Aprendizados
- Dificuldades

## Testando a API

As requisições estão na pasta `http/`, no formato da extensão REST Client do VS Code. Em cada arquivo, rode primeiro o login.
