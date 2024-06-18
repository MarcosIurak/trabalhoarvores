<?php
include __DIR__ . '/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM categorias WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $categoria = $result->fetch_assoc();
    } else {
        echo "Categoria não encontrada.";
        exit;
    }
} else {
    echo "ID da categoria não especificado.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $sql = "UPDATE categorias SET nome = '$nome', descricao = '$descricao' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Categoria atualizada com sucesso.";
    } else {
        echo "Erro ao atualizar categoria: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoria</title>
</head>
<body>
    <h2>Editar Categoria</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $categoria['id']; ?>">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $categoria['nome']; ?>"><br><br>
        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao"><?php echo $categoria['descricao']; ?></textarea><br><br>
        <input type="submit" value="Atualizar Categoria">
    </form>
</body>
</html>
