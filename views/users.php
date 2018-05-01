<h1>Usuários</h1>
<div class="button"><a href="<?php echo BASE;?>/users/add">Adicionar Usuário</a></div>		
<table border="0" width="100%">
	<tr>
		<th>Nome</th>
		<th>E-mail</th>
		<th>Grupo de Permissões</th>
		<th width="180">Ações</th>
	</tr>
	
	<?php foreach($users_list as $us):?>
	<tr>
		<td><?php echo utf8_encode($us['name']); ?>	</td>
		<td><?php echo $us['email']; ?>	</td>
		<td><?php echo $us['name_group']; ?>	</td>
		<td width="180">

			<div class="button button_small"><a href="<?php echo BASE;?>/users/edit/<?php echo $us['id'];?>" >Editar</a></div>

			<div class="button button_small"><a href="<?php echo BASE;?>/users/delete/<?php echo $us['id'];?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a></div>
		</td>
	</tr>
	<?php endforeach;?>
</table>