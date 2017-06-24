<?php
$this->load->view('header');
$this->load->view('cabecalho');
$this->load->view('menu');
?>

<main class="ls-main">
	<div class="container-fluid">
    	<h1 class="ls-title-intro ls-ico-accessibility">Extinguir Classe</h1>
    	<div class="ls-box-filter">
    		<h2>Deseja realmente extinguir esta classe?</h2>
    		<p style="color: red"><h4>Todas as subclasses, grupos e subgrupos vinculados a esta classe também serão extintos!</h4></p>
			<a href="<?php echo base_url('classe_c/extinguir_classe/'.$codigo)?>" class="ls-btn ls-btn-danger">Extinguir</a>
    	</div>
    </div>
</main>


<?php
$this->load->view('footer');
?>