<h1>Compras</h1>

<div class="button"><a href="<?php echo BASE;?>/purchases/add">Adicionar Compra</a></div>

<table border="0" width="100%">
	<tr>
		<th>Fornecedor</th>
		<th>Data</th>
		<th>Status</th>
		<th>Valor</th>
		<th>Ações</th>
	</tr>

	<?php foreach($purchases_list as $purchase_item):?>
	<tr>
		<td><?php echo $purchase_item['name'];?></td>
		<td><?php echo date('d/m/y', strtotime($purchase_item['date_purchase']));?></td>
		<td><?php echo $statuses[$purchase_item['status']];?></td>
		<td style="text-align:right">R$ <?php echo number_format($purchase_item['total_price'],2,',','.');?></td>
		<td><div class="button button_small"><a href="<?php echo BASE;?>/purchases/edit/<?php echo $purchase_item['id'];?>" >Ver / Editar</a></div></td>
	</tr>
	<?php endforeach;?>
	
</table>