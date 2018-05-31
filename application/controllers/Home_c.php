<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_c extends CI_Controller {

	public function __construct(){

		parent::__construct();

	}

	public function index(){

		$this->load->view('home_v');

	}

	




	/*public function __construct(){
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

		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename="'.'pcd.xml'.'"');
		header('Content-Type: application/octet-stream');
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: ' . filesize($ponteiro));
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Expires: 0');

		$xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
		$xml .= "<classes> \n";

		$xml .= $this->xml_return_classe($classe);
		$xml .= $this->xml_return_subclasse($subclasse);
		$xml .= $this->xml_return_grupo($grupo);
		$xml .= $this->xml_return_subgrupo($subgrupo);



		$xml .= "</classes>";

		$ponteiro = fopen('pcd'.date("d-m-y").'.xml'."-".date("h-i:s"),'w');
		fwrite($ponteiro, $xml);
		readfile($ponteiro);
		$ponteiro = fclose($ponteiro);
		redirect(base_url());
	}

	public function importXml(){
		$config['upload_path'] = './upload/';
		$config['allowed_types'] = 'xml|json|csv';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$this->load->library('upload', $config);

		if(!$this->upload->do_upload('XMLfile')){
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		}else{
			$data2 = array('upload_data' => $this->upload->data());
			$xml = simplexml_load_file(base_url('upload/'.$data2['upload_data']['file_name']));
			
			echo '<pre>';
			print_r($xml);
			echo '</pre>';	

			foreach($xml as $x){
				if($x->classe_codigo){
					$data['classe_codigo'] = $x->classe_codigo;
					$data['classe_nome'] = $x->classe_nome;
					$data['classe_ativa'] = 1;
					$data['classe_subordinacao'] = '';
					$this->classe->add_classe($data);
					unset($data);

					$data['data'] = $x->registro_abertura->data;
					$data['hora'] = $x->registro_abertura->hora;
					$data['responsavel'] = $x->registro_abertura->responsavel;
					$data['classe_classe_codigo'] = $x->classe_codigo;
					$this->classe->add_data_abertura($data);
					unset($data);

					if($x->registro_desativacao){
						foreach($x->registro_desativacao as $rd){
							$data['data'] = $rd->data;
							$data['hora'] = $rd->hora;
							$data['responsavel'] = $rd->responsavel;
							$data['classe_classe_codigo'] = $x->classe_codigo;
							$this->classe->insere_desativacao($data);
							unset($data);
						}
					}

					if($x->registro_reativacao){
						foreach($x->registro_reativacao as $rc){
							$data['data'] = $rc->data;
							$data['hora'] = $rc->hora;
							$data['responsavel'] = $rc->responsavel;
							$data['classe_classe_codigo'] = $x->classe_codigo;
							$this->classe->insere_reativacao($data);
							unset($data);	
						}
					}

					if($x->registro_extincao){
						$data['data'] = $x->registro_extincao->data;
						$data['hora'] = $x->registro_extincao->hora;
						$data['responsavel'] = $x->registro_extincao->responsavel;
						$data['classe_classe_codigo'] = $x->classe_codigo;
						$this->classe->extinguir_classe($data);
						unset($data);	
					}

					if($x->registro_mudanca_nome){
						foreach($x->registro_mudanca_nome as $nc){
							$data['data'] = $nc->data;
							$data['hora'] = $nc->hora;
							$data['responsavel'] = $nc->responsavel;
							$data['nome_anterior'] = $nc->nome_anterior;
							$data['classe_classe_codigo'] = $x->classe_codigo;
							$this->classe->add_mudanca_nome($data);
							unset($data);
						}
					}

					$this->classe->set_status($x->classe_codigo);
				}

				if($x->subclasse_codigo){
					$data['subclasse_codigo'] = $x->subclasse_codigo;
					$data['subclasse_nome'] = $x->subclasse_nome;
					$data['subclasse_ativa'] = 1;
					$data['classe_classe_codigo'] = $this->classe->get_classe_codigo2($x->subclasse_subordinacao);
					$this->subclasse->add_subclasse($data);
					unset($data);


					$data['data'] = $x->registro_abertura->data;
					$data['hora'] = $x->registro_abertura->hora;
					$data['responsavel'] = $x->registro_abertura->responsavel;
					$data['subclasse_subclasse_codigo'] = $x->subclasse_codigo;
					$this->subclasse->add_abertura($data);
					unset($data);

					if($x->registro_extincao){
						$data['data'] = $x->registro_extincao->data;
						$data['hora'] = $x->registro_extincao->hora;
						$data['responsavel'] = $x->registro_extincao->responsavel;
						$data['subclasse_subclasse_codigo'] = $x->subclasse_codigo;
						$this->subclasse->extinguir_subclasse($data);
						unset($data);
					}

					if($x->registro_desativacao){
						foreach($x->registro_desativacao as $r){
							$data['data'] = $r->data;
							$data['hora'] = $r->hora;
							$data['responsavel'] = $r->responsavel;
							$data['subclasse_subclasse_codigo'] = $x->subclasse_codigo;
							$this->subclasse->add_registro_desativacao($data);
							unset($data);
						}
					}

					if($x->registro_reativacao){
						foreach($x->registro_reativacao as $r){
							$data['data'] = $r->data;
							$data['hora'] = $r->hora;
							$data['responsavel'] = $r->responsavel;
							$data['subclasse_subclasse_codigo'] = $x->subclasse_codigo;
							$this->subclasse->add_registro_reativacao($data);
							unset($data);
						}
					}

					if($x->registro_mudanca_nome){
						foreach($x->registro_mudanca_nome as $r){
							$data['data'] = $r->data;
							$data['hora'] = $r->hora;
							$data['responsavel'] = $r->responsavel;
							$data['nome_anterior'] = $r->nome_anterior;
							$data['subclasse_subclasse_codigo'] = $x->subclasse_codigo;
							$this->subclasse->add_mudanca_nome($data);
							unset($data);
						}
					}

					if($x->registro_deslocamento){
						foreach($x->registro_deslocamento as $r){
							$data['data'] = $r->data;
							$data['hora'] = $r->hora;
							$data['responsavel'] = $r->responsavel;
							$data['subordinacao_anterior'] = $r->subordinacao_anterior;
							$data['subclasse_subclasse_codigo'] = $x->subclasse_codigo;
							$this->subclasse->deslocamento_subclasse($data);
							unset($data);
						}
					}

					$this->classe->set_status($x->subclasse_codigo);
				}

				if($x->grupo_codigo){
					$data['grupo_codigo'] = $x->grupo_codigo;
					$data['grupo_nome'] = $x->grupo_nome;
					$data['grupo_ativo'] = 1;
					$data['subclasse_subclasse_codigo'] = $this->subclasse->get_subclasse_codigo2($x->grupo_subordinacao);
					$this->grupo->add_grupo($data);
					unset($data);

					$data['data'] = $x->registro_abertura->data;
					$data['hora'] = $x->registro_abertura->hora;
					$data['responsavel'] = $x->registro_abertura->responsavel;
					$data['grupo_grupo_codigo'] = $x->grupo_codigo;
					$this->grupo->add_abertura($data);
					unset($data);

					if($x->registro_extincao){
						$data['data'] = $x->registro_extincao->data;
						$data['hora'] = $x->registro_extincao->hora;
						$data['responsavel'] = $x->registro_extincao->responsavel;
						$data['grupo_grupo_codigo'] = $x->grupo_codigo;
						$this->grupo->add_extincao($data);
						unset($data);
					}

					if($x->registro_desativacao){
						foreach($x->registro_desaticavao as $r){
							$data['data'] = $r->data;
							$data['hora'] = $r->hora;
							$data['responsavel'] = $r->responsavel;
							$data['grupo_grupo_codigo'] = $x->grupo_codigo;
							$this->grupo->add_desativacao($data);
							unset($data);
						}	
					}

					if($x->registro_deslocamento){
						foreach($x->registro_deslocamento as $r){
							$data['data'] = $r->data;
							$data['hora'] = $r->hora;
							$data['responsavel'] = $r->responsavel;
							$data['subordinacao_anterior'] = $r->subordinacao_anterior;
							$data['grupo_grupo_codigo'] = $x->grupo_codigo;
							$this->grupo->add_deslocamento($data);
							unset($data);
						}
					}

					if($x->registro_mudanca_nome){
						foreach($x->registro_mudanca_nome as $m){
							$data['data'] = $m->data;
							$data['hora'] = $m->hora;
							$data['responsavel'] = $m->responsavel;
							$data['nome_anterior'] = $m->subordinacao_anterior;
							$data['grupo_grupo_codigo'] = $x->grupo_codigo;
							$this->grupo->add_mudanca_nome($data);
							unset($data);
						}
					}

					if($x->registro_reativacao){
						foreach($x->registro_reativacao as $r){
							$data['data'] = $r->data;
							$data['hora'] = $r->hora;
							$data['responsavel'] = $r->responsavel;
							$data['grupo_grupo_codigo'] = $x->grupo_codigo;
							$this->grupo->add_registro_reativacao($data);
							unset($data);
						}
					}

					$this->classe->set_status($x->grupo_codigo);
				}

				if($x->subgrupo_codigo){
					$data['subgrupo_codigo'] = $x->subgrupo_codigo;
					$data['subgrupo_nome'] = $x->subgrupo_nome;
					$data['subgrupo_ativo'] = 1;
					$data['grupo_grupo_codigo'] = $this->grupo->get_grupo_codigo2($x->subgrupo_subordinacao);
					$this->subgrupo->add_subgrupo($data);
					unset($data);

					$data['data'] = $x->registro_abertura->data;
					$data['hora'] = $x->registro_abertura->hora;
					$data['responsavel'] = $x->registro_abertura->responsavel;
					$data['subgrupo_subgrupo_codigo'] = $x->subgrupo_codigo;
					$this->subgrupo->add_abertura($data);
					unset($data);

					if($x->registro_extincao){
						$data['data'] = $x->registro_abertura->data;
						$data['hora'] = $x->registro_abertura->hora;
						$data['responsavel'] = $x->registro_abertura->responsavel;
						$data['subgrupo_subgrupo_codigo'] = $x->subgrupo_codigo;
						// $this->subgrupo->add_extincao($data);
						unset($data);
					}

					if($x->registro_desaticavao){
						foreach($registro_desativacao as $r){
							$data['data'] = $r->data;
							$data['hora'] = $r->hora;
							$data['responsavel'] = $r->responsavel;
							$data['subgrupo_subgrupo_codigo'] = $x->subgrupo_codigo;
							$this->subgrupo->add_desativacao($data);
							unset($data);
						}
					}

					if($x->registro_deslocamento){
						foreach($x->registro_deslocamento as $r){
							$data['data'] = $r->data;
							$data['hora'] = $r->hora;
							$data['responsavel'] = $r->responsavel;
							$data['subordinacao_anterior'] = $r->subordinacao_anterior;
							$data['subgrupo_subgrupo_codigo'] = $x->subgrupo_codigo;
							$this->subgrupo->add_deslocamento($data);
							unset($data);
						}
					}

					if($x->registro_mudanca_nome){
						foreach($x->registro_mudanca_nome as $m){
							$data['data'] = $m->data;
							$data['hora'] = $m->hora;
							$data['responsavel'] = $m->responsavel;
							$data['nome_anterior'] = $m->subordinacao_anterior;
							$data['subgrupo_subgrupo_codigo'] = $x->subgrupo_codigo;
							$this->subgrupo->add_mudanca_nome($data);
							unset($data);
						}
					}

					if($x->registro_reativacao){
						foreach($x->registro_reativacao as $r){
							$data['data'] = $r->data;
							$data['hora'] = $r->hora;
							$data['responsavel'] = $r->responsavel;
							$data['subgrupo_subgrupo_codigo'] = $x->subgrupo_codigo;
							$this->subgrupo->add_reativacao($data);
							unset($data);
						}
					}

					$this->classe->set_status($x->subgrupo_codigo);
				}
			}
		}
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
						$xml .= "\t\t<registro_reativacao>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t</registro_reativacao>\n\n";
					}
				unset($reativacao);
				}

				$mudanca_nome = $this->classe->get_classe_mudancao_nome($c->classe_codigo);
				if(count($mudanca_nome) > 0){
					foreach($mudanca_nome as $m){
						$xml .= "\t\t<registro_mudanca_nome>\n";
						$xml .= "\t\t\t<data>".$m->data."</data>\n";
						$xml .= "\t\t\t<hora>".$m->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$m->responsavel."</responsavel>\n";
						$xml .= "\t\t\t<nome_anterior>".$m->nome_anterior."</nome_anterior>\n";
						$xml .= "\t\t</registro_mudanca_nome>\n\n";
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
						$xml .= "\t\t<registro_reativacao>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t</registro_reativacao>\n\n";
					}
				}
				unset($reativacao_subclasse);

				$registro_mudanca_nome_subclasse = $this->subclasse->get_subclasse_mudanca_nome($s->subclasse_codigo);
				if(count($registro_mudanca_nome_subclasse) > 0){
					foreach($registro_mudanca_nome_subclasse as $r){
						$xml .= "\t\t<registro_mudanca_nome>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t\t<nome_anterior>".$r->nome_anterior."</nome_anterior>\n";
						$xml .= "\t\t</registro_mudanca_nome>\n\n";
					}
				}
				unset($registro_mudanca_nome_subclasse);

				$deslocamento = $this->subclasse->get_subclasse_deslocamento($s->subclasse_codigo);
				foreach($deslocamento as $d){
					$xml .= "\t\t<registro_deslocamento>\n";
					$xml .= "\t\t\t<data>".$d->data."</data>\n";
					$xml .= "\t\t\t<hora>".$d->hora."</hora>\n";
					$xml .= "\t\t\t<responsavel>".$d->responsavel."</responsavel>\n";
					$xml .= "\t\t\t<subordinacao_anterior>".$d->subordinacao_anterior."</subordinacao_anterior>\n";
					$xml .= "\t\t</registro_deslocamento>\n\n";
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
						$xml .= "\t\t<registro_reativacao>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t</registro_reativacao>\n\n";
					}
				}
				unset($reativacao_grupo);

				$registro_mudanca_nome_grupo = $this->grupo->get_grupo_mudanca_nome($s->grupo_codigo);
				if(count($registro_mudanca_nome_grupo) > 0){
					foreach($registro_mudanca_nome_grupo as $r){
						$xml .= "\t\t<registro_mudanca_nome>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t\t<nome_anterior>".$r->nome_anterior."</nome_anterior>\n";
						$xml .= "\t\t</registro_mudanca_nome>\n\n";
					}
				}
				unset($registro_mudanca_nome_grupo);

				$deslocamento = $this->grupo->get_grupo_deslocamento($s->grupo_codigo);
				foreach($deslocamento as $d){
					$xml .= "\t\t<registro_deslocamento>\n";
					$xml .= "\t\t\t<data>".$d->data."</data>\n";
					$xml .= "\t\t\t<hora>".$d->hora."</hora>\n";
					$xml .= "\t\t\t<responsavel>".$d->responsavel."</responsavel>\n";
					$xml .= "\t\t\t<subordinacao_anterior>".$d->subordinacao_anterior."</subordinacao_anterior>\n";
					$xml .= "\t\t</registro_deslocamento>\n\n";
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
						$xml .= "\t\t<registro_reativacao>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t</registro_reativacao>\n\n";
					}
				}
				unset($reativacao_subgrupo);

				$registro_mudanca_nome_subgrupo = $this->subgrupo->get_subgrupo_mudanca_nome($s->subgrupo_codigo);
				if(count($registro_mudanca_nome_subgrupo) > 0){
					foreach($registro_mudanca_nome_subgrupo as $r){
						$xml .= "\t\t<registro_mudanca_nome>\n";
						$xml .= "\t\t\t<data>".$r->data."</data>\n";
						$xml .= "\t\t\t<hora>".$r->hora."</hora>\n";
						$xml .= "\t\t\t<responsavel>".$r->responsavel."</responsavel>\n";
						$xml .= "\t\t\t<nome_anterior>".$r->nome_anterior."</nome_anterior>\n";
						$xml .= "\t\t</registro_mudanca_nome>\n";
					}
				}
				unset($registro_mudanca_nome_subgrupo);

				$deslocamento = $this->subgrupo->get_subgrupo_deslocamento($s->subgrupo_codigo);
				foreach($deslocamento as $d){
					$xml .= "\t\t<registro_deslocamento>\n";
					$xml .= "\t\t\t<data>".$d->data."</data>\n";
					$xml .= "\t\t\t<hora>".$d->hora."</hora>\n";
					$xml .= "\t\t\t<responsavel>".$d->responsavel."</responsavel>\n";
					$xml .= "\t\t\t<subordinacao_anterior>".$d->subordinacao_anterior."</subordinacao_anterior>\n";
					$xml .= "\t\t</registro_deslocamento>\n\n";
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
	}*/

}
