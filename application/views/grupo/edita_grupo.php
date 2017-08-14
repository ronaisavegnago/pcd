<?php
$this->load->view('header');
$this->load->view('cabecalho');
$this->load->view('menu');
?>

<main class="ls-main">
	<div class="container-fluid">
    	<h1 class="ls-title-intro ls-ico-accessibility">Editar Grupo</h1>

      <ol class="ls-breadcrumb">
          <li><a href="<?php echo base_url()?>">Página inicial</a></li>
          <li><a href="<?php echo base_url('grupo')?>">Grupos</a></li>
          <li><a href="<?php echo base_url('grupo/'.$grupo[0]->grupo_codigo)?>">Grupo <?php echo $grupo[0]->grupo_codigo.'/'.$grupo[0]->grupo_nome?></a></li>
      </ol>

    	<div class="ls-box-filter">
    		<form action="<?php echo base_url().'grupo_c/edita_grupo/'.$grupo[0]->grupo_codigo?>"
       			class="ls-form ls-form-horizontal" data-ls-module="form" method="POST">
       			<fieldset>
       				<p style="color:red" class="ls-label col-xs-12">(*) Campos obrigatórios</p>
       				<label class="ls-label col-md-2 col-xs-12">
		                <b class="ls-label-text">*Código</b>
		                <input type="text" name="codigo" value="<?php echo $grupo[0]->grupo_codigo?>" class="ls-field" required>
		            </label>
		            <label class="ls-label col-md-6 col-xs-12">
		                <b class="ls-label-text">*Nome</b>
		                <input type="text" name="nome" value="<?php echo $grupo[0]->grupo_nome?>" class="ls-field" required>
		            </label>
		            <label class="col-xs-4">
		            	<b>*Subclasse vinculada</b>
		            	<div class="ls-custom-select">
    						<select class="ls-select classes" name="subclasse">
    							<option value="<?php echo $grupo[0]->subclasse_subclasse_codigo?>"><?php echo $grupo[0]->subclasse_codigo.' - '.$grupo[0]->subclasse_nome?></option>
    							<?php echo $subclasses;?>
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