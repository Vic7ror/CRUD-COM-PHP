<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/lending_page.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/buttons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <h1>CRUD - PHP</h1>
    </header>
    <section class="container-fluid">
        <div id="card">
            <h1>Bem-vindo ao CRUD - PHP</h1>
            <hr>
            <p>Este é um sistema de CRUD (Create, Read, Update, Delete) para gerenciar usuários.</p>
            <p>Feito no ensino médio pelo aluno Victor Alexandre em 2021</p>
            <hr>
            <div class="container-fluid text-center">
                <div class="row">
                    <div class="col">
                        <a id="button" href="../login.php">Login</a>
                    </div>
                    <div class="col">
                        <a id="button" href="../index.php?act=create">Cadastro</a>
                    </div>
                    <div class="col">
                        <a id="button" href="../index.php?act=list">Lista de Usuários</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>