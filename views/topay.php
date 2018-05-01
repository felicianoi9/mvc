<h1>Contas a Pagar</h1>

<div class="button"><a href="<?php  echo BASE;?>/topay/add">Adicionar Conta a Pagar</a></div>

<table border="0" width="100%">
	<tr>
		<th>Descrição</th>
		<th>Vencimento</th>
		<th>Valor</th>
		<th>Status</th>
		<th>Ações</th>
	</tr>
	<?php foreach($topay_list as $topay_item):?>
	<tr>
		<td><?php echo $topay_item['description'];?></td>
		<td><?php echo date('d/m/y', strtotime($topay_item['maturity']));?></td>
		<td style="text-align:right">R$ <?php echo number_format($topay_item['price'],2,',','.');?></td>
		<td style="text-align:center"><?php echo ($topay_item['status']==1)?'A Pagar':'Pago';?></td>
		<td >
			<div class="button button_small"><a href="<?php echo BASE;?>/topay/edit/<?php  echo $topay_item['id'];?>" >Ver / Editar</a></div>
			

		</td>
	</tr>
		
	<?php  endforeach;?>
</table>
<div class="pagination">
<?php for($q=1;$q<=$p_count;$q++): ?>
	<div class="pag_item <?php echo ($q==$p)?'pag_ativo':'';?>"><a href="<?php echo BASE;?>/topay?p=<?php echo $q;?>"><?php echo $q;?></a></div>
<?php endfor; ?>
<div style="clear:both"></div>
</div>