<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subclasse_c extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Classe_m','classe');
		$this->load->model('Subclasse_m','subclasse');
		$this->load->model('Grupo_m','grupo');
		$this->load->model('Subgrupo_m','subgrupo');
	}

	public function index(){
		$data['subclasses'] = $this->get_table_subclasses($this->subclasse->get_subclasses());
		$this->load->view('subclasse/subclasse_lista',$data);
	}

	public function novo(){
		$data['classes'] = $this->classe_select($this->classe->get_classes_ativas());
		$this->load->view('subclasse/nova_subclasse',$data);
	}

	public function add_subclasse(){
		$data['subclasse_codigo'] = $this->input->post('codigo');
		$data['subclasse_nome'] = $this->input->post('nome');
		$data['subclasse_ativa'] = 1;
		$data['classe_classe_codigo'] = $this->input->post('classe');
		$this->subclasse->add_subclasse($data);
		$data2['data'] = date("Y-m-d");
		$data2['hora'] = date("h:m:s");
		$data2['responsavel'] = 'user';
		$data2['subclasse_subclasse_codigo'] = $data['subclasse_codigo'];
		$this->subclasse->add_abertura($data2);
		redirect(base_url('subclasse'));
	}


	public function edita($subclassecodigo){
		$data['subclasse'] = $this->subclasse->get_subclasse_codigo($subclassecodigo);
		$data['classes'] = $this->classe_select($this->classe->get_classes_ativas());
		$this->load->view('subclasse/edita_subclasse',$data);
	}

	public function edita_subclasse($subclassecodigo){
		$data['subclasse_codigo'] = $this->input->post('codigo');
		$data['subclasse_nome'] = $this->input->post('nome');
		$data['classe_classe_codigo'] = $this->input->post('classe');
		$nome = $this->subclasse->get_subclasse_nome($data['subclasse_codigo']);
		if($nome[0]->subclasse_nome != $this->input->post('nome')){
			$data2['data'] = date("Y-m-d");
			$data2['hora'] = date("h:m:s");
			$data2['responsavel'] = 'user';
			$data2['nome_anterior'] = $nome[0]->subclasse_nome;
			$data2['subclasse_subclasse_codigo'] = $subclassecodigo;
			$this->subclasse->add_mudanca_nome($data2);
		}
		if($nome[0]->classe_classe_codigo != $this->input->post('classe')){
			$classe_nome = $this->classe->get_classe_nome($nome[0]->classe_classe_codigo);
			$data3['data'] = date("Y-m-d");
			$data3['hora'] = date("h:m:s");
			$data3['responsavel'] = "user";
			$data3['subordinacao_anterior'] = $classe_nome[0]->classe_nome;
			$data3['subclasse_subclasse_codigo'] = $subclassecodigo;
			$this->subclasse->add_deslocamento($data3);
		}
		$this->subclasse->edita_subclasse($data,$subclassecodigo);
		redirect(base_url('subclasse'));
	}

	public function desativa($subclassecodigo){
		$this->subclasse->desativa($subclassecodigo);
		redirect(base_url('subclasse'));
	}

	public function reativa($subclassecodigo){
		$this->subclasse->reativa($subclassecodigo);
		redirect(base_url('subclasse'));	
	}

	public function extinguir($subclassecodigo){
		$data['codigo'] = $subclassecodigo;
		$this->load->view('subclasse/extinguir_subclasse',$data);
	}

	public function extinguir_subclasse($subclassecodigo){
		$this->subclasse->desativa($subclassecodigo);
		$data['data'] = date("y-m-d");
		$data['hora'] = date("h:m:s");
		$data['responsavel'] = 'user';
		$data['subclasse_subclasse_codigo'] = $subclassecodigo;
		$this->subclasse->extinguir_subclasse($data);
		unset($data);
		$this->extincao_derivados($subclasse_codigo); //extingui grupos e subgrupos vinculados
		redirect(base_url('subclasse'));
	}

	public function extincao_derivados($subclasse_codigo){
		$grupos = $this->grupo->get_grupo_codigo_subclasse($subclasse_codigo);
		foreach($grupos as $g){
			$subgrupos = $this->subgrupo->get_subgrupo_codigo_grupo($g->grupo_codigo);
			foreach($subgrupos as $sg){
				$this->subgrupo->desativa($s->subclasse_codigo);
				$data['data'] = date("y-m-d");
				$data['hora'] = date("h:m:s");
				$data['responsavel'] = 'user';
				$data['subgrupo_subgrupo_codigo'] = $s->subclasse_codigo;
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
	}

	public function ver($subclassecodigo){
		$data['subclasse'] = $this->subclasse->get_subclasse_codigo($subclassecodigo);
		$data['abertura'] = $this->subclasse->get_subclasse_abertura($subclassecodigo);
		$data['extincao'] = $this->subclasse->get_subclasse_extinta($subclassecodigo);
		$data['desativacao'] = $this->subclasse->get_subclasse_desativacao($subclassecodigo);
		$data['reativacao'] = $this->subclasse->get_subclasse_reativacao($subclassecodigo);
		$data['mudanca_nome'] = $this->subclasse->get_subclasse_mudanca_nome($subclassecodigo);
		$data['deslocamento'] = $this->subclasse->get_subclasse_deslocamento($subclassecodigo);
		$this->load->view('subclasse/subclasse_ver',$data);
	}

	public function get_table_subclasses($subclasses){
		$td = '';
		foreach($subclasses as $s){
			$ext = $this->subclasse->get_subclasse_extinta($s->subclasse_codigo);
			if(count($ext) == 0 ){
				$ativa = ($s->subclasse_ativa == 1) ? '<span class="ls-tag-primary">Ativa</span>' : '<span class="ls-tag-primary">Inativa</span>';
			}else{
				$ativa = '<span class="ls-tag-danger">Extinta</span>';
			}
			$td .= '<tr>'.
					'<td>'.'<a href="'.base_url('subclasse/'.$s->subclasse_codigo).'">'.$s->subclasse_codigo.'</a>'.'</td>'.
					'<td>'.$s->subclasse_nome.'</td>'.
					'<td>'.$s->data.'</td>'.
					'<td>'.$s->classe_nome.'</td>'.
					'<td>'.$ativa.'</td>'.
					'<td>'.
						'<div data-ls-module="dropdown" class="ls-dropdown">
                                <a href="#" class="ls-btn-primary">Ação</a>
                                <ul class="ls-dropdown-nav">'.
                                	'<li><a href="'.base_url('subclasse/editar/'.$s->subclasse_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Editar</span></a></li>'.
                                	'<li><a href="'.base_url('subclasse_c/desativa/'.$s->subclasse_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Desativar</span></a></li>'.
                                	'<li><a href="'.base_url('subclasse_c/reativa/'.$s->subclasse_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Reativar</span></a></li>'.
                                	'<li><a href="'.base_url('subclasse/extinguir/'.$s->subclasse_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Extinguir</span></a></li>'.
                                '</ul>
                            </div>'
					.'</td>'.
				'</tr>';
		}
		return $td;
	}

	public function classe_select($classes){
		$opt = '<option></option>';
		foreach($classes as $c){
			$opt .= '<option value="'.$c->classe_codigo.'">'.$c->classe_codigo.' - '.$c->classe_nome.'</option>';
		}
		return $opt;
	}


}