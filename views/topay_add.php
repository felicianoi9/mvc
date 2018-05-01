<h1>Contas a Pagar - Adicionar</h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
	<div class="warning"><?php echo $error_msg; ?></div>
<?php endif; ?>	

<form method="POST">
	<label for="description">Descrição da despesa</label><br/>
	<input type="text" name="description" required /><br/><br/>

	<label for="maturity">Vencimento</label><br/>
	<input type="text" name="maturity" required /><br/><br/>

	<label for="n_pmt">Número de parcelas</label><br/>
	<input type="text" name="n_pmt" required /><br/><br/>

	<label for="pmt_n">Parcela de Número</label><br/>
	<input type="text" name="pmt_n" required /><br/><br/>

	<label for="price">Valor</label><br/>
	<input type="text" name="price" required /><br/><br/>

	
	<input type="submit" value="Adicionar" />

</form>
<script type="text/javascript" src="<?php echo BASE;?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE;?>/assets/js/script_topay_add.js"></script>
