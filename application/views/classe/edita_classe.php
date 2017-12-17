<?php
$this->load->view('header');
$this->load->view('cabecalho');
$this->load->view('menu');
?>

<main class="ls-main">
	<div class="container-fluid">
    	<h1 class="ls-title-intro ls-ico-accessibility">Editar Classe</h1>

    	<ol class="ls-breadcrumb">
        	<li><a href="<?php echo base_url()?>">Página inicial</a></li>
        	<li><a href="<?php echo base_url('classe')?>">Classes</a></li>
        	<li><a href="<?php echo base_url('classe/'.$classe[0]->classe_codigo)?>">Classe <?php echo $classe[0]->classe_codigo.'/'.$classe[0]->classe_nome?></a></li>
    	</ol>

    	<div class="ls-box-filter">
    		<form action="<?php echo base_url().'classe_c/edita_classe/'.$classe[0]->classe_codigo?>"
       			class="ls-form ls-form-horizontal" data-ls-module="form" method="POST">
       			<fieldset>
       				<p style="color:red" class="ls-label col-xs-12">(*) Campos obrigatórios</p>
       				<label class="ls-label col-md-6 col-xs-12">
		                <b class="ls-label-text">*Código</b>
		                <input type="text" name="codigo" value="<?php echo $classe[0]->classe_codigo?>" class="ls-field" required>
		            </label>
		            <label class="ls-label col-md-6 col-xs-12">
		                <b class="ls-label-text">*Nome</b>
		                <input type="text" name="nome" value="<?php echo $classe[0]->classe_nome?>" class="ls-field" required>
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