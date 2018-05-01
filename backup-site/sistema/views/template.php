<html>
    <head>
        <meta charset="UTF-8">
        <title>Painel - <?php echo $viewData['company_name']; ?></title>
        <link rel="stylesheet" href="<?php echo BASE;?>/assets/css/template.css" />
        <script type="text/javascript" src="<?php echo BASE;?>/assets/js/jquery-3.0.0.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE;?>/assets/js/script.js"></script>
    </head>
    <body>
        <div class="leftmenu">
            <div class="company_name"><?php echo $viewData['company_name'];?></div>
            
            <div class="menu_area">
                <ul>
                    <li><a href="<?php echo BASE;?>/">Home</a></li>
                    <li><a href="<?php echo BASE;?>/permissions">Permissões</a></li>
                </ul>
            </div>
        </div>

        <div class="container">
            <div class="top" >
                <div class="top_right"><a href="<?php echo BASE.'/login/logout';?>">Sair</a></div>
                <div class="top_right"><?php echo $viewData['user_email'];?></div>
                
            </div>
            <div class="area">
                <?php  $this->loadViewInTemplate($viewName, $viewData); ?>
            </div>    
                
            <div></div>
        </div>

        
    </body>
</html>