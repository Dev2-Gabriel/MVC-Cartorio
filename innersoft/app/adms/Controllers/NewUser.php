<?php 
    namespace App\adms\Controllers;

    // Controller que se refere a criaçãoo de um novo usuário;
    class NewUser {
        /**
         * Recebe os dados que serão enviados para a view de login;
         * @var array|string|null $data;
        */
        private array|string|null $data = [];

        /**
         * Recebe os dados do formulário;
         * @var array|null $dataForm;
        */
        private array|null $dataForm;

        public function index():void {
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (!empty($this->dataForm['SendNewUser'])) {
                unset($this->dataForm['SendNewUser']);
                $createUser = new \App\adms\Models\MnewUser();
                $createUser->create($this->dataForm);
                if ($createUser->getResult()) {
                    $urlRedirect = URLADM;
                    header("Location: $urlRedirect");
                } else {
                    $this->data['form'] = $this->dataForm;
                    $this->viewNewUser();
                }
            } else {
                $this->viewNewUser();
            }

            //$this->data = null;

            //$loadView = new \Core\ConfigView("adms/Views/login/newUser", $this->data);
            //$loadView->loadView();
        }

        private function viewNewUser() {
            $loadView = new \Core\ConfigView("adms/Views/login/newUser", $this->data);
            $loadView->loadView();
        }
    }
?>