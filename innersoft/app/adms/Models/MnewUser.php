<?php 
    namespace App\adms\Models;

    use App\adms\Models\helper\MConn;

    class MnewUser extends MConn {
        // Receberá os dados enviados pela controller;
        private array|null $data;
        private object $conn;
        private $resultBD;
        private $result;
        
        function getResult() {
            return $this->result;
        }

        /**
         * 
        */
        public function create(array $data = null){
            $this->data = $data;

            $validarCampoVazio = new \App\adms\Models\helper\MvalorCampoVazio();
            $validarCampoVazio->validaCampo($this->data);

            /**
             * O if abaixo veririfuca se o getResult do 
             * MvalorCampoVazio é true, se verdadeiro, 
             * executa os comandos para o cadastro do usuário; 
            */
            if ($validarCampoVazio->getResult()) {
                // criptografa a senha antes de salvar no banco
                $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);

                $this->data['usuario'] = $this->data['email'];
                
                // $this->data['created'] = date("Y-m-d H:i:s"); // data e hora que foi realizado o cadastro

                $createUser = new \App\adms\Models\helper\MCreate();
                // inserie o valores do formulario no banco
                $createUser->Exec_Create("tb_usuarios", $this->data);

                if($createUser->getResult()){
                    $_SESSION['msg'] = "<p style= 'color: green'>Usuário cadastrado com sucesso!</p>";
                    $this->result = true;
                } else {
                    $_SESSION['msg'] = "<p style= 'color: #f00'>Erro: Falha ao cadastrar o usuário</p>";
                    $this->result = false;
                }
            } else {
                $this->result = false;
            }
        }
    }
?>