<?php
$this->load->view('header');
$this->load->view('cabecalho');
$this->load->view('menu');
?>

<main class="ls-main">
	<div class="container-fluid">
    	<h1 class="ls-title-intro ls-ico-accessibility">Nova Subclasse</h1>

      <ol class="ls-breadcrumb">
          <li><a href="<?php echo base_url()?>">Página inicial</a></li>
          <li><a href="<?php echo base_url('subclasse')?>">Subclasses</a></li>
      </ol>

    	<div class="ls-box-filter">
    		<form action="<?php echo base_url().'subclasse_c/add_subclasse/'?>"
       			class="ls-form ls-form-horizontal" data-ls-module="form" method="POST">
       			<fieldset>
       				<p style="color:red" class="ls-label col-xs-12">(*) Campos obrigatórios</p>
       				<label class="ls-label col-md-2 col-xs-12">
		                <b class="ls-label-text">*Código</b>
		                <input type="text" name="codigo" class="ls-field" required>
		            </label>
		            <label class="ls-label col-md-6 col-xs-12">
		                <b class="ls-label-text">*Nome</b>
		                <input type="text" name="nome" class="ls-field" required>
		            </label>
		            <label class="col-xs-4">
		            	<b>*Classe vinculada</b>
		            	<div class="ls-custom-select">
    						<select class="ls-select classes" name="classe">
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