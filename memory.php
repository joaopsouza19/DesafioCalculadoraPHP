<?php
session_start();

if (isset($_POST['save'])) {
    $_SESSION['memory'] = array(
        'number1' => $_POST['number1'],
        'number2' => $_POST['number2'],
        'operation' => $_POST['operation']
    );
} elseif (isset($_POST['retrieve']) && isset($_SESSION['memory'])) {
    $_POST['number1'] = $_SESSION['memory']['number1'];
    $_POST['number2'] = $_SESSION['memory']['number2'];
    $_POST['operation'] = $_SESSION['memory']['operation'];
} elseif (isset($_POST['clear_history'])) {
    unset($_SESSION['history']);
}

header('Location: Calculadora.php');
exit;
?>
