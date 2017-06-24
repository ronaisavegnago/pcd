<?php
$this->load->view('header');
$this->load->view('cabecalho');
$this->load->view('menu');
?>

<main class="ls-main">
	<div class="container-fluid">
    	<h1 class="ls-title-intro ls-ico-accessibility">Classes</h1>

    	<div class="ls-box-filter">
    		<table class="ls-table" id="classe_datatable" style="text-align:center;">
    			<thead>
    				<tr>
    					<th>Código</th>
    					<th>Nome</th>
    					<th>Data de abertura</th>
                        <th>Situação</th>
    					<th>Ação</th>
    				</tr>
    			</thead>
    			<tbody>
                    <?php echo $classes_table;?>         
                </tbody>
    		</table>
    	</div>
	</div>
</main>

<?php
$this->load->view('footer');
?>