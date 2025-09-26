-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/09/2025 às 03:20
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `livranea_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `distintivos`
--

CREATE TABLE `distintivos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `icone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `distintivos`
--

INSERT INTO `distintivos` (`id`, `nome`, `descricao`, `icone`) VALUES
(1, 'Leitor', 'Usuários que possuem acesso aos livros.', 'image/distintivos/leitor.png'),
(2, 'Escritor', 'Usuário que tem um livro publicado no Livrânea.', 'image/distintivos/escritor.png'),
(3, 'Administrador', 'Usuários com permissões máximas no Livrânea.', 'image/distintivos/administrador.png'),
(4, 'Suporte', 'Usuários que atendem as dúvidas e problemas.', 'image/distintivos/suporte.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `livros`
--

CREATE TABLE `livros` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `paginas` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `sinopse` text NOT NULL,
  `capa` varchar(255) DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `livros`
--

INSERT INTO `livros` (`id`, `nome`, `autor`, `paginas`, `categoria`, `sinopse`, `capa`, `arquivo`, `created`) VALUES
(1, 'A Princesa de Babilônea', 'Voltaire', 46, 'Literatura Clássica', 'Sobre as batalhas, tão frequentes na antiguidade como hoje, Voltaire é incisivo:\r\nOs homens que comem carne e tomam beberagens fortes têm todos um sangue azedo e adusto, que os torna loucos de mil maneiras diferentes. Sua principal demência se manifesta na fúria de derramar o sangue de seus irmãos e devastar terras férteis, para reinarem sobre cemitérios.\r\n\r\nA respeito da ressurreição, tema que Voltaire tratava com desdém, aqui fala com uma profundidade e percuciência dignas de meditação:\r\n— A ressurreição, Alteza — disse-lhe a fênix — é a coisa mais simples deste mundo. Não é mais surpreendente nascer duas vezes do que uma. Tudo é ressurreição no mundo; as lagartas ressuscitam em borboletas, uma semente ressuscita em árvore; todos os animais, sepultados na terra, ressuscitam em ervas, em plantas, e alimentam outros animais, de que vão constituir em breve uma parte da substância: todas as partículas que compunham os corpos são transformadas em diferentes seres. É verdade que sou o único a quem o poderoso Orosmade concedeu a graça de ressuscitar na sua pr ópria natureza.\r\n\r\nA mesma fênix demonstra quão ridícula é a pretensão humana de dominar o conhecimento sobre a origem dos homens e, enfim, de todas as coisas:\r\n— E tu — perguntou o rei da Bética à fênix — que pensas a respeito?', 'uploads/capas/68ccc662b617f_A Princesa de Babilônia.png', 'uploads-livros/68ccc662b6b0e_A Princesa de Babilônia.pdf', '2025-09-19 02:56:34'),
(2, 'A Volta ao Mundo em 80 Dias', 'Júlio Verne', 778, 'Literatura Clássica', 'Durante um jogo de cartas no Reform Club de Londres, Mr. Phileas Fogg, um gentleman inglês misterioso e muito rico, aposta com seus parceiros que conseguirá dar a volta completa ao mundo em 80 dias. Todos acham isso absurdo, irrealizável, mas um inglês nunca brinca quando se trata de algo tão importante como uma aposta, e ela é fechada. São 8:45 da noite, é quarta-feira, 2 de outubro; Mr. Fogg garante que estará de volta a Londres, naquela mesma sala, no sábado, 21 de dezembro, às 8:45 da noite; caso contrário, as 20 mil libras de sua conta bancária passarão a pertencer aos seus cinco parceiros de jogo. Acompanhado pelo recém-contratado criado francês Passepartout e seguido, sem saber, pelo inspetor Fix, que espera um mandado de prisão para prendê-lo como suspeito do roubo de 55 mil libras do Banco da Inglaterra, o aristocrata parte imediatamente em viagem. A volta ao mundo em 80 dias é uma aventura empolgante. Os viajantes passam por diferentes lugares ? alguns, de culturas exóticas ?, por situações inesperadas ? algumas, bastante perigosas. Viajando de trem, de navio, trenó e até de elefante, passam por Suez, Bombaim (atual Mumbai), Calcutá, Singapura, Hong Kong, Yokohama, São Francisco, Nova York. Enfrentam neve, tempestades, ataques de índios, impedem que a encantadora Mrs. Aouda seja queimada viva, sempre lutando contra o tempo. As personalidades de Mr. Fogg, de Passepartout e do inspetor Fix contribuem para tornar admirável este romance, considerado um dos melhores de Júlio Verne desde sua publicação, em 1873.', 'uploads/capas/68ccc891b0e40_A Volta ao Mundo em 80 Dias.png', 'uploads-livros/68ccc891b1316_A Volta ao Mundo em 80 Dias.pdf', '2025-09-19 03:05:53'),
(3, 'A Religiões no Rio', 'João do Rio', 82, 'Literatura Clássica', 'Publicado inicialmente como reportagem, As religiões no Rio desenvolve um divertido levantamento dos mistérios das crenças no Rio de Janeiro do século XX: o protestantismo, o satanismo, os judeus, os espiritas, os católicos e muito mais. João do Rio, um dos precursores da crônica no Brasil, responsável por elevá-la a categoria de gênero literário, reúne neste livro uma série de entrevistas com personagens de diversas religiões, oferecendo uma obra de caráter histórico e etnográfico, pioneira, singular e atemporal.', 'uploads/capas/68ccca26128c9_A Religiões no Rio.png', 'uploads-livros/68ccca2612db1_As Religiões no Rio.pdf', '2025-09-19 03:12:38'),
(4, 'Cartas D\'Amor', 'Eça de Queiroz', 11, 'Literatura Clássica', 'Este livro é uma história de amor em forma de cartas, tão ao gosto da época profundamente romântica - o fim do século XIX - em que foi escrito. São cartas tocantes e belas, com a marca inconfundível, o estilo e a dicção de Eça de Queiroz, mas que apareceram inicialmente sob outra assinatura, a de um misterioso Carlos Fradique Mendes. Este, sabemos hoje, foi um \"autor\" inventado, um escritor da ficção - um personagem, enfim - surgido da pena e da imaginação de um grupo de amigos que freqüentavam os círculos literários de Lisboa: Antero de Quental, Jaime Batalha Reis, Ramalho Ortigão e, naturalmente, o próprio Eça.', 'uploads/capas/68cccb6300d99_Cartas D\'Amor.png', 'uploads-livros/68cccb630133f_Cartas D\'Amor.pdf', '2025-09-19 03:17:55'),
(5, 'Dom Casmurro', 'Machado de Assis', 105, 'Literatura Clássica', 'Em Dom Casmurro, o narrador Bento Santiago retoma a infância que passou na Rua de Matacavalos e conta a história do amor e das desventuras que viveu com Capitu, uma das personagens mais enigmáticas e intrigantes da literatura brasileira. Nas páginas deste romance, encontra-se a versão de um homem perturbado pelo ciúme, que revela aos poucos sua psicologia complexa e enreda o leitor em sua narrativa ambígua acerca do acontecimento ou não do adultério da mulher com olhos de ressaca, uma das maiores polêmicas da literatura brasileira.', 'uploads/capas/68cccc418a61b_Dom Casmurro.png', 'uploads-livros/68cccc418aabe_dom casmurro.pdf', '2025-09-19 03:21:37'),
(6, 'A Hora e a Vez da Biomassa', 'Maurilio Biagi Filho', 4, 'História e Cultura', 'O livro \"A hora e a vez da biomassa\" fala sobre a utilização da biomassa como uma fonte de energia renovável e sustentável, especialmente no Brasil, abordando as oportunidades econômicas e ambientais, além das tecnologias existentes e a necessidade de inovação e recursos humanos capacitados para o setor, focando na conversão energética da biomassa para a produção de \"energia limpa\" e a redução do efeito estufa.', 'uploads/capas/68cccdcbd5f7b_A Hora e a Vez da Biomassa.png', 'uploads-livros/68cccdcbd63ba_A hora e a vez da biomassa.pdf', '2025-09-19 03:28:11'),
(7, '15 Anos de Software Livre', 'Richard Stallman', 2, 'Tecnologia', 'O artigo \"15 Anos de Software Livre\" de Richard Stallman fala sobre a importância do movimento de software livre para a liberdade dos usuários de computador e para o desenvolvimento tecnológico, abordando a necessidade de os usuários terem a capacidade de estudar e modificar o software para garantir que a liberdade não seja perdida, discutindo também o desafio de adicionar mais aplicativos livres para suprir as necessidades dos utilizadores. ', 'uploads/capas/68cccf8a83ab7_15 Anos de Software Livre.png', 'uploads-livros/68cccf8a83e77_15 anos de software livre.pdf', '2025-09-19 03:35:38'),
(8, 'Evolução da Internet no Brasil e no Mundo', 'Ministério da Ciência e Tecnologia (MCT)', 80, 'Tecnologia', 'O livro sobre a \"Evolução da Internet no Brasil e no Mundo\" aborda desde a criação da ARPANET e o desenvolvimento da World Wide Web até a era das redes sociais, a internet das coisas, e tecnologias futuras como inteligência artificial e blockchain.', 'uploads/capas/68ccd0ec5b8e8_Evolução da Internet no Brasil e no Mundo.png', 'uploads-livros/68ccd0ec5be65_Evolução da internet no Brasil e no mundo.pdf', '2025-09-19 03:41:32'),
(9, 'Pão e Liberdade', 'Mario Luis Teza', 12, 'Tecnologia', 'Livro conta parte da história da adoçao de software livres no Rio Grande do Sul e seu potencial para o Brasil.', 'uploads/capas/68ccd1d773250_Pão e Liberdade.png', 'uploads-livros/68ccd1d7736b0_Pão e Liberdade.pdf', '2025-09-19 03:45:27'),
(10, 'O Galo Tião e a Dinda Raposa', 'Lenira Almeida Heck', 23, 'Infantojuvenil', 'Esta bela história narra a vida de um galo treinado para lutar, que um dia ataca o próprio dono e é expulso da propriedade. Junto com sua companheira, a galinha Cocó, parte sem rumo. Após longa caminhada, encontra a Raposa cinza de quem se torna amigo. A galinha Cocó choca os seus primeiros ovos. A Raposa é convidada para madrinha dos pintinhos. Esta protege os afilhados dos predadores. Mesmo com tantos cuidados alguns pintinhos desaparecem misteriosamente. O Galo Tião pensa num inteligente plano para pegar o provável culpado.', 'uploads/capas/68ccd2bc15de0_O Galo Tião e a Dinda Raposa.png', 'uploads-livros/68ccd2bc1674b_O galo Tião e a dinda Raposa.pdf', '2025-09-19 03:49:16'),
(11, 'Amanda e os Nanorobôs', 'Eliú Quintiliano', 494, 'Infantojuvenil', 'Num futuro onde as máquinas já coexistem com os humanos, um mundo novo surge do outro lado da galáxia. O céu estava num tom de azul muito intenso, não se via a linha do horizonte.', 'uploads/capas/68ccd3b9b40fe_Amanda e os Nanorobôs.png', 'uploads-livros/68ccd3b9b4783_Amanda e os nanorobos.pdf', '2025-09-19 03:53:29'),
(12, 'Pai, Posso dar um soco nele?', 'José Cláudio da Silva', 19, 'Infantojuvenil', 'Quem poderia imaginar que um acampamento se transformaria em uma aventura, que exigiria muita coragem de 6 jovens para salvar uma civilização fadada ao desaparecimento.', 'uploads/capas/68ccd51ddbfb8_Pai, Posso dar um soco nele.png', 'uploads-livros/68ccd51ddc4d7_Pai, posso dar um soco nele_.pdf', '2025-09-19 03:59:25');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT 'image/defaultprofile.jpg',
  `sobremim` varchar(150) DEFAULT NULL,
  `datanasc` date DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL,
  `status` enum('pendente','ativo') DEFAULT 'pendente',
  `token_confirmacao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario_distintivos`
--

CREATE TABLE `usuario_distintivos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `distintivo_id` int(11) NOT NULL,
  `data_conquista` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `distintivos`
--
ALTER TABLE `distintivos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Índices de tabela `usuario_distintivos`
--
ALTER TABLE `usuario_distintivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `distintivo_id` (`distintivo_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `distintivos`
--
ALTER TABLE `distintivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuario_distintivos`
--
ALTER TABLE `usuario_distintivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `usuario_distintivos`
--
ALTER TABLE `usuario_distintivos`
  ADD CONSTRAINT `usuario_distintivos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuario_distintivos_ibfk_2` FOREIGN KEY (`distintivo_id`) REFERENCES `distintivos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
