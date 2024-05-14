<?php 
    namespace App\adms\Models;
    
    use App\adms\Models\helper\HConn;
    use PDO;

    class MLogin extends HConn {
        // irá receber os dados enviados da controller
        private array|null $data;
        private object $conn;
        private $resultBD;
        private $result;

        function getResult() {
            return $this->result;
        }

        public function login(array $data = null){
            $this->data = $data;
            
            $viewUser = new \App\adms\Models\helper\HRead();
            /**
             * Usando a função Exec_Read()
             * Retornará a todas as colunass presentes na tabela, que deseja consultar; 
            */
            // $viewUser->Exec_Read("tb_usuarios", "WHERE usuario =:user LIMIT :limit", "user={$this->data['user']}&limit=1");

            /**
             * Usanda a função fullRead()
             * Retornará somente as tabelas desejadas,basiacamente é o mesmo processo de uma consulta comum em SQL;
            */
            $viewUser->fullRead("SELECT id, nome, email, usuario, senha FROM tb_usuarios WHERE usuario = :user OR email =:email LIMIT :limit", "user={$this->data['user']}&email={$this->data['user']}&limit=1");

            $this->resultBD = $viewUser->getResult();
            if($this->resultBD){
                var_dump($this->resultBD);
                $this->valPassword();
            } else {
                $_SESSION['msg'] = "<p style='color:#f00'>Erro: Usuário ou Senha incorreto!</p>";
                $this->result = false;
            }
        }

        // public function login(array $data = null){
        //     $this->data = $data;
            
        //     $this->conn = $this->connectBD();

        //     // buscando por usuário espécifico no banco
        //     $validLogin = "SELECT id, nome, email, usuario, senha FROM tb_usuarios WHERE usuario = :user";
            
        //     $resultLogin = $this->conn->prepare($validLogin);
        //     $resultLogin->bindParam(':user', $this->data['user'], PDO::PARAM_STR);
        //     $resultLogin->execute();
            
        //     $this->resultBD = $resultLogin->fetch();
        //     if($this->resultBD){
        //         $this->valPassword();
        //     } else {
        //         $_SESSION['msg'] = "<p style='color:#f00'>Erro: Usuário ou Senha incorreto!</p>";
        //         $this->result = false;
        //     }
        // }

        /**
         * Confirma se a senha digitada e a senha amarzenada são as mesmas;
         * Se forem as mesmas o result é true;
         * Se não retorna uma erro para o usuário, o deixando na mesma pagina; 
        */
        private function valPassword(){
            if (password_verify($this->data["password"], $this->resultBD[0]["senha"])) {
                $_SESSION['user_id'] = $this->resultBD[0]['id'];
                $_SESSION['user_name'] = $this->resultBD[0]['nome'];
                $_SESSION['user_email'] = $this->resultBD[0]['email'];
                $_SESSION['user_usuario'] = $this->resultBD[0]['usuario'];
                $_SESSION['user_image'] = $this->resultBD[0]['foto_usuario'];
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p style='color:#f00'>Erro: Usuário ou Senha incorreto!</p>";
                $this->result = false;
            }
        }
    }
?>