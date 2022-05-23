<?php
require_once('script/conexao.php');

//Verifica existência da variável 'pagina_atual'
if (!empty($_GET['pagina_atual'])) {
    $current_page = $_GET['pagina_atual'];
} else {
    $current_page = 1;
}

//Definição da URL para paginação dos resultados da busca
if (!empty($_GET['nome']) || !empty($_GET['palavra-chave']) || !empty($_GET['etapa-suporte'])) $url = "nome={$_GET['nome']}&palavra-chave={$_GET['palavra-chave']}&etapa-suporte={$_GET['etapa-suporte']}&";
else $url = '';

//Número de itens por página
$items_per_page = 5;

//Índice do item inicial de cada página
$start_item = $items_per_page * ($current_page - 1);

//Obtendo valores dos inputs através do GET
if (!empty($_GET['nome']) || !empty($_GET['palavra-chave']) || !empty($_GET['etapa-suporte'])) {
    $nome = '%' . $_GET['nome'] . '%';
    $palavra_chave = '%' . $_GET['palavra-chave'] . '%';
    $etapa_suporte = '%' . $_GET['etapa-suporte'] . '%';
} else {
    $nome = $palavra_chave = $etapa_suporte = '%%';
}

//Obtendo a quantidade total de linhas que é retornada com base nos parâmetros passados
$instruction = "
SELECT * FROM `artefatos` WHERE (`nome` LIKE :nome) 
                            AND (`descricao` LIKE :palavra_chave)
                            AND (`etapa_suporte` LIKE :etapa_suporte);
";

$statement = $database->prepare($instruction);
$statement->bindValue(':nome', $nome);
$statement->bindValue(':palavra_chave', $palavra_chave);
$statement->bindValue(':etapa_suporte', $etapa_suporte);
$statement->execute();

//Número total de linhas
$total_rows = $statement->rowCount();

//Obtendo a quantidade de linhas limitadas por página com base nos parâmetros passados
$instruction = "
SELECT * FROM `artefatos` WHERE (`nome` LIKE :nome) 
                            AND (`descricao` LIKE :palavra_chave)
                            AND (`etapa_suporte` LIKE :etapa_suporte)
                            ORDER BY `nome` ASC
                            LIMIT $start_item, $items_per_page;
";

$statement = $database->prepare($instruction);
$statement->bindValue(':nome', $nome);
$statement->bindValue(':palavra_chave', $palavra_chave);
$statement->bindValue(':etapa_suporte', $etapa_suporte);
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
if ($current_page > $pages) header("Location: artefatos.php?$url pagina_atual=$pages");
/*
print "<pre>";
print_r($items);
print "</pre>";
*/
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/artefatos.css">
    <title>Artefatos</title>
</head>

<body>
    <?php include('header.html'); ?>
    <main>
        <!-- Formulário de busca -->
        <section id="buscar">
            <form class="form-default" method="get" action="#">
                <label for="nome">Nome</label>
                <input id="nome" class="text-box-default" name="nome" type="search" placeholder="Digite o nome do artefato" value="<?= (!empty($_GET['nome'])) ? $_GET['nome'] : '' ?>">
                <label for="palavra-chave">Palavra-chave</label>
                <input id="palavra-chave" class="text-box-default" name="palavra-chave" type="text" placeholder="Digite uma ou mais chaves" value="<?= (!empty($_GET['palavra-chave'])) ? $_GET['palavra-chave'] : '' ?>">
                <label for="etapa-suporte">Etapa de suporte</label>
                <select name="etapa-suporte" >
                    <option value="" selected>Qualquer um</option>
                    <option value="Avaliação">Avaliação</option>
                    <option value="Casos de teste">Casos de teste</option>
                    <option value="Charter">Charter</option>
                    <option value="Design">Design</option>
                    <option value="Gerar relatório">Gerar relatório</option>
                    <option value="Pesquisa e planejamento">Pesquisa e planejamento</option>
                    <option value="Sessão">Sessão</option>
                </select>
                <button name="buscar" id="buscar" class="btn-default">
                    Buscar
                </button>
            </form>
        </section>

        <!-- Lista de artefatos -->
        <hr id="breakpoint">
        <section id="artefatos">
            <p style="text-align: center; margin-bottom: 20px;"><?= $total_rows ?> resultados encontrados.</p>

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
                        <div class="artefato-objetivo">
                            <h3>Objetivo</h3>
                            <p>
                                <?= $value['objetivo'] ?>
                            </p>
                        </div>
                        <div class="artefato-descricao">
                            <h3>Descrição</h3>
                            <p>
                                <?= $value['descricao'] ?>
                            </p>
                        </div>
                        <div class="artefato-funcionamento">
                            <h3>Funcionamento</h3>
                            <p>
                                <?= $value['funcionamento'] ?>
                            </p>
                        </div>
                        <div class="botoes">
                            <a href="<?= $value['base_teorica'] ?>" target="_blank">
                                <button class="btn-default">Acessar fonte</button>
                            </a>
                            <a href="<?= $value['template'] ?>" target="_blank">
                                <button class="btn-default">Template</button>
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
                            <a href="artefatos.php?<?= $url ?>pagina_atual=<?= ($current_page - 1) ?>">
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
                                    <a class="<?= $bt_class ?>" href="artefatos.php?<?= $url ?>pagina_atual=<?= $page ?>">
                                        <?= $page ?>
                                    </a>
                                </li>
                        <?php
                            } //ENDIF
                        } //ENDFOR
                        ?>
                        <li>
                            <a href="artefatos.php?<?= $url ?>pagina_atual=<?= ($current_page + 1) ?>">
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

    <script src="js/artefatos.js"></script>
</body>