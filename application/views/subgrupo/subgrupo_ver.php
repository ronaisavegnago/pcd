<?php
$this->load->view('header');
$this->load->view('cabecalho');
$this->load->view('menu');
?>

<main class="ls-main">
	<div class="container-fluid">
    	<h1 class="ls-title-intro ls-ico-accessibility">Subgrupo <?php echo $subgrupo[0]->subgrupo_codigo.'/'.$subgrupo[0]->subgrupo_nome?></h1>
    	<?php
    		if($subgrupo[0]->subgrupo_ativo == 1){
    			echo '<div class="ls-alert-info">Grupo Ativo</div>';
    		}else{
    			echo '<div class="ls-alert-warning">Grupo Inativo</div>';
    		}
    		if(count($extincao) == 1){
    			echo '<div class="ls-alert-danger">Grupo Extinto</div>';
    		}
    	?>
    	<div class="row">
    		<div class="col-md-3">
    			<div class="ls-box-filter">
    				<legend>Abertura do subgrupo</legend>
    				<br>
    				<p><strong>Data: </strong><?php echo $abertura[0]->data?></p>
    				<p><strong>Hora: </strong><?php echo $abertura[0]->hora?></p>
    			</div>
    		</div>
    		<?php if(count($extincao) != 0){?>
    		<div class="col-md-6">
    			<div class="ls-box-filter">
    				<legend>Extinção do subgrupo</legend>
    				<br>
    				<p><strong>Data: </strong><?php echo $extincao[0]->data?></p>
    				<p><strong>Hora: </strong><?php echo $extincao[0]->hora?></p>
    				<p><strong>Responsável: </strong><?php echo $extincao[0]->responsavel?></p>
    			</div>
    		</div>
    		<?php } ?>
    		<?php if(count($mudanca_nome) != 0){?>
    		<div class="col-md-12">
    			<div class="ls-box-filter">
    				<legend>Mudança de nome do subgrupo</legend>
    				<table class="ls-table">
						<thead>
							<tr>
						    	<th>Data</th>
						    	<th>Hora</th>
						    	<th>Responsável</th>
						    	<th>Nome anterior</th>
					    	</tr>
					  	</thead>
					  	<tbody>
		    			<?php
		    			$td = '';
		    				foreach($mudanca_nome as $m){
		    					$td .= '<tr>'.
		    							'<td>'.$m->data.'</td>'.
		    							'<td>'.$m->hora.'</td>'.
		    							'<td>'.$m->responsavel.'</td>'.
		    							'<td>'.$m->nome_anterior.'</td>'.
		    						'</tr>';
		    						echo $td;
		    				}
		    			?>
		    			</tbody>
		    		</table>
    			</div>
    		</div>
    		<?php } ?>
    		<?php if(count($desativacao) != 0){?>
    		<div class="col-md-6">
    			<div class="ls-box-filter">
    				<legend>Desativação do subgrupo</legend>
    				<table class="ls-table">
						<thead>
							<tr>
						    	<th>Data</th>
						    	<th>Hora</th>
						    	<th>Responsável</th>
					    	</tr>
					  	</thead>
					  	<tbody>
		    			<?php
		    			$td = '';
		    				foreach($desativacao as $m){
		    					$td = '<tr>'.
		    							'<td>'.$m->data.'</td>'.
		    							'<td>'.$m->hora.'</td>'.
		    							'<td>'.$m->responsavel.'</td>'.
		    						'</tr>';
		    						echo $td;
		    				}
		    			?>
		    			</tbody>
		    		</table>
    			</div>
    		</div>
    		<?php } ?>
    		<?php if(count($reativacao) != 0){?>
    		<div class="col-md-6">
    			<div class="ls-box-filter">
    				<legend>Reativação do subgrupo</legend>
    				<table class="ls-table">
						<thead>
							<tr>
						    	<th>Data</th>
						    	<th>Hora</th>
						    	<th>Responsável</th>
					    	</tr>
					  	</thead>
					  	<tbody>
		    			<?php
		    			$td = '';
		    				foreach($reativacao as $m){
		    					$td = '<tr>'.
		    							'<td>'.$m->data.'</td>'.
		    							'<td>'.$m->hora.'</td>'.
		    							'<td>'.$m->responsavel.'</td>'.
		    						'</tr>';
		    						echo $td;
		    				}
		    			?>
		    			</tbody>
		    		</table>
    			</div>
    		</div>
    		<?php } ?>

    	</div>
    </div>
</main>

<?php
$this->load->view('footer');
?>