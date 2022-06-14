<h3 class="mt-5 text-center">Login</h3>
<hr/>
<div class="form1">
    <div class="container-form">
        <?php 

            include "./assets/paginas/msg.php"; 

        ?>
        <form action="" method="post" name="login">
            <input type="text" name="user" class="form-control mb-3" placeholder="digite seu nome:" required/>
            <br/>
            <input type="password" name="senha" class="form-control mb-3" placeholder="digite sua senha:" required/>
            <br/>
            <button type="submit" class="btn btn-primary" name="login">Logar</button>
        </form>
    </div>
    <figure>
        <img src="./assets/img/svg/login.svg"/>
    </figure>
</div>