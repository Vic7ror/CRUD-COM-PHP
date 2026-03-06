<?php

require_once('controller/UsuarioController.php');
require_once('model/Usuario.php');
require_once('inc/config.php');

$app = new \controller\UsuarioController();

if(!isset($_GET['act']) || isset($_GET['act']) == '') {
    header('Location: ./view/lending_page.php');
}else if($_GET['act'] == 'create'){
    $app->cadastro();
} elseif ($_GET['act'] == 'edit'){
    $app->atualizarDados();
} elseif ($_GET['act'] == 'delete'){
    $app->deletarUsuario();
} elseif ($_GET['act'] == 'list'){
    $app->listar();
} elseif ($_GET['act'] == 'perfil'){
    $app->perfil();
}
