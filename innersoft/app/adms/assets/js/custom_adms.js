const formLogin = document.getElementById("form-login")
const formNewUser = document.getElementById("form-new-user")

if (formNewUser) {
    formNewUser.addEventListener("submit", async(e) => {
        // recebendo os valores do form-new-user
        let name = document.getElementById("name").value
        let email = document.getElementById("email").value
        let password = document.getElementById("password").value

        /**
         * Os ifs abaixo irão verificar se os campos do formulário foram preenchido corretamente;
         */
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>É nescessário preencher o campo: Nome</p>";
            return
        }

        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>É nescessário preencher o campo: E-mail</p>";
            return
        }

        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>É nescessário preencher o campo: Senha</p>";
            return
        }
    })
}

if (formLogin) {
    formLogin.addEventListener("submit", async(e) => {
        // recebendo os dados do formLogin
        let user = document.getElementById("user").value 
        let password = document.getElementById("password").value

        /**
         * Os ifs abaixo irão verificar se os campos do formulário foram preenchido corretamente;
         */
        if (user === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>É nescessário preencher o campo: Usuário</p>";
            return
        }

        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>É nescessário preencher o campo: Senha</p>";
            return
        }
    })   
}