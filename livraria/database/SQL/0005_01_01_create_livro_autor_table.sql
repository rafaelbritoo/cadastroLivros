CREATE TABLE Livro_Autor (
    livro_cod INT,
    autor_codAu INT,
    PRIMARY KEY (livro_cod, autor_codAu),
    FOREIGN KEY (livro_cod) REFERENCES Livro(cod),
    FOREIGN KEY (autor_codAu) REFERENCES Autor(codAu)
);
