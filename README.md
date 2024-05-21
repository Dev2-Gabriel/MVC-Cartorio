Projeto eConcilia - Sistema para gestão de Câmaras de Mediação e Conciliação de Serviços Extrajudiciais
InnerSoft Tecnologia Ltda.

Descrição

Este repositório contém o código principal do projeto InnerSoft. Siga as instruções abaixo para configurar e inicializar o projeto corretamente.
Configuração
Configuração do Banco de Dados

É necessário configurar o arquivo de configuração do projeto para conectar ao banco de dados. Edite o arquivo core/Config.php conforme necessário:

    Senha do Banco de Dados:

    php

define('PASS', ''); // Insira a senha do banco de dados entre as aspas simples

URL do Projeto:

php

    define('URL', 'http://localhost/innersoft');
    define('URLADM', 'http://localhost/innersoft/');

    Substitua 'localhost' pelo endereço da hospedagem do site.

Inicialização do Projeto

Para inicializar o projeto, execute o seguinte comando no terminal dentro do diretório do projeto:

composer update

Exemplo de caminho no terminal (windows):
C:\Users\Você\Desktop\innersoft> composer update

Atualizações Recentes
06/05/2024

    Adicionada a capacidade de inserir dados do formulário de cadastro de usuários no banco de dados.
    Criado um arquivo JavaScript na pasta assets para validar os dados dos formulários de login e cadastro de usuários.

14/05/2024

    Adicionada uma nova aba para comparação de e-mails, onde é feito um comparativo entre o e-mail que será cadastrado e os e-mails já existentes no banco de dados.
    Implementada verificação de senha no arquivo JavaScript, exigindo pelo menos 6 caracteres.
