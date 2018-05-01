<h1>Compras - Adicionar</h1>

<form method="POST">
	<label for="provider_name">Nome do Fornecedor</label><br/>
	<input type="hidden" name="provider_id"/>
	<input type="text" name="provider_name" id="provider_name" data-type="search_providers" />
	<button class="provider_add_button">+</button> 
	<div style="clear:both"></div><br/>

	<label for="status">Status da Compra</label><br/>
	<select name="status" id="status">
		<option value="0">Aguardando Correios</option>
		<option value="1">Recebido</option>
		<option value="2">Cancelado</option>

	</select><br/>
	
	<h4>Produto</h4>
	<fieldset>
		<label for="name">Nome </label><br/>
		<input type="text" name="name" required /><br/><br/>

		<label for="price">Preço</label><br/>
		<input type="text" name="price" required /><br/><br/>

		<label for="quant">Quantidade</label><br/>
		<input type="number" name="quant" required /><br/><br/>

	</fieldset>
	<br/><br/>
	
	<input type="submit"  value="Adicionar Compra" />

</form>
<script type="text/javascript" src="<?php echo BASE;?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE;?>/assets/js/script_purchases_add.js"></script>
