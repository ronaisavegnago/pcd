<?php
$this->load->view('header');
$this->load->view('cabecalho');
$this->load->view('menu');
?>

<main class="ls-main">
	<div class="container-fluid">
    	<h1 class="ls-title-intro ls-ico-accessibility">Extinguir Grupo</h1>
    	<div class="ls-box-filter">
    		<h2>Deseja realmente extinguir este grupo?</h2>
    		<p style="color: red"><h4>Todas os subgrupos vinculados a este grupo também serão extintos!</h4></p>
			<a href="<?php echo base_url('grupo_c/extinguir_grupo/'.$codigo)?>" class="ls-btn ls-btn-danger">Extinguir</a>
    	</div>
    </div>
</main>


<?php
$this->load->view('footer');
?>