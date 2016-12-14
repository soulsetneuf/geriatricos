<?php
$hidden = array('admin_id' => $admin_id);
echo form_open(base_url()."adulto_mayor/registrar_usuario", '', $hidden);
?>

<?php echo form_label('Nombre :'); ?> <br />
<?php echo form_input(array('name' => 'nombre')); ?><br />
<?php echo form_label('Contraseña :'); ?> <br /><br />
<?php echo form_input(array('name' => 'Contrasena')); ?><br />
<?php echo form_label('Repetir Contraseña :'); ?> <br />
<?php echo form_input(array('name' => 'Repetir Contrasena')); ?><br />
<?php
echo form_submit('mysubmit', 'Guardar');
echo form_close();
?>


<form class="pure-form">
	<fieldset>
		<legend>Confirm password with HTML5</legend>

		<input type="password" placeholder="Password" id="password" required>
		<input type="password" placeholder="Confirm Password" id="confirm_password" required>

		<button type="submit" class="pure-button pure-button-primary">Confirm</button>
	</fieldset>
</form>
<script>
	var password = document.getElementById("password")
		, confirm_password = document.getElementById("confirm_password");

	function validatePassword(){
		if(password.value != confirm_password.value) {
			confirm_password.setCustomValidity("Password incorrecto");
		} else {
			confirm_password.setCustomValidity('');
		}
	}
	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;
</script>
