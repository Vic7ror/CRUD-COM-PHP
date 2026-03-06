<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - PHP / Lista de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/lista.css">
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="stylesheet" href="./css/buttons.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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
                    <h1>Lista de Usuários</h1> 
                </div>
                <div class="col mt-3">
                    <a id="button" href="./view/lending_page.php">Voltar ao início</a>
                </div>
            </div>
            <hr>
            <center><p>Veja abaixo a lista de usuários cadastrados no sistema!</p></center>
            <hr>
            <?php if (isset($_SESSION['success_message_list'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($_SESSION['success_message_list']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
                <?php unset($_SESSION['success_message_list']); ?>
            <?php endif; ?>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Data de Nascimento</th>
                        <th scope="col">Data de Cadastro</th>
                        <th scope="col">Data de Atualização</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usuario)): ?>
                        <?php foreach ($usuario as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['id']); ?></td>
                                <td><?php echo htmlspecialchars($user['nome']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['dt_nascimento']); ?></td>
                                <td><?php echo htmlspecialchars($user['dt_cadastro']); ?></td>
                                <td><?php echo htmlspecialchars($user['dt_atualizacao']); ?></td>
                                <td>
                                    <a class="btn btn-success" href="./index.php?act=edit&id=<?php echo $user['id']; ?>"><i class="bi bi-pen"></i></a>
                                    <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal_<?php echo $user['id']; ?>"><i class="bi bi-trash"></i></button>
                                    <div class="modal fade" id="confirmDeleteModal_<?php echo $user['id']; ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirmar exclusão</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Tem certeza que deseja excluir o usuário <?php echo htmlspecialchars($user['nome']); ?> (ID <?php echo htmlspecialchars($user['id']); ?>)?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <form action="./index.php?act=delete" method="post">
                                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                                        <input type="hidden" name="redirect" value="list">
                                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Nenhum usuário cadastrado</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>
