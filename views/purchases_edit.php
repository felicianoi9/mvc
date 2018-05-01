<h1>Compras - Editar</h1>

<strong>Nome do Fornecedor:</strong></br>
<?php echo $purchases_info['info']['provider_name'];?></br></br>

<strong>Data da Compra:</strong></br>
<?php echo date('d/m/y', strtotime($purchases_info['info']['date_purchase']));?></br></br>

<strong>Total:</strong></br>
R$ <?php echo number_format($purchases_info['info']['total_price'],2,',','.');?></br></br>

<strong>Status:</strong></br>
<?php if($permission_edit && $purchases_info['info']['status']==0 ): ?>
<form method="POST">
	<select name="status">
		<?php foreach($statuses as $statusKey => $statusValue): ?>
		<option value="<?php echo $statusKey; ?>" <?php echo ($statusKey == $purchases_info['info']['status'])?'selected="selected"':''; ?>><?php echo $statusValue; ?></option>
		<?php endforeach; ?>
	</select><br/><br/>
	<input type="submit" value="Salvar" />
</form>
<?php else: ?>
<?php echo $statuses[$purchases_info['info']['status']]; ?>
<?php endif; ?>
<br/><br/>
<hr>

<strong>Produtos:</strong></br>
<table border="0" width="100%">
	<tr>
		<th>Nome do Produto</th>
		<th>Quantidade</th>
		<th>Preço Unit.</th>
		<th>Sub-Total</th>
	</tr>

	
	<?php foreach($purchases_info['products'] as $productitem): ?>
	<tr>
		<td><?php echo $productitem['name']; ?></td>
		<td><?php echo $productitem['quant']; ?></td>
		<td>R$ <?php echo number_format($productitem['price'], 2, ',', '.'); ?></td>
		<td>R$ <?php echo number_format($productitem['price'] * $productitem['quant'], 2, ',', '.'); ?></td>
	</tr>
	<?php endforeach; ?>
	
	

</table>
