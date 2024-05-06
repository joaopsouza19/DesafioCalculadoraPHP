<?php
session_start();

if (!isset($_SESSION['history'])) {
    $_SESSION['history'] = array();
}

if (!isset($_SESSION['memory'])) {
    $_SESSION['memory'] = array();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function factorial($n) {
        if ($n == 0) {
            return 1;
        } else {
            return $n * factorial($n - 1);
        }
    }

    $number1 = $_POST['number1'];
    $number2 = $_POST['number2'];
    $operation = $_POST['operation'];

    switch ($operation) {
        case '+':
            $result = $number1 + $number2;
            break;
        case '-':
            $result = $number1 - $number2;
            break;
        case '*':
            $result = $number1 * $number2;
            break;
        case '/':
            if ($number2 != 0) {
                $result = $number1 / $number2;
            } else {
                $result = "Erro: divisão por zero";
            }
            break;
        case '!':
            $result = factorial($number1);
            break;
        case '^':
            $result = pow($number1, $number2);
            break;
    }

    $_SESSION['history'][] = array(
        'number1' => $number1,
        'number2' => $number2,
        'operation' => $operation,
        'result' => $result
    );
}


if (isset($_POST['memory'])) {
    $_SESSION['memory'] = array(
        'number1' => $_POST['number1'],
        'number2' => $_POST['number2'],
        'operation' => $_POST['operation']
    );
} elseif (isset($_POST['retrieve'])) {
    $_POST['number1'] = $_SESSION['memory']['number1'];
    $_POST['number2'] = $_SESSION['memory']['number2'];
    $_POST['operation'] = $_SESSION['memory']['operation'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora PHP</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="calculator">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="number1" placeholder="Número 1" value="<?php echo isset($_POST['number1']) ? $_POST['number1'] : ''; ?>" required>
            <select name="operation" required>
                <option value="+" <?php echo (isset($_POST['operation']) && $_POST['operation'] == '+') ? 'selected' : ''; ?>>+</option>
                <option value="-" <?php echo (isset($_POST['operation']) && $_POST['operation'] == '-') ? 'selected' : ''; ?>>-</option>
                <option value="*" <?php echo (isset($_POST['operation']) && $_POST['operation'] == '*') ? 'selected' : ''; ?>>*</option>
                <option value="/" <?php echo (isset($_POST['operation']) && $_POST['operation'] == '/') ? 'selected' : ''; ?>>/</option>
                <option value="!" <?php echo (isset($_POST['operation']) && $_POST['operation'] == '!') ? 'selected' : ''; ?>>n!</option>
                <option value="^" <?php echo (isset($_POST['operation']) && $_POST['operation'] == '^') ? 'selected' : ''; ?>>x^y</option>
            </select>
            <input type="text" name="number2" placeholder="Número 2" value="<?php echo isset($_POST['number2']) ? $_POST['number2'] : ''; ?>" required>
            <button type="submit">Calcular</button>
            <button type="submit" name="memory">Salvar na Memória (M)</button>
            <button type="submit" name="retrieve">Recuperar da Memória (MR)</button>
        </form>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <div class="result">
                <p>Resultado: <?php echo $result; ?></p>
            </div>
        <?php endif; ?>
        <form action="memory.php" method="post">
            <button type="submit" name="clear_history">Limpar Histórico</button>
        </form>
        <div class="history">
            <h2>Histórico</h2>
            <?php include 'history.php'; ?>
        </div>
    </div>
</body>
</html>
