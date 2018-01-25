<div class="db-row row1">
	<div class="grid-1">
		<div class="db-grid-area">
			<div class="db-grid-area-count"><?php echo  $products_sold;?></div>
			<div class="db-grid-area-legend">Produtos Vendidos</div>
		</div>
	</div>

	<div class="grid-1">
		<div class="db-grid-area">
			<div class="db-grid-area-count"><?php echo "R$ ".number_format($revenue,2,',','.');?></div>
			<div class="db-grid-area-legend">Receitas</div>
		</div>
	</div>

	<div class="grid-1">
		<div class="db-grid-area">
			<div class="db-grid-area-count"><?php echo "R$ ".number_format($expenses,2,',','.');?></div>
			<div class="db-grid-area-legend">Despesas</div>
		</div>
	</div>

</div>
<div class="db-row row2">
	<div class="grid-2">
		<div class="db-info" style="height:300px">
			<div class="db-info-title">Receitas e Despesas dos Últimos 30 dias</div>
			<div class="db-info-body">
				<canvas id="rel1"></canvas>
			</div>
		</div>
	</div>

	<div class="grid-1">
		<div class="db-info" style="height:300px">
			<div class="db-info-title">Estatus de Pagamentos</div>
			<div class="db-info-body">
				<canvas id="rel2"></canvas>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var days_list = <?php echo json_encode($days_list); ?>;
var revenue_list = <?php echo json_encode(array_values($revenue_list)); ?>;
var expenses_list = <?php echo json_encode(array_values($expenses_list)); ?>;
var status_name_list = <?php echo json_encode(array_values($statuses)); ?>;
var status_list = <?php echo json_encode(array_values($status_list)); ?>;
</script>
<script type="text/javascript" src="<?php echo BASE; ?>/assets/js/Chart.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>/assets/js/script_home.js"></script>
