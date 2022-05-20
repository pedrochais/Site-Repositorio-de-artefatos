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
                <input id="nome" class="text-box-default" name="nome" type="search" placeholder="Digite o nome do artefato">
                <label for="palavra-chave">Palavra-chave</label>
                <input id="palavra-chave" class="text-box-default" name="palavra-chave" type="text" placeholder="Digite uma ou mais chaves">
                <label for="etapa-suporte">Etapa de suporte</label>
                <select name="etapa-suporte">
                    <option value="1" selected>Qualquer um</option>
                    <option value="2">Valor 2</option>
                    <option value="3">Valor 3</option>
                </select>
                <button name="buscar" id="buscar" class="btn-default">
                    Buscar
                </button>
            </form>
        </section>

        <!-- Lista de artefatos -->
        <section id="artefatos">

        </section>
    </main>
    <?php include('footer.html'); ?>
</body>