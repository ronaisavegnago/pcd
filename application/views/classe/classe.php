<?php
$this->load->view('header');
$this->load->view('cabecalho');
$this->load->view('menu');
?>

<main class="ls-main">
	<div class="container-fluid">
    	<h1 class="ls-title-intro ls-ico-accessibility">Classes</h1>
        
        <ol class="ls-breadcrumb">
            <li><a href="<?php echo base_url()?>">Página inicial</a></li>
            <li><a href="<?php echo base_url('classe/adicionar')?>">Adicionar classe</a></li>
            <li><a href="<?php echo base_url('subclasse')?>">Subclasses</a></li>
            <li><a href="<?php echo base_url('grupo')?>">Grupos</a></li>
            <li><a href="<?php echo base_url('subgrupo')?>">Subgrupos</a></li>
        </ol>
    	
        <div class="ls-box-filter">
    		<table class="ls-table" id="classe_datatable" style="text-align:center;">
    			<thead>
    				<tr>
    					<th>Código</th>
    					<th>Nome</th>
    					<th>Data de abertura</th>
                        <th>Situação</th>
						<th>Vinculo</th>
    					<th>Ação</th>
    				</tr>
    			</thead>
    			<tbody>
                    <?php
                        foreach($classes as $c){
                    ?>        
							<tr>
								<td><?php echo $c->codigo ?></td>
								<td><?php echo $c->nome ?></td>
								<td><?php echo $c->data ?></td>
								<?php if($c->ativo == 1) echo '<td>Ativa</td>';
									else echo '<td>Inativa</td>' ?>
								<td> - </td>
								<td>
									<div data-ls-module="dropdown" class="ls-dropdown">
										<a href="#" class="ls-btn-primary">Ação</a>
										<ul class="ls-dropdown-nav">
											<li>
												<a href="<?php echo base_url('classe/editar/$c->codigo') ?>">
													<span class="ls-ico-edit-admin ls-ico-left">Editar</span>
												</a>
											</li>
											
											<?php if($c->ativo == 1){ ?>
											
												<li>
													<a href="<?php echo base_url('classe/desativar/$c->codigo') ?>"">
														<span class="ls-ico-edit-admin ls-ico-left">Desativar</span>
													</a>
												
												</li>
											
											<?php } else { ?>
											
												<li>
													<a href="<?php echo base_url('classe/reativar/$c->codigo') ?>"">
														<span class="ls-ico-edit-admin ls-ico-left">Reativar</span>
													</a>
												
												</li>
											
											<?php } ?>
											
											<li>
												<a href="<?php echo base_url('classe/extinguir/$c->codigo') ?>"">
													<span class="ls-ico-edit-admin ls-ico-left">Extinguir</span>
												</a>
											</li>
										</ul>
									</div>
								</td>								
							</tr>
					<?php
                        }
                    ?>
                </tbody>
    		</table>
    	</div>
	</div>
</main>

<?php
$this->load->view('footer');
?>