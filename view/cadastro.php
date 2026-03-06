<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - PHP / Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/cadastro.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="stylesheet" href="./css/buttons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <h1>CRUD - PHP</h1>
    </header>
    <section class="container-fluid">
        <div id="card">
            <div class="row text-center">
                <div class="col">
                    <h1>Cadastro</h1>
                </div>
                <div class="col mt-3">
                    <a id="button" href="./view/lending_page.php">Voltar ao início</a>
                </div>
            </div>
            <hr>
            <center>
                <p>Faça seu cadastro para acessar o sistema!</p>
            </center>
            <hr>
            <form class="mt-2 row" action="" method="post">
                <div class="mb-3 col-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="dt_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="dt_nascimento" name="dt_nascimento" required>
                </div>
                <div class="mb-3 col">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3 col">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <div class="mb-3">
                    <span class="text-center">
                        <p style="font-size:15px;">Já tem uma conta? <a href="./login.php">Faça login</a></p>
                    </span>
                </div>
                <button id="button" type="submit">Salvar</button>
            </form>
        </div>
    </section>
</body>

</html>