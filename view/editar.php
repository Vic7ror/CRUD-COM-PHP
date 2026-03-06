<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/editar.css">
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="stylesheet" href="./css/buttons.css">
    <link rel="stylesheet" href="./css/header.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <title>CRUD - PHP / Editar Usuário</title>
</head>
<body>
    <header>
        <h1>CRUD - PHP</h1>
    </header>
    <section class="container-fluid">
        <div id="card">
            <div class="row text-center">
                <div class="col">
                    <h1>Editar Usuário</h1>
                </div>
                <div class="col mt-4">
                    <a id="button" href="javascript:void(0);" onclick="window.history.back();">Voltar</a>
                </div>
            </div>
            <hr>
            <form action="./index.php?act=edit" method="post">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error;
                     ?></div>
                <?php endif; ?>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['id']); ?>">
                <div class="form-group">
                    <label for="name"><b>Nome:</b></label>
                    <input type="text" class="form-control" id="name" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email"><b>Email:</b></label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="password"><b>Senha:</b></label>
                    <input type="password" class="form-control" id="password" name="senha" required>
                </div>
                <div class="form-group">
                    <label for="dt_nascimento"><b>Data de Nascimento:</b></label>
                    <input type="date" class="form-control" id="dt_nascimento" name="dt_nascimento" value="<?php echo htmlspecialchars($usuario['dt_nascimento']); ?>" required>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" id="button">Atualizar</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
