<?php
// PHP Declaration
$result = null;
$error = null;
$operationName = '';
$operationSymbol = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    if (isset($_POST['clear'])) {
        $_POST = array();
        $result = null;
        $error = null;
        $operationName = '';
        $operationSymbol = '';
    } else {
        $num1 = isset($_POST['num1']) ? floatval($_POST['num1']) : 0;
        $num2 = isset($_POST['num2']) ? floatval($_POST['num2']) : 0;
        $operation = isset($_POST['operation']) ? $_POST['operation'] : '';

        // Conditional validation
        if (!is_numeric($num1)) {
            $error = "First number is invalid";
        } elseif(!is_numeric($num2)) {
            $error = "Second number is invalid";
        } elseif(empty($operation)) {
            $error = "Please select an operation first!";
        } else {
            switch ($operation) {
                case 'add':
                    $result = $num1 + $num2;
                    $operationSymbol = '+';
                    $operationName = "Addition";
                    break;
                case 'subtract':
                    $result = $num1 - $num2;
                    $operationSymbol = '-';
                    $operationName = "Subtraction";
                    break;
                case 'multiply':
                    $result = $num1 * $num2;
                    $operationSymbol = '×';
                    $operationName = "Multiplication";
                    break;
                case 'divide':
                    if ($num2 == 0) {
                        $error = "Cannot divide by zero. Please try again!";
                    } else {
                        $result = $num1 / $num2;
                        $operationSymbol = '÷';
                        $operationName = "Division";
                    }
                    break;
                default:
                    $error = "Invalid operation selected!";
            }              
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calculator</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <script src="./assets/js/sripts.js"></script>
</head>
<body>
    <div class="calculator-container">
        <h1>Simple Calculator</h1>

        <form method="POST" action="">
            <?php if (!empty($error)): ?>
                <div class="error fade-in"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <div class="input-group">
                <label for="num1">First Number</label>
                <input type="number" id="num1" name="num1" step="any" placeholder="Enter a number" 
                       value="<?php echo isset($_POST['num1']) ? htmlspecialchars($_POST['num1']) : ''; ?>">
            </div>

            <div class="input-group">
                <label for="num2">Second Number</label>
                <input type="number" id="num2" name="num2" step="any" placeholder="Enter a number" 
                       value="<?php echo isset($_POST['num2']) ? htmlspecialchars($_POST['num2']) : ''; ?>">
            </div>

            <div class="operation-buttons">
                <button type="button" class="operation-btn <?php echo (isset($_POST['operation']) && $_POST['operation'] === 'add' ? 'selected' : ''); ?>" 
                        onclick="setOperation('add')">Addition (+)</button>
                <button type="button" class="operation-btn <?php echo (isset($_POST['operation']) && $_POST['operation'] === 'subtract' ? 'selected' : ''); ?>" 
                        onclick="setOperation('subtract')">Subtraction (-)</button>
                <button type="button" class="operation-btn <?php echo (isset($_POST['operation']) && $_POST['operation'] === 'multiply' ? 'selected' : ''); ?>" 
                        onclick="setOperation('multiply')">Multiplication (×)</button>
                <button type="button" class="operation-btn <?php echo (isset($_POST['operation']) && $_POST['operation'] === 'divide' ? 'selected' : ''); ?>" 
                        onclick="setOperation('divide')">Division (÷)</button>
                <input type="hidden" id="operation" name="operation" value="<?php echo isset($_POST['operation']) ? htmlspecialchars($_POST['operation']) : ''; ?>">
            </div>

            <div class="button-group">
                <button type="submit" class="operation-btn" style="background-color: var(--accent);">
                    Calculate
                </button>
                <button type="submit" name="clear" class="operation-btn clear-btn">
                    Clear
                </button>
            </div>
        </form>

        <div id="result" class="result-container <?php echo ($result !== null && !$error) ? 'highlight fade-in' : ''; ?>">
            <?php if ($result !== null && !$error): ?>
                <strong><?php echo htmlspecialchars($operationName); ?> Result:</strong><br>
                <?php echo htmlspecialchars($_POST['num1']); ?> <?php echo htmlspecialchars($operationSymbol); ?> 
                <?php echo htmlspecialchars($_POST['num2']); ?> = <strong><?php echo htmlspecialchars($result); ?></strong>
            <?php else: ?>
                Result will appear here
            <?php endif; ?>
        </div>
    </div>
    <div class="calculator-wrapper">
    </div>
    <a href="../index.php" class="back-arrow" title="Back to Home"></a>
</div>

</body>
</html>