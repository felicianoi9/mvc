<h1>Visualizar e Editar Receita </h1>

<fieldset>
	<h3>Descrição da Receita</h3>
	<label><?php echo $revenue['info']['name_desc'];?></label><br/>

	<h3>Data</h3>
	<label><?php echo date('d/m/y', strtotime($revenue['info']['date_revenue']));?></label><br/>
	
	<h3>Valor total</h3>
	<label>R$<?php echo number_format($revenue['info']['total_price'],2,',','.');?></label><br/><br/>
</fieldset>
<br/><br/>
<fieldset>
	<h3>Produtos</h3>
	<table width="100%">
		<tr>
			<th>Nome</th>
			<th>Quantidade</th>
			<th>Preço </th>
		</tr>
		<?php foreach($revenue['products'] as $itemkey => $item):?>

		<?php //echo '<pre>';print_r($item);exit;?>
			<tr>
				<td><?php echo ($item!='')?$item['name']:'---';?></td>
				<td><?php echo ($item!='')?$item['quant']:'---';?></td>
				<td><?php echo ($item!='')?$item['sale_price']:'---';?></td>
			</tr>
		<?php endforeach;?>


	</table>
	<br/><br/>
</fieldset>