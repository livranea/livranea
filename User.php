<?php
require __DIR__ . '../PHPMailer/src/Exception.php';
require __DIR__ . '../PHPMailer/src/PHPMailer.php';
require __DIR__ . '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class User extends Conn
{
    public object $conn;
    public array $formData;
    public int $id;
    public function list(): array
    {
        $this->conn = $this->conectar();
        $query = "SELECT u.* FROM usuarios u ORDER BY u.id";
        $result = $this->conn->prepare($query);
        $result->execute();
        $retorno = $result->fetchAll();
        return $retorno;
    }

    public function uploadFoto($arquivoFoto)
    {
        if ($arquivoFoto && isset($arquivoFoto['error']) && $arquivoFoto['error'] === UPLOAD_ERR_OK) {
            $extensao = strtolower(pathinfo($arquivoFoto['name'], PATHINFO_EXTENSION));

            // Permitir apenas extensões seguras
            $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (!in_array($extensao, $permitidas)) {
                return 'image/defaultprofile.jpg'; // fallback se extensão inválida
            }

            $novoNome = uniqid('perfil_', true) . '.' . $extensao;

            // Caminho absoluto (garante que salva dentro da pasta correta)
            $diretorio = __DIR__ . '/uploads/';
            if (!is_dir($diretorio)) {
                mkdir($diretorio, 0755, true);
            }

            $caminhoFinal = $diretorio . $novoNome;

            if (move_uploaded_file($arquivoFoto['tmp_name'], $caminhoFinal)) {
                // Retorna caminho relativo (para exibir no site)
                return 'uploads/' . $novoNome;
            }
        }

        return 'image/defaultprofile.jpg'; // fallback se der erro
    }

    public function create(): bool
    {
        $email = $this->formData['email'];
        $usuario = $this->formData['usuario'];

        //Validar formato de e-mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['msg'] = "❌ E-mail inválido!";
            return false;
        }

        //Verificar se o e-mail existe
        $dominio = substr(strrchr($email, "@"), 1);
        if (!checkdnsrr($dominio, "MX")) {
            $_SESSION['msg'] = "❌ O domínio do e-mail não é válido!";
            return false;
        }

        $this->conn = $this->conectar();

        //Verificar se o email já ta cadastrado
        $queryCheckEmail = "SELECT id FROM usuarios WHERE email = :email LIMIT 1";
        $checkEmail = $this->conn->prepare($queryCheckEmail);
        $checkEmail->bindParam(':email', $email);
        $checkEmail->execute();
        if ($checkEmail->rowCount() > 0) {
            $_SESSION['msg'] = "⚠ Este e-mail já está cadastrado!";
            return false;
        }

        // Verificar se o@ ta ocupado
        $queryCheckUser = "SELECT id FROM usuarios WHERE usuario = :usuario LIMIT 1";
        $checkUser = $this->conn->prepare($queryCheckUser);
        $checkUser->bindParam(':usuario', $usuario);
        $checkUser->execute();
        if ($checkUser->rowCount() > 0) {
            $_SESSION['msg'] = "⚠ Este @usuário já está em uso!";
            return false;
        }

        //Gerar senha e token
        $senha = $this->formData['senha'];
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $foto = $this->uploadFoto($_FILES['foto'] ?? null);

        $token = bin2hex(random_bytes(16)); // token seguro para confirmação

        //Inserir usuário como "pendente"
        $query = "INSERT INTO usuarios 
    (nome, email, usuario, senha, foto, datanasc, created, status, token_confirmacao) 
    VALUES 
    (:nome, :email, :usuario, :senha, :foto, :datanasc, NOW(), 'pendente', :token)";
        $add = $this->conn->prepare($query);
        $add->bindParam(':nome', $this->formData['nome']);
        $add->bindParam(':email', $email);
        $add->bindParam(':usuario', $usuario);
        $add->bindParam(':senha', $hash);
        $add->bindParam(':foto', $foto);
        $add->bindParam(':datanasc', $this->formData['datanasc']);
        $add->bindParam(':token', $token);

        if ($add->execute()) {
            $novoUsuarioId = $this->conn->lastInsertId();

            // Distintivo inicial
            $this->atribuirDistintivo($novoUsuarioId, 1);

            // Enviar email de confirmação
            $this->enviarEmailConfirmacao($email, $token);

            $_SESSION['msg'] = "📧 Registro realizado! Confirme sua conta pelo e-mail.";
            return true;
        }

        $_SESSION['msg'] = "❌ Erro ao realizar o registro.";
        return false;
    }

    private function enviarEmailConfirmacao(string $email, string $token): void
    {
        $mail = new PHPMailer(true);

        try {
            // Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // servidor SMTP
            $mail->SMTPAuth   = true;
            $mail->Username   = 'livranea@gmail.com'; // seu email
            $mail->Password   = 'orov nplu auvi twqf'; // sua senha ou app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Remetente
            $mail->setFrom('livranea@gmail.com', 'Livranea');
            // Destinatário
            $mail->addAddress($email);

            // Conteúdo do e-mail
            $link = "http://localhost/livranea/funcoes/confirmar.php?token=" . $token;
            $mail->isHTML(true);
            $mail->Subject = "Confirme sua conta - Livranea";
            $mail->Body    = "Olá,<br> Clique no link abaixo para confirmar sua conta:<br><a href='$link'>$link</a>";

            $mail->send();
        } catch (Exception $e) {
            $_SESSION['msg'] = "❌ Erro ao enviar e-mail: {$mail->ErrorInfo}";
        }
    }

    public function view()
    {
        $this->conn = $this->conectar();
        $query = "SELECT * FROM usuarios WHERE id = :id LIMIT 1";
        $result = $this->conn->prepare($query);
        $result->bindParam(':id', $this->id);
        $result->execute();
        $valor = $result->fetch();
        return $valor;
    }

    public function edit(): bool
    {
        $this->conn = $this->conectar();
        // Se não houver nova foto enviada, usa a da sessão
        if (!empty($_FILES['foto']['name'])) {
            $foto = $this->uploadFoto($_FILES['foto']);
        } else {
            $foto = $_SESSION['foto']; // mantém a foto atual
        }

        $query = "UPDATE usuarios SET nome = :nome, email = :email, usuario = :usuario, sobremim = :sobremim, foto = :foto, datanasc = :datanasc, modified = NOW() WHERE id = :id";
        $add = $this->conn->prepare($query);
        $add->bindParam(':nome', $this->formData['nome']);
        $add->bindParam(':email', $this->formData['email']);
        $add->bindParam(':usuario', $this->formData['usuario']);
        $add->bindParam(':sobremim', $this->formData['sobremim']);
        $add->bindParam(':foto', $foto);
        $add->bindParam(':id', $this->formData['id']);
        $add->bindParam(':datanasc', $this->formData['datanasc']);
        $add->execute();
        if ($add->rowCount()) {
            // Atualiza a sessão com os novos dados
            $_SESSION['nome'] = $this->formData['nome'];
            $_SESSION['email'] = $this->formData['email'];
            $_SESSION['usuario'] = $this->formData['usuario'];
            $_SESSION['sobremim'] = $this->formData['sobremim'];
            $_SESSION['datanasc'] = $this->formData['datanasc'];
            $_SESSION['foto'] = $foto;
            return true;
        }
        return false;
    }

    public function delete(): bool
    {
        $this->conn = $this->conectar();
        $query = "DELETE FROM usuarios WHERE id = :id LIMIT 1";
        $result = $this->conn->prepare($query);
        $result->bindParam(':id', $this->id);
        $valor = $result->execute();
        return $valor;
    }

    public function logar(string $email): ?array
    {
        $this->conn = $this->conectar();
        $result = $this->conn->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
        $result->bindParam(':email', $email);
        $result->execute();

        if ($result->rowCount() > 0) {
            $user = $result->fetch(PDO::FETCH_ASSOC);

            if ($user['status'] == "pendente") {
                $_SESSION['msg'] = "⚠ Por favor, confirme seu e-mail antes de fazer login.";
                return null;
            }

            return $user;
        }
        return null;
    }


    public function getUser($id)
    {
        $this->conn = $this->conectar();
        $query = "SELECT * FROM usuarios WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function novaSenha($id, $novaSenha): bool
    {
        $this->conn = $this->conectar();
        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
        $query = "UPDATE usuarios SET senha = :senha WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':senha', $senhaHash);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function cadastrarLivro($dados, $files)
    {
        $conn = (new Conn())->conectar();

        $nome = $dados['nome'];
        $autor = $dados['autor'];
        $paginas = $dados['paginas'];
        $categoria = $dados['categoria'];
        $sinopse = $dados['sinopse'];
        $capa = null;
        if (!empty($files['capa']['name'])) {
            $nomeCapa = uniqid() . "_" . $files['capa']['name'];
            $destinoCapa = "uploads/capas/" . $nomeCapa;
            move_uploaded_file($files['capa']['tmp_name'], $destinoCapa);
            $capa = $destinoCapa;
        }
        $arquivo = null;
        if (!empty($files['arquivo']['name'])) {
            $nomeArquivo = uniqid() . "_" . $files['arquivo']['name'];
            $destinoArquivo = "uploads-livros/" . $nomeArquivo;
            move_uploaded_file($files['arquivo']['tmp_name'], $destinoArquivo);
            $arquivo = $destinoArquivo;
        }

        $query = "INSERT INTO livros (nome, autor, paginas, categoria, sinopse, capa, arquivo) 
              VALUES (:nome, :autor, :paginas, :categoria, :sinopse, :capa, :arquivo)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':paginas', $paginas);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':sinopse', $sinopse);
        $stmt->bindParam(':capa', $capa);
        $stmt->bindParam(':arquivo', $arquivo);
        return $stmt->execute();
    }

    public function pesquisarLivros(string $termo, int $limit, int $offset): array
    {
        $this->conn = $this->conectar();
        $sql = "SELECT * FROM livros WHERE nome LIKE :termo OR autor LIKE :termo ORDER BY nome ASC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $like = "%$termo%";
        $stmt->bindParam(':termo', $like, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contarLivrosPesquisa(string $termo): int
    {
        $this->conn = $this->conectar();
        $sql = "SELECT COUNT(*) AS total FROM livros WHERE nome LIKE :termo OR autor LIKE :termo";
        $stmt = $this->conn->prepare($sql);
        $like = "%$termo%";
        $stmt->bindParam(':termo', $like, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    public function getLivrosCategoriaPaginado(string $categoria, int $limit, int $offset): array
    {
        $this->conn = $this->conectar();
        $sql = "SELECT * FROM livros WHERE categoria = :categoria ORDER BY nome ASC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contarLivrosCategoria(string $categoria): int
    {
        $this->conn = $this->conectar();
        $sql = "SELECT COUNT(*) AS total FROM livros WHERE categoria = :categoria";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    public function getLivrosPaginados(int $limit, int $offset): array
    {
        $this->conn = $this->conectar();

        // garante que são inteiros (protege contra injeção quando concatenar)
        $limit = (int)$limit;
        $offset = (int)$offset;

        $sql = "SELECT * FROM livros ORDER BY nome ASC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function contarLivros(): int
    {
        $this->conn = $this->conectar();
        $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM livros");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) ($row['total'] ?? 0);
    }

    public function getLivroById($id)
    {
        $conn = (new Conn())->conectar();
        $query = "SELECT * FROM livros WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDistintivos()
    {
        $this->conn = $this->conectar();
        $sql = "SELECT * FROM distintivos";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDistintivosUsuario($usuarioId)
    {
        $this->conn = $this->conectar();
        $sql = "SELECT d.* 
            FROM distintivos d
            JOIN usuario_distintivos ud ON d.id = ud.distintivo_id
            WHERE ud.usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function atribuirDistintivo($usuarioId, $distintivoId)
    {
        $this->conn = $this->conectar();

        // Verifica se o usuário existe
        $checkUser = $this->conn->prepare("SELECT id FROM usuarios WHERE id = :id");
        $checkUser->bindParam(':id', $usuarioId, PDO::PARAM_INT);
        $checkUser->execute();
        if ($checkUser->rowCount() === 0) {
            return ["status" => false, "msg" => "⚠ Usuário não encontrado."];
        }

        // Verificar se já possui o distintivo
        $check = $this->conn->prepare("
        SELECT id FROM usuario_distintivos 
        WHERE usuario_id = :usuario_id AND distintivo_id = :distintivo_id
    ");
        $check->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $check->bindParam(':distintivo_id', $distintivoId, PDO::PARAM_INT);
        $check->execute();

        if ($check->rowCount() > 0) {
            return ["status" => false, "msg" => "⚠ Esse usuário já possui esse distintivo."];
        }

        // Inserir
        $insert = $this->conn->prepare("
        INSERT INTO usuario_distintivos (usuario_id, distintivo_id) 
        VALUES (:usuario_id, :distintivo_id)
    ");
        $insert->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $insert->bindParam(':distintivo_id', $distintivoId, PDO::PARAM_INT);

        if ($insert->execute()) {
            return ["status" => true, "msg" => "✅ Distintivo atribuído com sucesso!"];
        }

        return ["status" => false, "msg" => "❌ Erro ao atribuir distintivo."];
    }
}
