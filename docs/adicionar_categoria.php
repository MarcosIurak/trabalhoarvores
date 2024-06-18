<?php
include __DIR__ . '/header.php';
include __DIR__ . '/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
   

    $sql = "INSERT INTO categorias (nome) VALUES ('$nome')";

    if ($conn->query($sql) === TRUE) {
        echo "Categoria cadastrada com sucesso!";
    } else {
        echo "Erro ao cadastrar categoria: " . $conn->error;
    }
}
?>

<form method="post">
    <div class="form-group">
        <label for="nome">Nome da Categoria:</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar Categoria</button>
</form>
