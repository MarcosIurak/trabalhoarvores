<?php
include __DIR__ . '/db.php'; 
include __DIR__ . '/header.php'; 

$mensagem_erro = '';
$mensagem_sucesso = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id = $_POST['cliente_id'];
    $arvore_id = $_POST['arvore_id'];
    $valor_total = $_POST['valor_total'];

    $check_arvore_query = "SELECT id FROM arvores WHERE id = ?";
    $stmt_check_arvore = $conn->prepare($check_arvore_query);
    $stmt_check_arvore->bind_param("i", $arvore_id);
    $stmt_check_arvore->execute();
    $result_check_arvore = $stmt_check_arvore->get_result();

    if ($result_check_arvore->num_rows > 0) {
        $sql = "INSERT INTO vendas (cliente_id, arvore_id, quantidade_vendida, valor_total)
                VALUES (?, ?, 1, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $cliente_id, $arvore_id, $valor_total);

        if ($stmt->execute()) {
            $mensagem_sucesso = "Venda registrada com sucesso.";
        } else {
            $mensagem_erro = "Erro ao registrar a venda: " . $conn->error;
        }
    } else {
        $mensagem_erro = "Árvore não encontrada.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Venda</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   
    
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="form-container">
                    <h2 class="mb-4">Adicionar Nova Venda</h2>
                    
                    <?php if (!empty($mensagem_erro)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $mensagem_erro; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($mensagem_sucesso)): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $mensagem_sucesso; ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <label for="cliente_id">ID do Cliente:</label>
                            <input type="text" class="form-control" name="cliente_id" id="cliente_id" required>
                        </div>
                        <div class="form-group">
                            <label for="arvore_id">ID da Árvore:</label>
                            <input type="text" class="form-control" name="arvore_id" id="arvore_id" required>
                        </div>
                        <div class="form-group">
                            <label for="valor_total">Valor Total:</label>
                            <input type="text" class="form-control" name="valor_total" id="valor_total" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar Venda</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
