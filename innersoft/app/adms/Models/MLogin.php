<?php 
    namespace App\adms\Models;
    
    use App\adms\Models\helper\MConn;
    use PDO;

    class MLogin extends MConn {
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
            
            $this->conn = $this->connectBD();

            // buscando por usuário espécifico no banco
            $validLogin = "SELECT id, name, email, usuario FROM tb_usuarios WHERE usuario = :usuario";

            $resultLogin = $this->conn->prepare($validLogin);
            $resultLogin->bindParam(':usuario', $this->data['user'], PDO::PARAM_STR);
            $resultLogin->eecute();

            $this->resultBD = $resultLogin->fetch();
            if($this->resultBD){
                $this->valPassword();
            } else {
                $_SESSION['msg'] = "<p style='color:#f00'>Erro: Usuário ou Senha incorreto!</p>";
                $this->result = false;
            }
        }

        /**
         * Confirma se a senha digitada e a senha amarzenada são as mesmas;
         * Se forem as mesmas o result é true;
         * Se não retorna uma erro para o usuário, o deixando na mesma pagina; 
        */
        private function valPassword(){
            if (password_verify($this->data['password'], $this->resultBD['password'])) {
                $_SESSION['user_id'] = $this->resultBD['id'];
                $_SESSION['user_name'] = $this->resultBD['name'];
                $_SESSION['user_email'] = $this->resultBD['email'];
                $_SESSION['user_nickname'] = $this->resultBD['nickname'];
                $_SESSION['user_image'] = $this->resultBD['image'];
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p style='color:#f00'>Erro: Usuário ou Senha incorreto!</p>";
                $this->result = false;
            }
        }
    }
?>