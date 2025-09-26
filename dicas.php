<?php
include_once('session.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livrânea - Categorias</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/livrâneaICON.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style-padrao.css" rel="stylesheet">
    <link href="css/style-dicas.css" rel="stylesheet">
</head>

<body>
    <?php
    include('funcoes/header.php');
    ?>
    <div class="main-content container title-section">
        <h1>DICAS DE LEITURA</h2>

            <div class="accordion" id="accordionDicas">
                <div class="accordion-item border-0 mb-2">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dica1">
                            Como criar o hábito da leitura?
                        </button>
                    </h2>
                    <div id="dica1" class="accordion-collapse collapse" data-bs-parent="#accordionDicas">
                        <div class="accordion-body">
                            Criar o hábito da leitura não precisa ser algo complicado ou cansativo. O segredo está em começar devagar
                            e tornar esse momento prazeroso. Reserve apenas <strong>10 a 15 minutos</strong> do seu dia para ler, de preferência em um horário
                            tranquilo, como antes de dormir ou logo pela manhã. Escolha um lugar confortável, sem distrações, e se
                            permita mergulhar na história. Outra dica é sempre <strong>levar um livro ou um e-reader</strong> com você — assim, aqueles
                            minutos de espera no ônibus ou na fila podem se transformar em páginas lidas. E lembre-se: consistência é mais
                            importante que quantidade. Ler um pouco todos os dias vale mais do que tentar “devorar” um livro inteiro de uma vez.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 mb-2">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dica2">
                            Como encontrar o livro ideal?
                        </button>
                    </h2>
                    <div id="dica2" class="accordion-collapse collapse" data-bs-parent="#accordionDicas">
                        <div class="accordion-body">
                            Nem todo livro vai prender a sua atenção, e está tudo bem! O livro ideal é aquele que conversa com você
                            no momento em que você vive. Se você gosta de romance, pode buscar histórias que falem de <strong>amor e relações humanas</strong>.
                            Já se prefere reflexões profundas, obras <strong>filosóficas ou existenciais</strong> podem ser o caminho. Uma boa estratégia é
                            explorar <strong>recomendações por gênero</strong>, pedir indicações a amigos ou até reler clássicos que marcaram a literatura.
                            O importante é não se prender à ideia de que “precisa” gostar de determinado autor ou obra: cada leitor tem seu
                            ritmo e seus interesses.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 mb-2">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dica3">
                            Clássicos para começar
                        </button>
                    </h2>
                    <div id="dica3" class="accordion-collapse collapse" data-bs-parent="#accordionDicas">
                        <div class="accordion-body">
                            Os clássicos podem parecer desafiadores, mas muitos deles são envolventes e extremamente atuais, além de estarem em domínio público, o que facilita o acesso. Aqui estão algumas sugestões divididas por temas:
                            <br><br>
                            <strong>Romance e Sociedade:</strong> Dom Casmurro, Orgulho e Preconceito, Madame Bovary
                            <br>
                            <strong>Crítica Social:</strong> 1984, O Cortiço, Os Miseráveis
                            <br>
                            <strong>Filosofia e Existencialismo:</strong> O Estrangeiro, Crime Castigo, Ensaio sobre a Cegueira
                            <br>
                            <strong>Fantasia e Mito: </strong> O Senhor dos Anéis, Nárnia
                            <br>
                            <strong>Brasileiros Essenciais:</strong> <a href="verlivro.php?id=2">Memórias Póstumas</a>, Grande Sertão, Capitães da Areia
                            <br><br>
                            Essas obras trazem narrativas profundas, personagens marcantes e reflexões que continuam relevantes até hoje. Além disso, muitos desses títulos podem ser encontrados gratuitamente em bibliotecas digitais de domínio público.
                        </div>
                    </div>
                </div>
            </div>

            <div class="image-box">
                <img src="image/dicas1.jpeg" alt="Dicas1">
            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>