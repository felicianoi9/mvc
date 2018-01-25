<h1>Despesa - Adicionar</h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
	<div class="warning"><?php echo $error_msg; ?></div>
<?php endif; ?>	

<form method="POST">
	<label for="name_desc">Descrição da despesa</label><br/>
	<input type="text" name="name_desc" required /><br/><br/>

	<label for="price">Valor</label><br/>
	<input type="text" name="price" required /><br/><br/>

	

	

	<input type="submit" value="Adicionar" />

</form>
<script type="text/javascript" src="<?php echo BASE;?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE;?>/assets/js/script_expenses_add.js"></script>
