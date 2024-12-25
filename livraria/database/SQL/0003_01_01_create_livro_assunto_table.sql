CREATE TABLE Livro_Assunto (
    livro_cod INT,
    assunto_codAs INT,
    PRIMARY KEY (livro_cod, assunto_codAs),
    FOREIGN KEY (livro_cod) REFERENCES Livro(cod),
    FOREIGN KEY (assunto_codAs) REFERENCES Assunto(codAs)
);
