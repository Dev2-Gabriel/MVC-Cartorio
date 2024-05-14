<?php 
    namespace App\adms\Models\helper;

    /**
     * Nessa classe iremos colocar uma verificação de senha
     * Basicamente criaremos uma classe que irá validar as senha antes de criar um novo usuário;
    */
    class HvalidaPassword {
        private string $password;
        private bool $result;

        function getResult() {
            return $this->result;
        }
        
        /**
         * A função a seguir irá retornar um erro, caso seja encontrado:
         * - uma aspa simples;
         * - espaços em brancos;
         * 
         * Caso nenhum dos pontos exista, executamos o valExtensPassword();
        */
        public function validarPassword(string $password): void {
            $this->password = $password;

            if (stristr($this->password, "'")) {
                $_SESSION['msg'] = "<p style='color: #f00'>
                Erro: Caracter inválido, aspas simples('')</p>";
                $this->result = false;
            } else {
                if (stristr($this->password, " ")) {
                    $_SESSION['msg'] = "<p style:'color: #f00'>Erro: Sua senha não pode ter espaços em brancos!</p>";
                    $this->result = false;
                } else {
                    $this->valExtensPassword();
                }
            }
        }

        /**
         * Aqui verificamos se a possui 6 caracteres
         * Caso tenha mais de seis caracteres, é executado o valValuePassword() 
        */
        private function valExtensPassword(): void{
            if (strlen($this->password) < 6) {
                $_SESSION['msg'] = "<p style='color: #f00'>Erro: A senha deve ter no mínimo 6 caracteres!</p>";
                $this->result = false;
            } else {
                $this->valValuePassword();
            }
        }

        /**
         * Aqui é bem simples, estamos conferindo se a senha tem letras, números e caractere especiais
         * Usando a expressão regular, podemos definir quais caracteres especiais podem se utilizados   
        */
        private function valValuePassword(): void {
            if(preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9-@#$%;*]{6,}$/', $this->password)){
                $this->result = true;
            } else {
                $_SESSION['msg'] ="<p style='color: #f00;'>Erro: A senha deve ter letras e números!</p>";
                $this->result = false;
            }
        }
    }
?>