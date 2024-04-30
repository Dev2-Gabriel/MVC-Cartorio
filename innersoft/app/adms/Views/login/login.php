<?php 
    if (isset($this->data['form'])) {
        $valorForm = $this->data['form'];
    }
?>

<h1>Área de login</h1>

<?php 
    if(isset(['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>

<form action="" method="post">
    <label>Usuário: </label>
    <input type="text" name="user" id="user" placeholder="Digite o nome de usuário" value="<?php if (isset($valorForm['user'])) {echo $valorForm['user'];}?>"> <br><br>

    <label>Senha: </label>
    <input type="password" name="pass" id="pass" placeholder="Digite a senha" value="<?php if (isset($valorForm['password'])) {echo $valorForm['password'];}?>"> <br><br>
</form>