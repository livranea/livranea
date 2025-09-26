CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    foto VARCHAR(255) DEFAULT 'image/defaultprofile.jpg',
    sobremim VARCHAR(150),
    datanasc DATE,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME,
    status ENUM('pendente','ativo') DEFAULT 'pendente',
    token_confirmacao VARCHAR(255) NULL
);

CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    paginas INT NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    sinopse TEXT NOT NULL,
    capa VARCHAR(255) DEFAULT NULL,
    arquivo VARCHAR(255) DEFAULT NULL,
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE distintivos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    icone VARCHAR(255)
);

CREATE TABLE usuario_distintivos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    distintivo_id INT NOT NULL,
    data_conquista DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (distintivo_id) REFERENCES distintivos(id) ON DELETE CASCADE
);

INSERT INTO distintivos (nome, descricao, icone) VALUES
('Leitor', 'Usuários que possuem acesso aos livros.', 'image/distintivos/leitor.png'),
('Escritor', 'Usuário que tem um livro publicado no Livrânea.', 'image/distintivos/escritor.png'),
('Administrador', 'Usuários com permissões máximas no Livrânea.', 'image/distintivos/administrador.png'),
('Suporte', 'Usuários que atendem as dúvidas e problemas.', 'image/distintivos/suporte.png');
