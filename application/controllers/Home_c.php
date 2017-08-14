<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_c extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Classe_m','classe');
		$this->load->model('Subclasse_m','subclasse');
		$this->load->model('Grupo_m','grupo');
		$this->load->model('Subgrupo_m','subgrupo');
	}

	public function index(){
		$data['count_classe'] = $this->classe->count();
		$data['count_subclasse'] = $this->subclasse->count();
		$data['count_grupo'] = $this->grupo->count();
		$data['count_subgrupo'] = $this->subgrupo->count();

		$data['classes'] = $this->classe->get_classes();
		$data['subclasses'] = $this->subclasse->get_subclasses();
		$data['grupos'] = $this->grupo->get_grupos();
		$data['subgrupos'] = $this->subgrupo->get_subgrupos();

		$this->load->view('home_v',$data);
	}

	public function xml(){
		$classe = $this->classe->get_classes();
		$subclasse = $this->subclasse->get_subclasses();
		$grupo = $this->grupo->get_grupos();
		$subgrupo = $this->subgrupo->get_subgrupos();

		$xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
		$xml .= "<classes> \n";

		$xml .= $this->xml_return_classe($classe);
		$xml .= $this->xml_return_subclasse($subclasse);
		$xml .= $this->xml_return_grupo($grupo);
		$xml .= $this->xml_return_subgrupo($subgrupo);



		$xml .= "</classes>";

		$ponteiro = fopen('pcd.xml'.date("d-m-y")."-".date("h-i:s"),'w');
		fwrite($ponteiro, $xml);
		$ponteiro = fclose($ponteiro);
		redirect(base_url());
	}

	public function xml_return_classe($classe){
		$xml = '';

		if(count($classe) > 0){
			foreach($classe as $c){
				$xml .= "\t<classe>\n";
				$xml .= "\t\t<classe_codigo>".$c->classe_codigo."</classe_codigo>\n";
				$xml .= "\t\t<classe_nome>".$c->classe_nome."</classe_nome>\n";
				$xml .= "\t\t<classe_subordinacao>".$c->classe_subordinacao."</classe_subordinacao>\n\n";

				$registro_abertura = $this->classe->get_classe_abertura($c->classe_codigo);
				$xml .= "\t\t<registro_abertura>\n";
				$xml .= "\t\t\t<data>".$registro_abertura[0]->data."</data>\n";
				$xml .= "\t\t\t<hora>".$registro_abertura[0]->hora."</hora>\n";
				$xml .= "\t\t\t<responsavel>".$registro_abertura[0]->responsavel."</responsavel>\n";
				$xml .= "\t\t</registro_abertura>\n\n";
				unset($registro_abertura);

				
				$desativacao = $this->classe->get_classe_desativacao($c->classe_codigo);
				if(count($desativacao) > 0){
					foreach($desativacao as $d){
						$xml .= "\t\t<registro_desativacao>\n";
						$xml .= "\t\t\t<data>".$d->data."</data>\n";
						$xml .= "\t\t\t<hora>".$d->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$d->responsavel."</responsavel>\n";
						$xml .= "\t\t</registro_desativacao>\n\n";
					}
				unset($desativacao);
				}

				$reativacao = $this->classe->get_classe_reativacao($c->classe_codigo);
				if(count($reativacao) > 0){
					foreach($reativacao as $r){
						$xml .= "\t\t<reativacao_classe>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t</reativacao_classe>\n\n";
					}
				unset($reativacao);
				}

				$mudanca_nome = $this->classe->get_classe_mudancao_nome($c->classe_codigo);
				if(count($mudanca_nome) > 0){
					foreach($mudanca_nome as $m){
						$xml .= "\t\t<registro_mudanca_nome_classe>\n";
						$xml .= "\t\t\t<data>".$m->data."</data>\n";
						$xml .= "\t\t\t<hora>".$m->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$m->responsavel."</responsavel>\n";
						$xml .= "\t\t\t<nome_anterior>".$m->nome_anterior."</nome_anterior>\n";
						$xml .= "\t\t</registro_mudanca_nome_classe>\n\n";
					}
				}
				unset($mudanca_nome);

				$extincao = $this->classe->get_classe_extinta($c->classe_codigo);
				if(count($extincao) > 0){
					$xml .= "\t\t<registro_extincao>\n";
					$xml .= "\t\t\t<data>".$extincao[0]->data."</data>\n";
					$xml .= "\t\t\t<hora>".$extincao[0]->hora."</hora>\n";
					$xml .= "\t\t\t<responsavel>".$extincao[0]->responsavel."</responsavel>\n";
					$xml .= "\t\t</registro_extincao>\n\n";
				}
				unset($extincao);

				$xml .= "\t</classe>\n\n";
			}
		}

		return $xml;
	}

	public function xml_return_subclasse($subclasse){
		$xml = '';

		if(count($subclasse) > 0){
			foreach($subclasse as $s){
				$xml .= "\t<subclasse>\n";

				$xml .= "\t\t<subclasse_codigo>".$s->subclasse_codigo."</subclasse_codigo>\n";
				$xml .= "\t\t<subclasse_nome>".$s->subclasse_nome."</subclasse_nome>\n";
				$xml .= "\t\t<subclasse_subordinacao>".$s->classe_nome."</subclasse_subordinacao>\n\n";

				$registro_abertura = $this->subclasse->get_subclasse_abertura($s->subclasse_codigo);
				foreach($registro_abertura as $r){
					$xml .= "\t\t<registro_abertura>\n";
					$xml .= "\t\t\t<data>".$r->data."</data>\n";
					$xml .= "\t\t\t<codigo>".$r->hora."</codigo>\n";
					$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
					$xml .= "\t\t</registro_abertura>\n\n";
				}
				unset($registro_abertura);

				$registro_desativacao = $this->subclasse->get_subclasse_desativacao($s->subclasse_codigo);
				if(count($registro_desativacao) > 0){
					foreach($registro_desativacao as $r){
						$xml .= "\t\t<registro_desativacao>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t</registro_desativacao>\n\n";
					}
				}
				unset($registro_desativacao);

				$reativacao_subclasse = $this->subclasse->get_subclasse_reativacao($s->subclasse_codigo);
				if(count($reativacao_subclasse) > 0){
					foreach($reativacao_subclasse as $r){
						$xml .= "\t\t<reativacao_subclasse>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t</reativacao_subclasse>\n\n";
					}
				}
				unset($reativacao_subclasse);

				$registro_mudanca_nome_subclasse = $this->subclasse->get_subclasse_mudanca_nome($s->subclasse_codigo);
				if(count($registro_mudanca_nome_subclasse) > 0){
					foreach($registro_mudanca_nome_subclasse as $r){
						$xml .= "\t\t<registro_mudanca_nome_subclasse>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t\t<nome_anterior>".$r->nome_anterior."</nome_anterior>\n";
						$xml .= "\t\t</registro_mudanca_nome_subclasse>\n\n";
					}
				}
				unset($registro_mudanca_nome_subclasse);

				$deslocamento = $this->subclasse->get_subclasse_deslocamento($s->subclasse_codigo);
				foreach($deslocamento as $d){
					$xml .= "\t\t<registro_deslocamento_subclasse>\n";
					$xml .= "\t\t\t<data>".$d->data."</data>\n";
					$xml .= "\t\t\t<hora>".$d->hora."</hora>\n";
					$xml .= "\t\t\t<responsavel>".$d->responsavel."</responsavel>\n";
					$xml .= "\t\t\t<subordinacao_anterior>".$d->subordinacao_anterior."</subordinacao_anterior>\n";
					$xml .= "\t\t</registro_deslocamento_subclasse>\n\n";
				}
				unset($deslocamento);

				$registro_extincao = $this->subclasse->get_subclasse_extinta($s->subclasse_codigo);
				if(count($registro_extincao) > 0){
					foreach($registro_extincao as $r){
						$xml .= "\t\t<registro_extincao>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t</registro_extincao>\n\n";
					}
				}
				unset($registro_extincao);
				$xml .= "\t</subclasse>\n\n";
			}
		}

		return $xml;
	}

	public function xml_return_grupo($grupo){
		$xml = '';

		if(count($grupo) > 0){
			foreach($grupo as $s){
				$xml .= "\t<grupo>\n";

				$xml .= "\t\t<grupo_codigo>".$s->grupo_codigo."</grupo_codigo>\n";
				$xml .= "\t\t<grupo_nome>".$s->grupo_nome."</grupo_nome>\n";
				$xml .= "\t\t<grupo_subordinacao>".$s->subclasse_nome."</grupo_subordinacao>\n\n";

				$registro_abertura = $this->grupo->get_grupo_abertura($s->grupo_codigo);
				foreach($registro_abertura as $r){
					$xml .= "\t\t<registro_abertura>\n";
					$xml .= "\t\t\t<data>".$r->data."</data>\n";
					$xml .= "\t\t\t<codigo>".$r->hora."</codigo>\n";
					$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
					$xml .= "\t\t</registro_abertura>\n\n";
				}
				unset($registro_abertura);

				$registro_desativacao = $this->grupo->get_grupo_desativacao($s->grupo_codigo);
				if(count($registro_desativacao) > 0){
					foreach($registro_desativacao as $r){
						$xml .= "\t\t<registro_desativacao>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t</registro_desativacao>\n\n";
					}
				}
				unset($registro_desativacao);

				$reativacao_grupo = $this->grupo->get_grupo_reativacao($s->grupo_codigo);
				if(count($reativacao_grupo) > 0){
					foreach($reativacao_grupo as $r){
						$xml .= "\t\t<reativacao_grupo>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t</reativacao_grupo>\n\n";
					}
				}
				unset($reativacao_grupo);

				$registro_mudanca_nome_grupo = $this->grupo->get_grupo_mudanca_nome($s->grupo_codigo);
				if(count($registro_mudanca_nome_grupo) > 0){
					foreach($registro_mudanca_nome_grupo as $r){
						$xml .= "\t\t<registro_mudanca_nome_grupo>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t\t<nome_anterior>".$r->nome_anterior."</nome_anterior>\n";
						$xml .= "\t\t</registro_mudanca_nome_grupo>\n\n";
					}
				}
				unset($registro_mudanca_nome_grupo);

				$deslocamento = $this->grupo->get_grupo_deslocamento($s->grupo_codigo);
				foreach($deslocamento as $d){
					$xml .= "\t\t<registro_deslocamento_grupo>\n";
					$xml .= "\t\t\t<data>".$d->data."</data>\n";
					$xml .= "\t\t\t<hora>".$d->hora."</hora>\n";
					$xml .= "\t\t\t<responsavel>".$d->responsavel."</responsavel>\n";
					$xml .= "\t\t\t<subordinacao_anterior>".$d->subordinacao_anterior."</subordinacao_anterior>\n";
					$xml .= "\t\t</registro_deslocamento_grupo>\n\n";
				}
				unset($deslocamento);

				$registro_extincao = $this->grupo->get_grupo_extinto($s->grupo_codigo);
				if(count($registro_extincao) > 0){
					foreach($registro_extincao as $r){
						$xml .= "\t\t<registro_extincao>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t</registro_extincao>\n\n";
					}
				}
				unset($registro_extincao);
				$xml .= "\t</grupo>\n\n";
			}
		}

		return $xml;
	}

	public function xml_return_subgrupo($subgrupo){
		$xml = '';

		if(count($subgrupo) > 0){
			foreach($subgrupo as $s){
				$xml .= "\t<subgrupo>\n";

				$xml .= "\t\t<subgrupo_codigo>".$s->subgrupo_codigo."</subgrupo_codigo>\n";
				$xml .= "\t\t<subgrupo_nome>".$s->subgrupo_nome."</subgrupo_nome>\n";
				$xml .= "\t\t<subgrupo_subordinacao>".$s->grupo_nome."</subgrupo_subordinacao>\n\n";

				$registro_abertura = $this->subgrupo->get_subgrupo_abertura($s->subgrupo_codigo);
				foreach($registro_abertura as $r){
					$xml .= "\t\t<registro_abertura>\n";
					$xml .= "\t\t\t<data>".$r->data."</data>\n";
					$xml .= "\t\t\t<codigo>".$r->hora."</codigo>\n";
					$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
					$xml .= "\t\t</registro_abertura>\n\n";
				}
				unset($registro_abertura);

				$registro_desativacao = $this->subgrupo->get_subgrupo_desativacao($s->subgrupo_codigo);
				if(count($registro_desativacao) > 0){
					foreach($registro_desativacao as $r){
						$xml .= "\t\t<registro_desativacao>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t</registro_desativacao>\n\n";
					}
				}
				unset($registro_desativacao);

				$reativacao_subgrupo = $this->subgrupo->get_subgrupo_reativacao($s->subgrupo_codigo);
				if(count($reativacao_subgrupo) > 0){
					foreach($reativacao_subgrupo as $r){
						$xml .= "\t\t<reativacao_subgrupo>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t</reativacao_subgrupo>\n\n";
					}
				}
				unset($reativacao_subgrupo);

				$registro_mudanca_nome_subgrupo = $this->subgrupo->get_subgrupo_mudanca_nome($s->subgrupo_codigo);
				if(count($registro_mudanca_nome_subgrupo) > 0){
					foreach($registro_mudanca_nome_subgrupo as $r){
						$xml .= "\t\t<registro_mudanca_nome_subgrupo>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t\t<nome_anterior>".$r->nome_anterior."</nome_anterior>\n";
						$xml .= "\t\t</registro_mudanca_nome_subgrupo>\n";
					}
				}
				unset($registro_mudanca_nome_subgrupo);

				$deslocamento = $this->subgrupo->get_subgrupo_deslocamento($s->subgrupo_codigo);
				foreach($deslocamento as $d){
					$xml .= "\t\t<registro_deslocamento_subgrupo>\n";
					$xml .= "\t\t\t<data>".$d->data."</data>\n";
					$xml .= "\t\t\t<hora>".$d->hora."</hora>\n";
					$xml .= "\t\t\t<responsavel>".$d->responsavel."</responsavel>\n";
					$xml .= "\t\t\t<subordinacao_anterior>".$d->subordinacao_anterior."</subordinacao_anterior>\n";
					$xml .= "\t\t</registro_deslocamento_subgrupo>\n\n";
				}
				unset($deslocamento);

				$registro_extincao = $this->subgrupo->get_subgrupo_extinto($s->subgrupo_codigo);
				if(count($registro_extincao) > 0){
					foreach($registro_extincao as $r){
						$xml .= "\t\t<registro_extincao>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t</registro_extincao>\n\n";
					}
				}
				unset($registro_extincao);
				$xml .= "\t</subgrupo>\n\n";
			}
		}

		return $xml;
	}

}
