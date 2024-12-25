CREATE TABLE Livro (
    cod INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(40),
    editora VARCHAR(40),
    edicao INT,
    anoPublicacao VARCHAR(4),
    valor DECIMAL(10, 2) -- Campo adicionado para o valor (R$)
);
