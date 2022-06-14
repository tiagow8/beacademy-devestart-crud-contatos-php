<?php

    function home(){

        include "./assets/paginas-crud/home.php";

    }

    function login(){

        if(isset($_SESSION["nome"])){

            session_start();
            header("location: /cadastro");

        }else if(isset($_POST["login"])){

                $login = file("./assets/meta-dados/usuario.csv");

                $user = $_POST["user"];
                $password = $_POST["senha"];

                    foreach($login as $usuario){

                    $usuarioInfo = explode(";", $usuario);
                    $index = 0;

                    $login = $usuarioInfo[0];
                    $senha = $usuarioInfo[1];

                    if($user == $login && $password == $senha){

                        setcookie("nome", $user, time()+60*60*7);

                        session_start();
                        $_SESSION["nome"] = $user;

                        header("location: /cadastro");

                    }else{

                        $class ="alert alert-warning";
                        $notify = "Ops! algo deu errado tente novamente: <br/> nome: Tiago <br/> senha: 12345!";

                        include "./assets/paginas-crud/login.php";

                    }
                }
            }else {

                $class = "alert alert-info";
                $notify = "Acesse seu login";

                include "./assets/paginas-crud/login.php";

            }

    }

    function cadastro(){

        $titulo = "Cadastrar Usuário";
        $btnReg = "Cadastrar";

        if(isset($_POST["cadastro"])){

            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $telefone = $_POST["telefone"];

            $arquivo = fopen("./assets/meta-dados/contatos.csv", "a+");
                fwrite($arquivo, "{$nome};{$email};{$telefone}".PHP_EOL);
                fclose($arquivo);

            $class ="alert alert-success";
            $notify = "Usuário cadastrado com sucesso.";

        }else{

            $nome = "";
            $email = "";
            $telefone = "";

            $class = "alert alert-info";
            $notify = "Cadastre seu usuário";

        }

        include "./assets/paginas-crud/cadastro.php";
    }

    function listar(){

        $contatos = file("./assets/meta-dados/contatos.csv");

        include "./assets/paginas-crud/listar.php";

    }

    function relatorios(){

        include "./assets/paginas-crud/relatorio.php";

    }

    function editar(){

        if(isset($_SESSION["nome"])){

            $id = $_GET['id'];
            $contatos = file("./assets/meta-dados/contatos.csv");

            $titulo = "Editar usuário";
            $btnReg = "Editar";


            if($_POST){

                $nome = $_POST["nome"];
                $email = $_POST["email"];
                $telefone = $_POST["telefone"];

                $contatos[$id] = "{$nome};{$email};{$telefone}".PHP_EOL;

                unlink("./assets/meta-dados/contatos.csv");

                foreach($contatos as $cadaContato){

                    $arquivo = fopen("./assets/meta-dados/contatos.csv", "a+");
                    fwrite($arquivo, $cadaContato);
                    fclose($arquivo);

                }

                $class ="alert alert-success";
                $notify = "Usuário editado com sucesso.";

            }else{

                $dados = $contatos[$id];
                $contato = explode(";", $dados);

                $nome = $contato[0];
                $email = $contato[1];
                $telefone = $contato[2];

                $class ="alert alert-warning";
                $notify = "Editar usuário.";

            }

            include "./assets/paginas-crud/cadastro.php";

        }else{

            header("location: /login");

        }

}

    function excluir(){

        if(isset($_SESSION["nome"])){

            $id = $_GET['id'];

            $contatos = file("./assets/meta-dados/contatos.csv");

            unset($contatos[$id]);

            unlink("./assets/meta-dados/contatos.csv");
            $arquivo = fopen("./assets/meta-dados/contatos.csv", "a+");

            foreach($contatos as $cadaContato){
                fwrite($arquivo, $cadaContato);
            }

            $class ="alert alert-warning";
            $notify = "Usuário excluido com sucesso.";

            include "./assets/paginas-crud/msg.php";

        }else{

            header("location: /login");

        }
    }

    function Logout(){

        if(isset($_SESSION["nome"])){

            session_destroy();

            $class ="alert alert-warning";
            $notify = "Logout realizado com sucesso.";

            include "./assets/paginas-crud/msg.php";

        }

    }

    function error404(){

        include "./assets/paginas-crud/404.php";

    }

?>