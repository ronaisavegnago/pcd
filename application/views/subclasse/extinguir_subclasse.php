<?php
$this->load->view('header');
$this->load->view('cabecalho');
$this->load->view('menu');
?>

<main class="ls-main">
	<div class="container-fluid">
    	<h1 class="ls-title-intro ls-ico-accessibility">Extinguir Subclasse</h1>

    	<ol class="ls-breadcrumb">
        	<li><a href="<?php echo base_url()?>">Página inicial</a></li>
        	<li><a href="<?php echo base_url('subclasse')?>">Classes</a></li>
        	<li><a href="<?php echo base_url('subclasse/'.$codigo)?>">Subclasse <?php echo $codigo?></a></li>
    	</ol>

    	<div class="ls-box-filter">
    		<h2>Deseja realmente extinguir esta subclasse?</h2>
    		<p style="color: red"><h4>Todas os grupos e subgrupos vinculados a esta subclasse também serão extintos!</h4></p>
			<a href="<?php echo base_url('subclasse_c/extinguir_subclasse/'.$codigo)?>" class="ls-btn ls-btn-danger">Extinguir</a>
    	</div>
    </div>
</main>


<?php
$this->load->view('footer');
?>