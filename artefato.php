<?php
require_once('script/conexao.php');

if (empty($_GET['id_artefato'])) {
    header('Location: artefatos.php');
}

$id_artefato = $_GET['id_artefato'];

// Para pegar todos os artefatos cadastrados no banco
$instruction = "
SELECT * FROM `artefatos` WHERE id = :id_artefato;
";

$statement = $database->prepare($instruction);
$statement->bindValue(':id_artefato', $id_artefato);
$statement->execute();
$item_artefato = $statement->fetch(PDO::FETCH_ASSOC);

// Caso nenhum artefato seja encontrado no banco, redireciona o usuário para a página de artefatos
if (empty($item_artefato)) {
    header('Location: artefatos.php');
}

?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/artefato.css">
    <title> <?= $item_artefato['nome'] ?> </title>
</head>

<body>
    <?php include('header.html'); ?>

    <main>
        <section id="conteudo">
            <span class="secao">Artefato</span>
            <h2 id="nome-artefato"> <?= $item_artefato['nome'] ?> </h2>

            <div class="imagem"></div>

            <span class="secao">Dados segundo o proponente</span>
            <section id="dados-proponente">
                <span id="objetivo"> <b>Objetivo</b> </span>
                <p class="info"> <?= $item_artefato['objetivo'] ?> </p>

                <span id="descricao"> <b>Descrição</b> </span>
                <p class="info"> <?= $item_artefato['descricao'] ?> </p>

                <span id="como-aplicar"><b>Como aplicar</b> </span>
                <p class="info"> <?= $item_artefato['funcionamento'] ?> </p>
            </section>


            <span class="secao">Dados do ponto de vista de engenhereiros de software novatos</span>
            <section id="dados-eng-software-novatos">
                <span id="pontos-positivos"><b>Pontos positivos</b> </span>
                <p class="info">
                    <?=
                    empty($item_artefato['pontos_positivos']) ? "Indisponível." : $item_artefato['pontos_positivos']
                    ?>
                </p>
                <span id="pontos-negativos"><b>Pontos negativos</b> </span>
                <p class="info">
                    <?=
                    empty($item_artefato['pontos_negativos']) ? "Indisponível." : $item_artefato['pontos_negativos']
                    ?>
                </p>
                <span id="proposta-melhorias"><b>Propostas de melhorias</b> </span>
                <p class="info">
                    <?=
                    empty($item_artefato['proposta_melhorias']) ? "Indisponível." : $item_artefato['proposta_melhorias']
                    ?>
                </p>
            </section>

            <span class="secao">Material</span>
            <section id="material">
                <span class="info">
                    <b>Fonte:</b>
                    <a href="<?= $item_artefato['base_teorica'] ?>" target="_blank">
                        <?= $item_artefato['base_teorica'] ?>
                    </a>
                </span>
                <span class="info">
                    <b>Arquivo:</b>
                    <a href="">
                    </a>
                </span>
                <span class="info">
                    <b>Template:</b>
                    <a href="<?= $item_artefato['template'] ?>" target="_blank">
                        <?= $item_artefato['template'] ?>
                    </a>
                </span>
            </section>
        </section>
        <div class="botao-rodape">
            <a href="artefatos.php" id="btn-voltar">
                <button class="btn-default">Voltar para artefatos</button>
            </a>
        </div>
    </main>

    <?php include('footer.html'); ?>

    <script src="js/script.js"></script>
    <script src="js/artefato.js"></script>
</body>

</html>