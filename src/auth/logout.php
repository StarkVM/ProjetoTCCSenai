<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';
session_destroy();
header("Location: ../home/code.php");
exit;
?>