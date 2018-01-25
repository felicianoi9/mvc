<h1>Fornecedores</h1>

<?php if($edit_permission):?>
<div class="button"><a href="<?php echo BASE;?>/providers/add">Adicionar Fornecedor</a></div>
<?php endif;?>
<input type="text" id="busca" data-type="search_providers" >

<table border="0" width="100%">
	<tr>
		<th>Nome</th>
		<th>Telefone</th>
		<th>Cidade</th>
		<th>Estrelas</th>
		<th width="180">Ações</th>
	</tr>
	<?php foreach($providers_list as $cs):?>
	<tr>
		<td><?php echo $cs['name']; ?>	</td>
		<td><?php echo $cs['phone']; ?>	</td>
		<td><?php echo $cs['address_city']; ?>	</td>
		<td style="text-align:center"><?php echo $cs['stars']; ?>	</td>
		<td width="180" style="text-align:center">

			<?php if($edit_permission):?>
				<div class="button button_small"><a href="<?php echo BASE;?>/providers/edit/<?php echo $cs['id'];?>" >Editar</a></div>

				<div class="button button_small"><a href="<?php echo BASE;?>/providers/delete/<?php echo $cs['id'];?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a></div>
		
			<?php else:?>
				<div class="button button_small"><a href="<?php echo BASE;?>/providers/view/<?php echo $cs['id'];?>" >Mais Informações</a></div>

			<?php endif;?>	

			</td>
	</tr>
	<?php endforeach;?>
	
	
</table>
<div class="pagination">
<?php for($q=1;$q<=$p_count;$q++): ?>
	<div class="pag_item <?php echo ($q==$p)?'pag_ativo':'';?>"><a href="<?php echo BASE;?>/providers?p=<?php echo $q;?>"><?php echo $q;?></a></div>
<?php endfor; ?>
<div style="clear:both"></div>
</div>