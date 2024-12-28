# Projeto CRUD - Livraria

Este projeto implementa uma aplicação CRUD simples para gerenciamento de **Livros**, **Autores** e **Assuntos**, com funcionalidades de relatório e algumas boas práticas de desenvolvimento.

## Tecnologias Utilizadas

- **Laravel 11** - Framework PHP
- **Docker** - Para ambiente de desenvolvimento
- **Bootstrap** - Para o design da interface
- **MySQL** - Banco de dados
- **Componente de Relatório** - Laravel Excel e DOMpdf.

## Requisitos

- **Docker**: Para rodar a aplicação em um ambiente contêinerizado.
- **PHP 8.0 ou superior**: Para rodar a aplicação Laravel.
- **MySQL**: Banco de dados utilizado para armazenar os dados dos livros, autores e assuntos.

## Instalação

### Passo 1: Clonar o Repositório

```bash
git clone https://github.com/SEU_USUARIO/projeto-livros.git
cd projeto-livros
```

### Passo 2: Configurar o Docker


```bash
docker composer up --build
```

### Passo 3: Instalar Dependências do Laravel

```bash
docker-compose exec app composer install
```

### Passo 4: Configurar o Banco de Dados

```bash
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
```

## Passo 5: Acessar a Aplicação

- **Livraria** - http://localhost:8080/
- **Banco de dados** - http://localhost:8888/

## Funcionalidades da Aplicação

### 1. Tela Inicial (Menu Simples):
- A tela inicial contém links para acessar os CRUDs de Livros, Autores, Assuntos e Relatório.
- O layout utiliza Bootstrap para garantir responsividade e boa aparência.

### 2.CRUD de Livros:

- Criação de livros com campos como Título, Edição, Ano de publicação, Valor (em R$), Autor(es) e Assunto(s).
- Visualização, Edição e exclusão de livros existentes.

### 3.CRUD de Autores:

- Criação de autores com campos como Nome.
- Visualização,Edição e exclusão de autores.

### 4.CRUD de Assuntos:

- Criação de assuntos (categorias dos livros).
- Visualização,Edição e exclusão de assuntos.

### 5.Relatório de Livros :

- Geração de um relatório de livros.
- Relatório gerado a partir de uma view no banco de dados.
- O relatório pode ser gerado no formato PDF ou Excel(xml).

## Licença

Este projeto está licenciado sob a MIT License - veja o arquivo LICENSE para mais detalhes.

