<h1>Visualizar e Editar Despesas </h1>

<fieldset>
	<h3>Descrição da Despesa</h3>
	<label><?php echo $expense['info']['name_desc'];?></label><br/>

	<h3>Data</h3>
	<label><?php echo date('d/m/y', strtotime($expense['info']['date_expense']));?></label><br/>
	
	<h3>Valor total</h3>
	<label>R$<?php echo number_format($expense['info']['price'],2,',','.');?></label><br/><br/>
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
		<tr>
			<td><?php echo ($expense['products']!='')?$expense['products']['name']:'---';?></td>
			<td><?php echo ($expense['products']!='')?$expense['products']['quant']:'---';?></td>
			<td><?php echo ($expense['products']!='')?$expense['products']['price']:'---';?></td>
		</tr>



	</table>
	<br/><br/>
</fieldset>