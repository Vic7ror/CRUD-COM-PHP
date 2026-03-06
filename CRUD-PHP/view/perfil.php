<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD-PHP / Perfil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/perfil.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="stylesheet" href="./css/buttons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header>
        <h1>CRUD - PHP</h1>
    </header>

    <section class="container-fluid">
        <div id="card">
            <div class="row" id="card-header">
                <div class="col">
                    <h2>Meu Perfil</h2>
                </div>
                <div class="col">
                    <a id="button" href="./logout.php">Sair da conta</a>
                </div>
            </div>
            <hr>
            <div id="card-body">
                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo htmlspecialchars($_SESSION['success_message']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>
                <?php if (isset($usuario) && is_array($usuario)): ?>
                    <p><b>Nome:</b> <?php echo htmlspecialchars($usuario['nome']); ?></p>
                    <p><b>Email:</b> <?php echo htmlspecialchars($usuario['email']); ?></p>
                    <p><b>Data de Nascimento:</b> <?php echo htmlspecialchars($usuario['dt_nascimento'] ?? ''); ?></p>
                    <p><b>Última atualização:</b> <?php echo htmlspecialchars($usuario['dt_atualizacao'] ?? ''); ?></p>
                    <div class="row">
                        <div class="col">
                            <a href="?act=edit&id=<?php echo htmlspecialchars($usuario['id']); ?>" class="action" id="button">Editar conta</a>
                        </div>
                        <div class="col">
                            <a href="#" class="action" id="button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Excluir a conta</a>
                        </div>
                    </div>
                    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirmar exclusão</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>
                                <div class="modal-body">
                                    Tem certeza que deseja excluir sua conta? Esta ação é irreversível.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="./index.php?act=delete" method="post">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['id']); ?>">
                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning" role="alert">
                        Não foi possível carregar os dados do usuário.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>


</body>

</html>
