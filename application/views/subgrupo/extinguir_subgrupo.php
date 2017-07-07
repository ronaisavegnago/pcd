<?php
$this->load->view('header');
$this->load->view('cabecalho');
$this->load->view('menu');
?>

<main class="ls-main">
	<div class="container-fluid">
    	<h1 class="ls-title-intro ls-ico-accessibility">Extinguir Subgrupo</h1>
    	<div class="ls-box-filter">
    		<h2>Deseja realmente extinguir este subgrupo?</h2>
			<a href="<?php echo base_url('subgrupo_c/extinguir_subgrupo/'.$codigo)?>" class="ls-btn ls-btn-danger">Extinguir</a>
    	</div>
    </div>
</main>


<?php
$this->load->view('footer');
?>