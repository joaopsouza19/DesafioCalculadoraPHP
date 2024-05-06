<?php
if (isset($_SESSION['history'])) {
    foreach ($_SESSION['history'] as $operation) {
        echo "<p>";
        echo "{$operation['number1']} {$operation['operation']} {$operation['number2']} = {$operation['result']}";
        echo "</p>";
    }
} else {
    echo "<p>Nenhum histórico disponível.</p>";
}
?>
