<?php 
    namespace App\adms\Models\helper;

    class HvalidaEmail {
        private string $email;
        private bool $result;

        function getResult():bool {
            return $this->result;
        }

        // Aqui nós iremos validar o email do novo usuário
        public function validateEmail(string $email): void {
            $this->email = $email;
            if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: E-mail inválido!</p>";
                $this->result = false;
            }
        }
    }
?>