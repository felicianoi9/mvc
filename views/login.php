<html>
    <head>
        <meta charset="UTF-8">
        <title>Controle de Vendas - Login </title>
        <link rel="stylesheet" href="<?php echo BASE;?>/assets/css/login.css" />
        <script type="text/javascript" src="assets/js/jquery-3.0.0.min.js"></script>
        <script type="text/javascript" src="assets/js/script.js"></script>
    </head>
    <body>
       <div class="login_area">
          <img class="login_img" src="<?php echo BASE;?>/assets/images/logo.jpg" width="270" height="80"   />
       		<form method="POST">
       			<input type="email" name="email" placeholder="Digite seu E-mail!"/>
       			<input type="password" name="password" placeholder="Digite sua senha" />
       			<input type="submit" value="Entrar" /> <br/>
            <?php if(isset($error) && !empty($error)) :?>
              <div class="warning"><?php echo $error;?></div>
            <?php endif; ?>
       		</form>

       </div> 
    </body>
</html>