<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?=$titulo?></title>
</head>
<body>
<h1>Crear un nuevo usuario seguro</h1>
<?=form_open(base_url().'secure_bcrypt/register_bcrypt')?>
<label>Username</label><input type="text" name="username" /><p><?=form_error('username')?></p>
<label>Password</label><input type="password" name="password" /><p><?=form_error('password')?></p>
<input type="hidden" name="token" value="<?=$token?>" />
<input type="submit" name="submit" value="Guardar" />
<?=form_close()?>
<?=anchor(base_url().'secure_bcrypt/login', 'Iniciar sesión')?>
</body>
</html>