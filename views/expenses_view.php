<h1>Despesas</h1>

<div class="button"><a href="<?php  echo BASE;?>/expenses/add">Adicionar Despesa</a></div>

<table border="0" width="100%">
	<tr>
		<th>Nome Descrição</th>
		<th>Data</th>
		<th>Valor</th>
		<th>Ações</th>
	</tr>
	<?php foreach($expenses_list as $expenses_item):?>
	<tr>
		<td><?php echo $expenses_item['name_desc'];?></td>
		<td><?php echo date('d/m/y', strtotime($expenses_item['date_expense']));?></td>
		<td style="text-align:right">R$ <?php echo number_format($expenses_item['price'],2,',','.');?></td>
		<td >
			<div class="button button_small"><a href="<?php echo BASE;?>/expenses/edit/<?php  echo $expenses_item['id'];?>" >Ver / Editar</a></div>
			

		</td>
	</tr>
		
	<?php  endforeach;?>
</table>
<div class="pagination">
<?php for($q=1;$q<=$p_count;$q++): ?>
	<div class="pag_item <?php echo ($q==$p)?'pag_ativo':'';?>"><a href="<?php echo BASE;?>/expenses?p=<?php echo $q;?>"><?php echo $q;?></a></div>
<?php endfor; ?>
<div style="clear:both"></div>
</div>