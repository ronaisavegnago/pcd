<?php
$this->load->view('header');
$this->load->view('cabecalho');
$this->load->view('menu');
?>

<main class="ls-main">
	<div class="container-fluid">
	<ol class="ls-breadcrumb">
        <li><a href="<?php echo base_url('classe')?>">Classes</a></li>
        <li><a href="<?php echo base_url('subclasse')?>">Subclasses</a></li>
        <li><a href="<?php echo base_url('grupo')?>">Grupos</a></li>
        <li><a href="<?php echo base_url('subgrupo')?>">Subgrupos</a></li>
    </ol>
		<div class="ls-box ls-board-box">
			<div id="sending-stats" class="row">				
				<div class="col-sm-6 col-md-3">
					<div class="ls-box">
						<div class="ls-box-head">
							<h6>Classes</h6>
						</div>
						<div class="ls-box-body">
							<span class="ls-board-data">
								<strong>
									<?php echo $count_classe?>
								</strong>
							</span>
						</div>
						<div class="ls-box-footer">
							<a href="<?php echo base_url('classe') ?>" class="ls-btn ls-btn-xs">
								Ver classes
							</a>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-3">
					<div class="ls-box">
						<div class="ls-box-head">
							<h6>Subclasses</h6>
						</div>
						<div class="ls-box-body">
							<span class="ls-board-data">
								<strong>
									<?php echo $count_subclasse?>
								</strong>
							</span>
						</div>
						<div class="ls-box-footer">
							<a href="<?php echo base_url('subclasse') ?>" class="ls-btn ls-btn-xs">
								Ver subclasses
							</a>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-3">
					<div class="ls-box">
						<div class="ls-box-head">
							<h6>Grupos</h6>
						</div>
						<div class="ls-box-body">
							<span class="ls-board-data">
								<strong>
									<?php echo $count_grupo?>
								</strong>
							</span>
						</div>
						<div class="ls-box-footer">
							<a href="<?php echo base_url('grupo') ?>" class="ls-btn ls-btn-xs">
								Ver grupos
							</a>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-3">
					<div class="ls-box">
						<div class="ls-box-head">
							<h6>Subgrupos</h6>
						</div>
						<div class="ls-box-body">
							<span class="ls-board-data">
								<strong>
									<?php echo $count_subgrupo?>
								</strong>
							</span>
						</div>
						<div class="ls-box-footer">
							<a href="<?php echo base_url('subgrupo') ?>" class="ls-btn ls-btn-xs">
								Ver subgrupos
							</a>
						</div>
					</div>
				</div>

			</div>
		</div>

		<div class="ls-box-filter">
			<!-- <a href="<?php echo base_url('Home_c/csv');?>" class="ls-btn-primary">Exportar para CSV</a> -->
			<!-- <a href="<?php echo base_url('Home_c/json');?>" class="ls-btn-primary">Exportar para JSON</a> -->
			<a href="<?php echo base_url('home/xml');?>" class="ls-btn-primary">Exportar para XML</a>
		</div>
		<div class="ls-box-filter">
			<form name="xml" action="<?php echo base_url('home/importXml')?>" enctype="multipart/form-data" class="ls-form-inline row" method="POST">
				<fieldset>
					<label>
						<input type="file" name="XMLfile" size="40" class="ls-btn">
					</label>
					<div class="ls-actions-btn">
						<button class="ls-btn-primary">Importar XML</button>
					</div>
				</fieldset>				
			</form>
		</div>

		<div class="ls-box-filter">
			<legend>Árvore de elementos do plano de classificação</legend>
			<p>Classe | Subclasse | Grupo | Subgrupo</p>
			<?php foreach($classes as $c){
				echo '<pre>';
				echo '| '.$c->classe_nome.'<br>';
				foreach($subclasses as $s){
					if($s->classe_classe_codigo == $c->classe_codigo){
						echo '&#09 | '.$s->subclasse_nome.'<br>';
						foreach($grupos as $g){
							if($g->subclasse_subclasse_codigo == $s->subclasse_codigo){
								echo '&#09&#09 | '.$g->grupo_nome.'<br>';
								foreach($subgrupos as $sg){
									if($sg->grupo_grupo_codigo == $g->grupo_codigo){
										echo '&#09&#09&#09 | '.$sg->subgrupo_nome.'<br>';
									}
								}
							}
						}
					}
				}
				echo '</pre>';
			}
			?>			
		</div>
	</div>
</main>

<?php
$this->load->view('footer');
?>