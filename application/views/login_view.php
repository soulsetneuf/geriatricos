<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?=$titulo?></title>
</head>
<body>
<h1>Iniciar sesión con Bcrypt</h1>
<?=form_open(base_url().'secure_bcrypt/secure_login')?>
<label>Username</label><input type="text" name="username" /><p><?=form_error('username')?></p>
<label>Password</label><input type="password" name="password" /><p><?=form_error('password')?></p>
<input type="hidden" name="token" value="<?=$token?>" />
<input type="submit" name="submit" value="Login" />
<?=form_close()?>
<?=anchor(base_url().'secure_bcrypt', 'Registrar usuario')?>
<?php
$error = $this->session->flashdata('usuario_incorrecto');
if($error)
{
    echo $error;
}
?>
</body>
</html>