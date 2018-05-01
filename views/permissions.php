<h1>Permissões</h1>
<div class="tabarea">
	<div class="tabitem activetab">Grupo de Permissões</div>
	<div class="tabitem">Permissões</div>
</div>
<div class="tabcontent">
	<div class="tabbody">
		<div class="button"><a href="<?php echo BASE;?>/permissions/add_group">Adicionar Grupo de Permissões</a></div>		
		<table border="0" width="100%">
			<tr>
				<th>Nome do Grupo de Permições</th>
				<th width="180">Ações</th>
			</tr>
			<?php foreach ($permissions_group_list as $p) : ?>
			<tr>
				<td><?php echo $p['name_group'] ;?>	</td>
				<td width="180">

					<div class="button button_small"><a href="<?php echo BASE;?>/permissions/edit_group/<?php echo $p['id'];?>" >Editar</a></div>

					<div class="button button_small"><a href="<?php echo BASE;?>/permissions/delete_group/<?php echo $p['id'];?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a></div>

				</td>
			</tr>
			<?php endforeach;?>
		</table>
	</div>
	<div class="tabbody">
		<div class="button"><a href="<?php echo BASE;?>/permissions/add">Adicionar Permissão</a></div>		
		<table border="0" width="100%">
			<tr>
				<th>Nome da Permissão</th>
				<th>Nome em Português</th>
				<th width="50">Ações</th>
			</tr>
			<?php foreach ($permissions_list as $p) : ?>
			<tr>
				<td><?php echo $p['name']; ;?>	</td>
				<td><?php echo utf8_encode($p['name2']);?>	</td>
				<td width="50"><div class="button button_small"><a href="<?php echo BASE;?>/permissions/delete/<?php echo $p['id'];?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a></div></td>
			</tr>
			<?php endforeach;?>
		</table>
	</div>


</div>