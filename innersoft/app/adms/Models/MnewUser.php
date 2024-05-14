<?php 
    namespace App\adms\Models;

    use App\adms\Models\helper\HConn;
    use PDO;

    class MnewUser extends HConn {
        // Receberá os dados enviados pela controller;
        private array|null $data;
        private object $conn;
        private $resultBD;
        private $result;
        
        function getResult() {
            return $this->result;
        }

        public function create(array $data = null){
            $this->data = $data;

            $validarCampoVazio = new \App\adms\Models\helper\HvalorCampoVazio();
            $validarCampoVazio->validaCampo($this->data);

            /**
             * O if abaixo veririfuca se o getResult do 
             * MvalorCampoVazio é true, se verdadeiro, 
             * executa os comandos para o cadastro do usuário; 
            */
            if ($validarCampoVazio->getResult()) {
                $this->valorInput();
            } else {
                $this->result = false;
            }
        }

        private function valorInput(): void {
            $validarEmail = new \App\adms\Models\helper\HvalidaEmail();
            $validarEmail->validateEmail($this->data['email']);

            $validarEmailUnico = new \App\adms\Models\helper\HvalidaEmailUnico();
            $validarEmailUnico->validateEmailSingle($this->data['email']);

            if(($validarEmail->getResult()) and ($validarEmailUnico->getResult())){
                $this->add();
            } else {
                $this->result = false;
            }
        }

        private function add(): void{
            // criptografa a senha antes de salvar no banco
            $this->data['senha'] = password_hash($this->data['senha'], PASSWORD_DEFAULT);

            $this->data['usuario'] = $this->data['email'];
            $this->data['validade'] = date("Y-m-d H:i:s"); // data e hora que foi realizado o cadastro

            $createUser = new \App\adms\Models\helper\HCreate();
            // inserie o valores do formulario no banco
            $createUser->Exec_Create("tb_usuarios", $this->data);
            if($createUser->getResult()){
                $_SESSION['msg'] = "<p style= 'color: green'>Usuário cadastrado com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p style= 'color: #f00'>Erro: Falha ao cadastrar o usuário</p>";
                $this->result = false;
            }
        }

        // public function create(array $data = null){
        //     $this->data = $data;

        //     $validarCompoVazio = new \App\adms\Models\helper\MvalorCampoVazio();
        //     $validarCompoVazio->validaCampo($this->data);
        //     if ($validarCompoVazio->getResult()){

        //         // Aqui conectamos com o banco de dados
        //         $this->conn = $this->connectBD();

        //         //criptografar uma senha antes de enviar para o banco
        //         $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
        //         var_dump($this->data);

        //         // criando o novo usuário para o BD
        //         $queryNewUser = "INSERT INTO tb_usuarios (nome, email, usuario, senha, validade) VALUES (:name, :email, :usuario, :password, NOW())";

        //         $add_new_user = $this->conn->prepare($queryNewUser);
        //         $add_new_user->bindParam(':name', $this->data['name'], PDO::PARAM_STR);
        //         $add_new_user->bindParam(':email', $this->data['email'], PDO::PARAM_STR);
        //         $add_new_user->bindParam(':usuario', $this->data['email'], PDO::PARAM_STR);
        //         $add_new_user->bindParam(':password', $this->data['password'], PDO::PARAM_STR);

        //         $add_new_user->execute();

        //         if($add_new_user->rowCount()){
        //             $_SESSION['msg'] = "<p style= 'color: green'>Usuário cadastrado com sucesso!</p>";
        //             $this->result=true;
        //         } else {
        //             $_SESSION['msg'] = "<p style= 'color: #f00'>Erro: Falha ao cadastrar o usuário</p>";
        //             $this->result=false;
        //         }
        //     } else {
        //         $this->result=false;
        //     }

        // }
    }
?>