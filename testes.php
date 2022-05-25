<?php
require_once('script/conexao.php');

//Verifica existência da variável 'pagina_atual'
if (!empty($_GET['pagina_atual'])) {
    $current_page = $_GET['pagina_atual'];
} else {
    $current_page = 1;
}

//Definição da URL para paginação dos resultados da busca
if (!empty($_GET['nome'])) $url = "nome={$_GET['nome']}&";
else $url = '';

//Número de itens por página
$items_per_page = 5;

//Índice do item inicial de cada página
$start_item = $items_per_page * ($current_page - 1);

//Obtendo valores dos inputs através do GET
if (!empty($_GET['nome'])) {
    $nome = '%' . $_GET['nome'] . '%';
} else {
    $nome = '%%';
}

//Obtendo a quantidade total de linhas que é retornada com base nos parâmetros passados
$instruction = "
SELECT * FROM `testes` WHERE (`nome` LIKE :nome);
";

$statement = $database->prepare($instruction);
$statement->bindValue(':nome', $nome);
$statement->execute();

//Número total de linhas
$total_rows = $statement->rowCount();

//Obtendo a quantidade de linhas limitadas por página com base nos parâmetros passados
$instruction = "
SELECT * FROM `testes` WHERE (`nome` LIKE :nome) 
                            ORDER BY `nome` ASC
                            LIMIT $start_item, $items_per_page;
";

$statement = $database->prepare($instruction);
$statement->bindValue(':nome', $nome);
$statement->execute();

//Itens por página
$items = $statement->fetchAll(PDO::FETCH_ASSOC);

//Linhas por página
$rows_per_page = $statement->rowCount();

//Quantidade de páginas necessárias para mostrar os itens
$pages = ceil($total_rows / $items_per_page);

//Caso não houver nenhum resultado para a pesquisa o número de páginas será 0
if ($pages == 0) $current_page = 0;

//Caso 'current_page' contiver um valor inválido o usuário será redirecionado para a última página válida
if ($current_page > $pages) header("Location: testes.php?{$url}pagina_atual={$pages}");
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/testes.css">
    <title>Testes</title>
</head>

<body>
    <?php include('header.html'); ?>
    <main>
        <!-- Formulário de busca -->
        <section id="buscar">
            <form class="form-default" method="get" action="#">
                <label for="nome">Nome</label>
                <input id="nome" class="text-box-default" name="nome" type="search" placeholder="Digite o nome do artefato" value="<?= (!empty($_GET['nome'])) ? $_GET['nome'] : '' ?>">
                <button name="buscar" id="buscar" class="btn-default">
                    Buscar
                </button>
            </form>
        </section>

        <!-- Lista de testes -->
        <hr id="breakpoint">
        <section id="testes">
            <p style="text-align: center; margin-bottom: 20px;"><?= $total_rows ?> resultado(s) encontrados.</p>

            <?php
            if ($current_page == 0) {
            ?>
                <h1 class="no-results">Não foi encontrado nenhum resultado para a consulta.</h1>
                <?php
            } else {
                foreach ($items as $key => $value) {
                ?>

                    <div class="artefato">
                        <h2 class="artefato-nome">
                            <?= $value['nome'] ?>
                        </h2>
                        <div class="artefato-pontos-positivos">
                            <h3>Pontos positivos</h3>
                            <p>
                                <?= $value['pontos_positivos'] ?>
                            </p>
                        </div>
                        <div class="artefato-pontos-negativos">
                            <h3>Pontos negativos</h3>
                            <p>
                                <?= $value['pontos_negativos'] ?>
                            </p>
                        </div>
                        <div class="artefato-proposta-melhorias">
                            <h3>Propostas de melhorias</h3>
                            <p>
                                <?= $value['proposta_melhorias'] ?>
                            </p>
                        </div>
                        <div class="botoes">
                            <a href="<?= $value['aplicacao_pratica'] ?>" target="_blank">
                                <button class="btn-default">Aplicação prática</button>
                            </a>
                        </div>
                    </div>
                    <hr>
                <?php
                } //ENDFOREACH
                ?>

                <nav id="paginacao">
                    <ul>
                        <li>
                            <a href="testes.php?<?= $url ?>pagina_atual=<?= ($current_page - 1) ?>">
                                <img src="images/ic_arrow_left.png" alt="">
                            </a>
                        </li>
                        <?php
                        $right_margin = $left_margin = 3;
                        for ($page = $current_page - $left_margin; $page <= $current_page + $right_margin; $page++) {
                            if ($current_page == $page) $bt_class = 'active';
                            else $bt_class = '';

                            if ($page >= 1 && $page <= $pages) {
                        ?>
                                <li>
                                    <a class="<?= $bt_class ?>" href="testes.php?<?= $url ?>pagina_atual=<?= $page ?>">
                                        <?= $page ?>
                                    </a>
                                </li>
                        <?php
                            } //ENDIF
                        } //ENDFOR
                        ?>
                        <li>
                            <a href="testes.php?<?= $url ?>pagina_atual=<?= ($current_page + 1) ?>">
                                <img src="images/ic_arrow_right.png" alt="">
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php
            } //ENDIFELSE
            ?>
        </section>
    </main>
    <?php include('footer.html'); ?>

    <script src="js/script.js"></script>
    <script src="js/testes.js"></script>
</body>