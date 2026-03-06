<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - PHP / Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/login.css">
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
                    <h1>Login</h1> 
                </div>
                <div class="col mt-3">
                    <a id="button" href="./view/lending_page.php">Voltar ao início</a>
                </div>
            </div>
            <hr>
            <center><p>Faça login para acessar o sistema!</p></center>
            <hr>
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['success_message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['success_message_login'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['success_message_login']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
                <?php unset($_SESSION['success_message_login']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['error_msg'])): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <?php echo $_SESSION['error_msg']; ?>
                </div>
                <?php unset($_SESSION['error_msg']); ?>
            <?php endif; ?>
            <form class="mt-2" action="autenticacao.php" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <span class="text-center">
                    <p style="font-size:15px;">Ainda não tem uma conta? <a href="./index.php?act=create">Cadastre-se</a></p>
                </span>
                <button id="button" type="submit">Entrar</button>
            </form>
        </div>
    </section>
</body>

</html>
