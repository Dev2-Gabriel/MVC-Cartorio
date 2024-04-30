<?php 
    namespace App\adms\Controllers;

    /**
     * Controller da página de logiin
    */
    class Login {
        /**
         * Recebe os dados que serão enviados para a view de login;
         * @var array|string|null $data 
        */
        private array|string|null $data = [];

        /**
         * Recebe os dados do formulário;
         * @var array|null $dataForm 
        */
        private array|null $dataForm;

        /**
         * Instancia a classe, reponsável em carregar a view;
         * @return void
        */
        public function index() : void {
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (!empty($this->dataForm['SendLogin'])) {
                // aqui estamos consultando o BD pela model, para confirmar se o user e senha existe no BD;
                $validaLogin = new \App\adms\Models\MLogin();
                $validaLogin->login($this->dataForm);
                if ($validaLogin->getResult()) {
                    $urlRedirect = URLADM . "dashboard/index";
                    header("Location: $urlRedirect");
                } else {
                    $this->data['form'] = $this->dataForm;
                }
            }

            // this->data = null;

            $loadView = new \Core\ConfigView("adms/Views/login/login", $this->data);
            $loadView->loadView();
        }
    }
?>