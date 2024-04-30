<?php 
    echo "Essa é página de deshoboard";
    echo $this->data . " " . $_SESSION['user_name'] . "!<br>";
    echo "<a href='" . URLADM . "'>Sair</a><br>";
?>