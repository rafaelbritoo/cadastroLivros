DELIMITER $$

CREATE PROCEDURE CreateLivrosTables(IN db_name VARCHAR(255))
BEGIN
    -- Criar tabela 'livro'
    SET @sql_livro = CONCAT('CREATE TABLE IF NOT EXISTS ', db_name, '.livro (
        codl INT AUTO_INCREMENT PRIMARY KEY COMMENT "Código do livro (chave primária com incremento automático)",
        titulo VARCHAR(40) NOT NULL COMMENT "Título do livro",
        editora VARCHAR(40) NOT NULL COMMENT "Nome da editora do livro",
        edicao INT COMMENT "Edição do livro",
        anoPublicacao CHAR(4) COMMENT "Ano de publicação do livro (4 caracteres)",
        valor DECIMAL(10, 2) NOT NULL COMMENT "Valor do livro, com duas casas decimais (R$)"
    )');

PREPARE stmt FROM @sql_livro;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Criar tabela 'assunto'
SET @sql_assunto = CONCAT('CREATE TABLE IF NOT EXISTS ', db_name, '.assunto (
        codAs INT AUTO_INCREMENT PRIMARY KEY COMMENT "Código do assunto (chave primária com incremento automático)",
        descricao VARCHAR(20) NOT NULL COMMENT "Descrição do assunto"
    )');

PREPARE stmt FROM @sql_assunto;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Criar tabela 'livro_assunto' (relacionamento N:M entre livros e assuntos)
SET @sql_livro_assunto = CONCAT('CREATE TABLE IF NOT EXISTS ', db_name, '.livro_assunto (
        livro_codl INT COMMENT "Chave estrangeira para a tabela livro",
        assunto_codAs INT COMMENT "Chave estrangeira para a tabela assunto",
        PRIMARY KEY (livro_codl, assunto_codAs),
        FOREIGN KEY (livro_codl) REFERENCES ', db_name, '.livro(codl) ON DELETE CASCADE,
        FOREIGN KEY (assunto_codAs) REFERENCES ', db_name, '.assunto(codAs) ON DELETE CASCADE
    )');

PREPARE stmt FROM @sql_livro_assunto;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Criar tabela 'autor'
SET @sql_autor = CONCAT('CREATE TABLE IF NOT EXISTS ', db_name, '.autor (
        codAu INT AUTO_INCREMENT PRIMARY KEY COMMENT "Código do autor (chave primária com incremento automático)",
        nome VARCHAR(40) NOT NULL COMMENT "Nome do autor"
    )');

PREPARE stmt FROM @sql_autor;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Criar tabela 'livro_autor' (relacionamento N:M entre livros e autores)
SET @sql_livro_autor = CONCAT('CREATE TABLE IF NOT EXISTS ', db_name, '.livro_autor (
        livro_codl INT COMMENT "Chave estrangeira para a tabela livro",
        autor_codAu INT COMMENT "Chave estrangeira para a tabela autor",
        PRIMARY KEY (livro_codl, autor_codAu),
        FOREIGN KEY (livro_codl) REFERENCES ', db_name, '.livro(codl) ON DELETE CASCADE,
        FOREIGN KEY (autor_codAu) REFERENCES ', db_name, '.autor(codAu) ON DELETE CASCADE
    )');

PREPARE stmt FROM @sql_livro_autor;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Criar a view 'vw_catalogo_livros'
SET @sql_view = CONCAT('CREATE VIEW IF NOT EXISTS ', db_name, '.vw_catalogo_livros AS
    SELECT
        l.codl AS codigo_livro,
        l.titulo AS livro_titulo,
        l.editora AS editora,
        l.edicao AS edicao,
        l.anoPublicacao AS ano_publicacao,
        a.nome AS autor_nome,
        s.descricao AS assunto_nome,
        CONCAT("R$ ", FORMAT(l.valor, 2, "pt_BR")) AS valor_formatado
    FROM
        ', db_name, '.livro l
            LEFT JOIN ', db_name, '.livro_autor la ON l.codl = la.livro_codl
            LEFT JOIN ', db_name, '.autor a ON la.autor_codAu = a.codAu
            LEFT JOIN ', db_name, '.livro_assunto ls ON l.codl = ls.livro_codl
            LEFT JOIN ', db_name, '.assunto s ON ls.assunto_codAs = s.codAs');

PREPARE stmt FROM @sql_view;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

COMMIT;
END $$

DELIMITER ;
