<?php
  echo "<br> Vista";
?>
<form method="post" action="<?php echo base_url(); ?>persona/nuevo">
	<table>
		<tr>
			<td>
				<input type="text" value="nombre" name="nombre">
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="">
			</td>
		</tr>
	</table>
</form>