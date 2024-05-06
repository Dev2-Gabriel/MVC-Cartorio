<?php 
    namespace Core;

    // Verifica a existencia da classe;
    // carrega a controller
    class CarregarPgAdm {
        private string $urlController;
        private string $urlMetodo;
        private string $urlParam;
        private string $classLoad;
        private array $listPgPublica;
        private array $listPgPrivada;

        private string $urlSlugController;
        private string $urlSlugMetodo;

        public function loadPage(string|null $urlController, string|null $urlMetodo, string|null $urlParam):void {
            $this->urlController = $urlController;
            $this->urlMetodo = $urlMetodo;
            $this->urlParam = $urlParam;

            // Carega as paginas publica para o usuário
            $this->pgPublica();

            if(class_exists($this->classLoad)){
                $this->loadMetodo();
            } else {
                die("Erro - ao carregar a classe: Por favor tente novamente");
            }
        }

        private function loadMetodo():void {
            $classLoad = new $this->classLoad();
            if(method_exists($classLoad, $this->urlMetodo)){
                $classLoad = new $this->classLoad();
            } else {
                die("Erro - caregar o metodo: Por favor tente novamente");
            }
        }

        // aqui será listado todas os controllers publicas para qualquer usuario
        private function pgPublica():void  {
            $this->listPgPublica = ["Login", "Erro", "Logout", "NewUser"];

            // verifica se o controller existe na listPgPublica
            if (in_array($this->urlController, $this->listPgPublica)) {
                $this->classLoad = "\\App\\adms\\Controllers\\" . $this->urlController;
            } else {
                $this->pgPrivada();
            }
        }

        // Verificar se a página é privada e chamar o método para verificar se o usuário está logado;
        private function pgPrivada():void {
            $this->listPgPrivada = ["Dashboard", "Users"];

            if (in_array($this->urlController, $this->listPgPrivada)) {
                $this->verifyLogin();
            } else {
                $_SESSION['msg'] = "<p style='color: #f00'>Erro: Página não encontrada!</p>";
                $urlRedirect = URLADM . "login/index";
                header("Location: " . $urlRedirect);
            }
        }

        // verifica se o usuário está logado
        private function verifyLogin():void {
            if (isset($_SESSION['user_id']) and (isset($_SESSION['user_id']) and $_SESSION['user_email'])) {
                $this->classLoad = "\\App\\adms\\Controllers\\" . $this->urlController;
            } else {
                $_SESSION['msg'] = "<p style='color: #f00'>Erro: Para acessar, é nescessário fazer o login!</p>";
                $urlRedirect = URLADM . "login/index";
                header("Location: " . $urlRedirect);
            }
        }

         //Corrigi a escrita da url
         private function slugController($slugController) : string {
            $this->urlSlugController = $slugController;
            // converte para minusculo
            $this->urlSlugController = strtolower($this->urlSlugController);

            // retira o traço e coloca um espaço em branco
            $this->urlSlugController = str_replace("-", " ", $this->urlSlugController);

            // converte a primeira letra de cada palavra em maiusculo
            $this->urlSlugController = ucwords($this->urlSlugController);

            // remove o espaço
            $this->urlSlugController = str_replace(" ", "", $this->urlSlugController);

            return $this->urlSlugController;
        }

        //Corrigi a escrita do metodo presente na url
        private function slugMetodo($urlSlugMetodo) : string {
            $this->urlSlugMetodo = $this->slugController($urlSlugMetodo);

            // convert a primeira letra em minusculo
            $this->urlSlugMetodo = lcfirst($this->urlSlugMetodo);

            return $this->urlSlugMetodo;
        }
    }
?>