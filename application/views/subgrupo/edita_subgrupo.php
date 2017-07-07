<?php
$this->load->view('header');
$this->load->view('cabecalho');
$this->load->view('menu');
?>

<main class="ls-main">
	<div class="container-fluid">
    	<h1 class="ls-title-intro ls-ico-accessibility">Editar Subrupo</h1>

    	<div class="ls-box-filter">
    		<form action="<?php echo base_url().'subgrupo_c/edita_subgrupo/'.$subgrupo[0]->subgrupo_codigo?>"
       			class="ls-form ls-form-horizontal" data-ls-module="form" method="POST">
       			<fieldset>
       				<p style="color:red" class="ls-label col-xs-12">(*) Campos obrigatórios</p>
       				<label class="ls-label col-md-2 col-xs-12">
		                <b class="ls-label-text">*Código</b>
		                <input type="text" name="codigo" value="<?php echo $subgrupo[0]->subgrupo_codigo?>" class="ls-field" required>
		            </label>
		            <label class="ls-label col-md-6 col-xs-12">
		                <b class="ls-label-text">*Nome</b>
		                <input type="text" name="nome" value="<?php echo $subgrupo[0]->subgrupo_nome?>" class="ls-field" required>
		            </label>
		            <label class="col-xs-4">
		            	<b>*Grupo vinculado</b>
		            	<div class="ls-custom-select">
    						<select class="ls-select classes" name="grupo">
    							<option value="<?php echo $subgrupo[0]->grupo_grupo_codigo?>"><?php echo $subgrupo[0]->grupo_codigo.' - '.$subgrupo[0]->grupo_nome?></option>
    							<?php echo $grupos;?>
    						</select>
    					</div>
    				</label>
       			</fieldset>
       			<label class="ls-label col-md-3 col-xs-12">
	            	<button class="ls-btn-primary" type="submit">Salvar</button>
	          	</label>
       		</form>
    	</div>
	</div>
</main>

<?php
$this->load->view('footer');
?>