<?php
$this->load->view('header');
$this->load->view('cabecalho');
$this->load->view('menu');
?>

<main class="ls-main">
	<div class="container-fluid">
    	<h1 class="ls-title-intro ls-ico-accessibility">Subclasses</h1>

    	<div class="ls-box-filter">
    		<table class="ls-table" id="subclasse_datatable" style="text-align:center;">
    			<thead>
    				<tr>
    					<th>Código</th>
    					<th>Nome</th>
    					<th>Data de abertura</th>
                        <th>Classe vinculada</th>
                        <th>Situação</th>
    					<th>Ação</th>
    				</tr>
    			</thead>
    			<tbody>
                    <?php echo $subclasses;?>         
                </tbody>
    		</table>
    	</div>
	</div>
</main>

<?php
$this->load->view('footer');
?>