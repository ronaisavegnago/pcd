<?php
$this->load->view('header');
$this->load->view('cabecalho');
$this->load->view('menu');
?>

<main class="ls-main">
	<div class="container-fluid">
    	<h1 class="ls-title-intro ls-ico-accessibility">Subclasse <?php echo $subclasse[0]->subclasse_codigo.'/'.$subclasse[0]->subclasse_nome?></h1>
    	<?php
    		if($subclasse[0]->subclasse_ativa == 1){
    			echo '<div class="ls-alert-info">Subclasse Ativa</div>';
    		}else{
    			echo '<div class="ls-alert-warning">Subclasse Inativa</div>';
    		}
    		if(count($extincao) == 1){
    			echo '<div class="ls-alert-danger">Subclasse Extinta</div>';
    		}
    	?>
    	<div class="row">
    		<div class="col-md-3">
    			<div class="ls-box-filter">
    				<legend>Abertura da subclasse</legend>
    				<br>
    				<p><strong>Data: </strong><?php echo $abertura[0]->data?></p>
    				<p><strong>Hora: </strong><?php echo $abertura[0]->hora?></p>
    			</div>
    		</div>
    		<?php if(count($extincao) != 0){?>
    		<div class="col-md-6">
    			<div class="ls-box-filter">
    				<legend>Extinção da subclasse</legend>
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
    				<legend>Mudança de nome da subclasse</legend>
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
    				<legend>Desativação da subclasse</legend>
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
    				<legend>Reativação da subclasse</legend>
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
    		<?php if(count($deslocamento) != 0){?>
    		<div class="col-md-12">
    			<div class="ls-box-filter">
    				<legend>Deslocamento da subclasse</legend>
    				<table class="ls-table">
						<thead>
							<tr>
						    	<th>Data</th>
						    	<th>Hora</th>
						    	<th>Responsável</th>
						    	<th>Subordinação anterior</th>
					    	</tr>
					  	</thead>
					  	<tbody>
		    			<?php
		    			$td = '';
		    				foreach($deslocamento as $m){
		    					$td = '<tr>'.
		    							'<td>'.$m->data.'</td>'.
		    							'<td>'.$m->hora.'</td>'.
		    							'<td>'.$m->responsavel.'</td>'.
		    							'<td>'.$m->subordinacao_anterior.'</td>'.
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