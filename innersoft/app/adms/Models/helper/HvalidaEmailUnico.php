<?php 
    namespace App\adms\Models\helper;

    class HvalidaEmailUnico {
        private string $email;
        private bool|null $edit;
        private int|null $id;
        private bool $result;
        private array|null $resultBD;

        function getResult():bool {
            return $this->result;
        }

        public function validateEmailSingle(string $email, bool|null $edit = null, int|null $id = null): void {
            $this->email = $email;
            $this->edit = $edit;
            $this->id = $id;

            $validarEmailUnico = new \App\adms\Models\helper\HRead();
            if (($this->edit == true) and (!empty($this->id))) {
                // nessa parte do if, será utilizado posteriomente para editar informaçoes
                $validarEmailUnico->fullRead("SELECT id FROM tb_usuarios WHERE email =:email id <>:id LIMIT :limit", "email={$this->email}&id={$this->id}&limit=1");
            } else {
                $validarEmailUnico->fullRead("SELECT id FROM tb_usuarios WHERE email =:email LIMIT :limit", "email={$this->email}&limit=1");
            }

            $this->resultBD = $validarEmailUnico->getResult();
            if (!$this->resultBD) {
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Este e-mail já está cadastrado!</p>";
                $this->result = false;
            }
        }
    }
?>