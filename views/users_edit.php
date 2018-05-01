<h1>Usuários - Editar</h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
	<div class="warning"><?php echo $error_msg; ?></div>
<?php endif; ?>	

<form method="POST">
	<label for="name">Nome</label><br/>
	<input type="text" name="name" value="<?php echo $user_info['name'];?>" required /><br/><br/>

	<label for="email">E-mail</label><br/>
	<?php echo $user_info['email'];?><br/><br/>

	<label for="password">Senha</label><br/>
	<input type="password" name="password"  /><br/><br/>

	<label for="group">Grupo</label><br/>
	<select name="group" id="group">
		<?php foreach ($group_list as $g) :?>
			<option value="<?php echo $g['id'];?>" <?php echo ($g['id']==$user_info['id_group'])?'selected="selected"':'';?> ><?php echo $g['name_group'];?></option>

		<?php endforeach;?>
	</select>

	<br/><br/>

	<input type="submit" value="Editar" />

</form>