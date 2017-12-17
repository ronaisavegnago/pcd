<?php
$this->load->view('header');
$this->load->view('cabecalho');
$this->load->view('menu');
?>

<main class="ls-main">
	<div class="container-fluid">
    	<h1 class="ls-title-intro ls-ico-accessibility">Grupos</h1>

        <ol class="ls-breadcrumb">
            <li><a href="<?php echo base_url()?>">Página inicial</a></li>
            <li><a href="<?php echo base_url('grupo/adicionar')?>">Adicionar grupo</a></li>
            <li><a href="<?php echo base_url('classe')?>">Classes</a></li>
            <li><a href="<?php echo base_url('subclasse')?>">Subclasses</a></li>
            <li><a href="<?php echo base_url('subgrupo')?>">Subgrupos</a></li>
        </ol>

    	<div class="ls-box-filter">
    		<table class="ls-table" id="grupo_datatable" style="text-align:center;">
    			<thead>
    				<tr>
    					<th>Código</th>
    					<th>Nome</th>
    					<th>Data de abertura</th>
                        <th>Subclasse vinculada</th>
                        <th>Situação</th>
    					<th>Ação</th>
    				</tr>
    			</thead>
    			<tbody>
                    <?php echo $grupos;?>         
                </tbody>
    		</table>
    	</div>
	</div>
</main>

<?php
$this->load->view('footer');
?>