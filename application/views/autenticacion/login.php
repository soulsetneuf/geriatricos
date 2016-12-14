<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Entrar </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" /> 
        <link rel="stylesheet" type="text/css" href="assets/css_login/demo.css" />
        <link rel="stylesheet" type="text/css" href="assets/css_login/style.css" />
		<link rel="stylesheet" type="text/css" href="assets/css_login/animate-custom.css" />
    </head>
    <body>
        <div class="container">
            <!-- Codrops top bar -->
            
            <header>
            <div class="alert-success">
                        <span style="color: red;"><center >
                                <?php   
                                    if($this->session->flashdata('usuario_incorrecto'))
                                    {
                                    ?>
                                    
                                    <?php 
                                    $dato=$this->session->flashdata('usuario_incorrecto');
                                    echo '<b class="fa fa-exclamation-circle" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$dato.'</b>';
                                    }
                                ?>
                        
                            </center></span>
                    </div>     
            </header>
            <section>				
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        
                        <div id="login" class="animate form">

                            <form  action="<?php echo site_url('Auth'); ?>"  method="POST" autocomplete="on"> 
                               
                                <h1>SISTEMA DE INFORMACION DEL ADULTO MAYOR</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > Usuario :</label>
                                    <input id="username" name="username" required="required" type="text" placeholder="nombre de usuario"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p">Contraseña : </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                                </p>
                                <p class="login button"> 
                                	<input type="submit" value="Ingresar" /> 
								</p>
                                <p class="change_link">
									
								</p>
                            </form>

                        </div>
                   </div>
                </div> 

            </section>
        </div>
    </body>
</html>