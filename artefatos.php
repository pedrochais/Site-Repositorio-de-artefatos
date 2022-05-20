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
                    <option value="2">Opção 1</option>
                    <option value="3">Opção 2</option>
                    <option value="4">Opção 2</option>
                </select>
                <button name="buscar" id="buscar" class="btn-default">
                    Buscar
                </button>
            </form>
        </section>

        <!-- Lista de artefatos -->
        <section id="artefatos">
            <div class="artefato">
                <h2 class="artefato-nome">Guia de cenários de testes exploratórios</h2>
                <div class="artefato-objetivo">
                    <h3>Objetivo</h3>
                    <p>Apresentar um relatório detalhado ao final de cada seção.</p>
                </div>
                <div class="artefato-descricao">
                    <h3>Descrição</h3>
                    <p>Há campos como: objetivo da missão, área dos testes, ambiente dos testes, testador, duração do teste, defeitos encontrados etc.</p>
                </div>
                <div class="botoes">
                    <button>Acessar fonte</button>
                    <button>Template</button>
                </div>
            </div>
            <hr>
            <div class="artefato">
                <h2 class="artefato-nome">Guia de cenários de testes exploratórios</h2>
                <div class="artefato-objetivo">
                    <h3>Objetivo</h3>
                    <p>Apresentar um relatório detalhado ao final de cada seção.</p>
                </div>
                <div class="artefato-descricao">
                    <h3>Descrição</h3>
                    <p>Há campos como: objetivo da missão, área dos testes, ambiente dos testes, testador, duração do teste, defeitos encontrados etc.</p>
                </div>
                <div class="botoes">
                    <button>Acessar fonte</button>
                    <button>Template</button>
                </div>
            </div>
            <nav id="paginacao">
                <ul>
                    <li><img src="images/ic_arrow_left.png" alt=""></li>
                    <li>1</li>
                    <li>2</li>
                    <li>3</li>
                    <li>4</li>
                    <li>5</li>
                    <li><img src="images/ic_arrow_right.png" alt=""></li>
                </ul>
            </nav>
        </section>
    </main>
    <?php include('footer.html'); ?>
</body>