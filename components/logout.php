<?php
require_once('../int.php');
session_destroy(); //desfaz a sessao em cookie
header('Location: ../login.php?status=loggedout'); //redireciona para pagina de login