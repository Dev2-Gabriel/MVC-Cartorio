<?php 
    if (isset ($this->data['form'])){
        $valorForm = $this->data['form'];
    }
?>

<h1>Área de cadastro</h1>

<?php 
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>

<form action="" id="form-new-user" method="post">
    <label>Nome: </label>
    <input type="text" name="name" id="name" placeholder="Nome completo" required><br><br>

    <label>Email: </label>
    <input type="email" name="email" id="email" placeholder="Seu endereço de email" required> <br><br>

    <label>Senha: </label>
    <input type="password" name=password id="pass" placeholder="Informe a sua senha" required> <br><br>

    <button type="submit" name="SendNewUser" value="Cadastrar">Cadastrar</button>
</form>
<p><a href="<?php echo URLADM; ?>">Cique aqui </a>, Caso já possua um conta</p>