<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classe_c extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Classe_m','classe');
		$this->load->model('Subclasse_m','subclasse');
		$this->load->model('Grupo_m','grupo');
		$this->load->model('Subgrupo_m','subgrupo');
	}

	public function index(){
		$classes = $this->classe->get_classes();
		$data['classes_table'] = $this->get_table_classes($classes);
		$this->load->view('classe/classe_lista_v',$data);
	}

	public function ver($classe_codigo){
		$data['classe'] = $this->classe->get_classe_codigo($classe_codigo);
		$data['abertura'] = $this->classe->get_classe_abertura($classe_codigo);
		$data['extincao'] = $this->classe->get_classe_extinta($classe_codigo);
		$data['desativacao'] = $this->classe->get_classe_desativacao($classe_codigo);
		$data['reativacao'] = $this->classe->get_classe_reativacao($classe_codigo);
		$data['mudanca_nome'] = $this->classe->get_classe_mudancao_nome($classe_codigo);
		$this->load->view('classe/classe_ver',$data);
	}

	public function novo(){
		$this->load->view('classe/nova_classe_v');
	}

	public function add_classe(){
		$data['classe_nome'] = $this->input->post('nome');
		$data['classe_codigo'] = $this->input->post('codigo');
		$data['classe_ativa'] = 1;
		$this->classe->add_classe($data);
		$data2['data'] = date("Y-m-d");
		$data2['hora'] = date("h:m:s");
		$data2['classe_classe_codigo'] = $data['classe_codigo'];
		$this->classe->add_data_abertura($data2);
		redirect(base_url('classe'));
	}

	public function desativa($classecodigo){
		$this->classe->desativa($classecodigo);
		redirect(base_url('classe'));
	}

	public function reativa($classecodigo){
		$this->classe->reativa($classecodigo);
		redirect(base_url('classe'));	
	}

	public function edita($classecodigo){
		$data['classe'] = $this->classe->get_classe_codigo($classecodigo);
		$this->load->view('classe/edita_classe',$data);
	}

	public function edita_classe($classecodigo){
		$data['classe_nome'] = $this->input->post('nome');
		$data['classe_codigo'] = $this->input->post('codigo');
		$classe = $this->classe->get_classe_codigo($classecodigo);
		if($classe[0]->classe_nome != $this->input->post('nome')){
			$data2['data'] = date("Y-m-d");
			$data2['hora'] = date('h:m:s');
			$data2['responsavel'] = 'user';
			$data2['nome_anterior'] = $classe[0]->classe_nome;
			$data2['classe_classe_codigo'] = $this->input->post('codigo');
			$this->classe->add_mudanca_nome($data2);
		}

		$this->classe->edita_classe($classecodigo,$data);
		redirect(base_url('classe'));
	}

	public function extinguir($classecodigo){
		$data['codigo'] = $classecodigo;
		$this->load->view('classe/extinguir_classe',$data);
	}

	public function extinguir_classe($classe_codigo){
		$this->classe->desativa($classe_codigo);
		$data['data'] = date("y-m-d");
		$data['hora'] = date("h:m:s");
		$data['responsavel'] = 'user';
		$data['classe_classe_codigo'] = $classe_codigo;
		$this->classe->extinguir_classe($data);
		unset($data);
		$this->extincao_derivados($classe_codigo); //extingui subclasses,grupos e subgrupos vinculados
		redirect(base_url('classe'));
	}

	public function extincao_derivados($classe_codigo){
		$subclasses = $this->subclasse->get_subclasse_codigo_classe($classe_codigo);
		foreach($subclasses as $s){
			$grupos = $this->grupo->get_grupo_codigo_subclasse($s->subclasse_codigo);
			foreach($grupos as $g){
				$subgrupos = $this->subgrupo->get_subgrupo_codigo_grupo($g->grupo_codigo);
				foreach($subgrupos as $sg){
					$this->subgrupo->desativa($sg->subgrupo_codigo);
					$data['data'] = date("y-m-d");
					$data['hora'] = date("h:m:s");
					$data['responsavel'] = 'user';
					$data['subgrupo_subgrupo_codigo'] = $sg->subgrupo_codigo;
					$this->subgrupo->extinguir_subgrupo($data);
				}
				unset($data);
				$this->grupo->desativa($g->grupo_codigo);
				$data['data'] = date("y-m-d");
				$data['hora'] = date("h:m:s");
				$data['responsavel'] = 'user';
				$data['grupo_grupo_codigo'] = $g->grupo_codigo;
				$this->grupo->extinguir_grupo($data);
			}
			unset($data);
			$this->subclasse->desativa($s->subclasse_codigo);
			$data['data'] = date("y-m-d");
			$data['hora'] = date("h:m:s");
			$data['responsavel'] = 'user';
			$data['subclasse_subclasse_codigo'] = $s->subclasse_codigo;
			$this->subclasse->extinguir_subclasse($data);
		}
	}

	public function get_table_classes($classes){
		$td = '';
		foreach($classes as $c){
			$ext = $this->classe->get_classe_extinta($c->classe_codigo);
			if(count($ext) == 0 ){
				$ativa = ($c->classe_ativa == 1) ? '<span class="ls-tag-primary">Ativa</span>' : '<span class="ls-tag-primary">Inativa</span>';
			}else{
				$ativa = '<span class="ls-tag-danger">Extinta</span>';
			}
			$td .= '<tr>'.
					'<td>'.'<a href="'.base_url('classe/'.$c->classe_codigo).'">'.$c->classe_codigo.'</a>'.'</td>'.
					'<td>'.$c->classe_nome.'</td>'.
					'<td>'.$c->data.'</td>'.
					'<td>'.$ativa.'</td>'.
					'<td>'.
						'<div data-ls-module="dropdown" class="ls-dropdown">
                                <a href="#" class="ls-btn-primary">Ação</a>
                                <ul class="ls-dropdown-nav">'.
                                	'<li><a href="'.base_url('classe/editar/'.$c->classe_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Editar</span></a></li>'.
                                	'<li><a href="'.base_url('classe_c/desativa/'.$c->classe_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Desativar</span></a></li>'.
                                	'<li><a href="'.base_url('classe_c/reativa/'.$c->classe_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Reativar</span></a></li>'.
                                	'<li><a href="'.base_url('classe/extinguir/'.$c->classe_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Extinguir</span></a></li>'.
                                '</ul>
                            </div>'
					.'</td>'.
				'</tr>';
		}
		return $td;
	}

}