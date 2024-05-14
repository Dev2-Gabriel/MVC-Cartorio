<?php 
    namespace App\adms\Controllers;

    // Controller da página de sair;
    class Logout {

        // destruir as seções do usuário logado;
        public function index():void {
            unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_email'], $_SESSION['user_image'], $_SESSION['user_nickname']);
            
            $_SESSION['msg'] = "<p style='color: green'>Logout realizado com sucesso!</p>";
            $urlRedirect = URLADM . "login/index";
            header("Location: " . $urlRedirect);
        }
    }
?>