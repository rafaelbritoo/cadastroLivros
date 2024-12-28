-- Inicia uma transação
BEGIN;

-- Criação da tabela 'livro'
CREATE TABLE livro (
    codl INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Código do livro (chave primária com incremento automático)',
    titulo VARCHAR(40) NOT NULL COMMENT 'Título do livro',
    editora VARCHAR(40) NOT NULL COMMENT 'Nome da editora do livro',
    edicao INT COMMENT 'Edição do livro',
    anoPublicacao CHAR(4) COMMENT 'Ano de publicação do livro (4 caracteres)',
    valor DECIMAL(10, 2) NOT NULL COMMENT 'Valor do livro, com duas casas decimais (R$)'
);

-- Criação da tabela 'assunto'
CREATE TABLE assunto (
     codAs INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Código do assunto (chave primária com incremento automático)',
     descricao VARCHAR(20) NOT NULL COMMENT 'Descrição do assunto'
);

-- Criação da tabela associativa 'livro_assunto' (relacionamento N:M entre livros e assuntos)
CREATE TABLE livro_assunto (
    livro_codl INT COMMENT 'Chave estrangeira para a tabela livro',
    assunto_codAs INT COMMENT 'Chave estrangeira para a tabela assunto',
    PRIMARY KEY (livro_codl, assunto_codAs),
    FOREIGN KEY (livro_codl) REFERENCES livro(codl) ON DELETE CASCADE,
    FOREIGN KEY (assunto_codAs) REFERENCES assunto(codAs) ON DELETE CASCADE
);

-- Criação da tabela 'autor'
CREATE TABLE autor (
   codAu INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Código do autor (chave primária com incremento automático)',
   nome VARCHAR(40) NOT NULL COMMENT 'Nome do autor'
);

-- Criação da tabela associativa 'livro_autor' (relacionamento N:M entre livros e autores)
CREATE TABLE livro_autor (
     livro_codl INT COMMENT 'Chave estrangeira para a tabela livro',
     autor_codAu INT COMMENT 'Chave estrangeira para a tabela autor',
     PRIMARY KEY (livro_codl, autor_codAu),
     FOREIGN KEY (livro_codl) REFERENCES livro(codl) ON DELETE CASCADE,
     FOREIGN KEY (autor_codAu) REFERENCES autor(codAu) ON DELETE CASCADE
);

CREATE VIEW vw_catalogo_livros AS
SELECT
    l.codl AS codigo_livro,
    l.titulo AS livro_titulo,
    l.editora AS editora,
    l.edicao AS edicao,
    l.anoPublicacao AS ano_publicacao,
    a.nome AS autor_nome,
    s.descricao AS assunto_nome,
    CONCAT('R$ ', FORMAT(l.valor, 2, 'pt_BR')) as valor_formatado
FROM
    livro l
        LEFT JOIN livro_autor la ON l.codl = la.livro_codl
        LEFT JOIN autor a ON la.autor_codAu = a.codAu
        LEFT JOIN livro_assunto ls ON l.codl = ls.livro_codl
        LEFT JOIN assunto s ON ls.assunto_codAs = s.codAs;

-- Finaliza a transação
COMMIT;
