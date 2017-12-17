<?php
$this->load->view('header');
$this->load->view('cabecalho');
$this->load->view('menu');
?>

<main class="ls-main">
	<div class="container-fluid">
    	<h1 class="ls-title-intro ls-ico-accessibility">Editar Subclasse</h1>

      <ol class="ls-breadcrumb">
          <li><a href="<?php echo base_url()?>">Página inicial</a></li>
          <li><a href="<?php echo base_url('subclasse')?>">Subclasses</a></li>
          <li><a href="<?php echo base_url('subclasse/'.$subclasse[0]->subclasse_codigo)?>">Subclasse <?php echo $subclasse[0]->subclasse_codigo.'/'.$subclasse[0]->subclasse_nome?></a></li>
      </ol>

    	<div class="ls-box-filter">
    		<form action="<?php echo base_url().'subclasse_c/edita_subclasse/'.$subclasse[0]->subclasse_codigo?>"
       			class="ls-form ls-form-horizontal" data-ls-module="form" method="POST">
       			<fieldset>
       				<p style="color:red" class="ls-label col-xs-12">(*) Campos obrigatórios</p>
       				<label class="ls-label col-md-2 col-xs-12">
		                <b class="ls-label-text">*Código</b>
		                <input type="text" name="codigo" value="<?php echo $subclasse[0]->subclasse_codigo?>" class="ls-field" required>
		            </label>
		            <label class="ls-label col-md-6 col-xs-12">
		                <b class="ls-label-text">*Nome</b>
		                <input type="text" name="nome" value="<?php echo $subclasse[0]->subclasse_nome?>" class="ls-field" required>
		            </label>
		            <label class="col-xs-4">
		            	<b>*Classe vinculada</b>
		            	<div class="ls-custom-select">
    						<select class="ls-select classes" name="classe">
    							<option value="<?php echo $subclasse[0]->classe_classe_codigo?>"><?php echo $subclasse[0]->classe_codigo.' - '.$subclasse[0]->classe_nome?></option>
    							<?php echo $classes;?>
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