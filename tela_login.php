<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['User'];
    $senha = $_POST['Password'];
    $tipo = $_POST['Tipo']; // Adicionando o campo 'Tipo' ao formulário

    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha' AND tipo = '$tipo'";
    $result = $mysqli->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Redirecionar com base no tipo de usuário
        if ($tipo == 'Admin') {
            header("Location: tela_gestor.php");
        } elseif ($tipo == 'Professor') {
            header("Location: Professor.php");
        } elseif ($tipo == 'Aluno') {
            header("Location: Aluno.php");
        }
        exit();
    } else {
        $erro = "Usuário, senha ou tipo incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/login.css">
</head>
<body>
<div class="container">
<div class="logo-title">
    <a href="tela_home.html"><img src="images/logo.png" alt="Logo da faculdade"></a>
    <div class="title">
        <h1>ACADEMIA DE DESENVOLVIMENTO E LIDERANÇA VITORIOSA - GO</h1>
    </div>
</div>
<div class="links">
    <a href="tela_home.html">Home</a>
    <a href="tela_contato.html">Contatos</a>
    <a href="tela_cursos.html">Cursos</a>
</div>
</div>
    <div class="container-login">
        <form action="" method="post">
            <h1>Login</h1>
            <label for="User">Usuário</label>
            <input type="text" name="User" placeholder="Usuário" required>
            <label for="Password">Senha</label>
            <input type="password" name="Password" placeholder="Senha de acesso" required>
            <label for="Tipo">Tipo</label>
            <select name="Tipo">
                <option value="Admin">Admin</option>
                <option value="Professor">Professor</option>
                <option value="Aluno">Aluno</option>
            </select>
            <input type="submit" value="Entrar">
        </form>
        <?php if (isset($erro)) echo "<p>$erro</p>"; ?>
    </div>
</body>
</html>
