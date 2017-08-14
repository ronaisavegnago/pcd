<?php
$this->load->view('header');
$this->load->view('cabecalho');
$this->load->view('menu');
?>

<main class="ls-main">
	<div class="container-fluid">
    	<h1 class="ls-title-intro ls-ico-accessibility">Extinguir Subgrupo</h1>

    	<ol class="ls-breadcrumb">
        	<li><a href="<?php echo base_url()?>">Página inicial</a></li>
        	<li><a href="<?php echo base_url('subgrupo')?>">Subgrupos</a></li>
        	<li><a href="<?php echo base_url('subgrupo/'.$codigo)?>">Subgrupo <?php echo $codigo?></a></li>
    	</ol>

    	<div class="ls-box-filter">
    		<h2>Deseja realmente extinguir este subgrupo?</h2>
			<a href="<?php echo base_url('subgrupo_c/extinguir_subgrupo/'.$codigo)?>" class="ls-btn ls-btn-danger">Extinguir</a>
    	</div>
    </div>
</main>


<?php
$this->load->view('footer');
?>