<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classe_c extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Classe_m','classe');
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
		redirect(base_url('Classe_c/index'));
	}

	public function desativa($classecodigo){
		$this->classe->desativa($classecodigo);
		redirect(base_url('Classe_c/index'));
	}

	public function reativa($classecodigo){
		$this->classe->reativa($classecodigo);
		redirect(base_url('Classe_c/index'));	
	}

	public function edita($classecodigo){
		$data['classe'] = $this->classe->get_classe_codigo($classecodigo);
		$this->load->view('classe/edita_classe',$data);
	}

	public function edita_classe($classecodigo){
		$data['classe_nome'] = $this->input->post('nome');
		$data['classe_codigo'] = $this->input->post('codigo');
		$nome = $this->classe->get_classe_nome($classecodigo);
		if($nome[0]->classe_nome != $this->input->post('nome')){
			$data2['data'] = date("Y-m-d");
			$data2['hora'] = date('h:m:s');
			$data2['responsavel'] = 'user';
			$data2['nome_anterior'] = $nome[0]->classe_nome;
			$data2['classe_classe_codigo'] = $this->input->post('codigo');
			$this->classe->add_mudanca_nome($data2);
		}
		$this->classe->edita_classe($classecodigo,$data);
		redirect(base_url('classe_c/index'));
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
		// $this->extincao_derivados(); //extingui subclasses,grupos e subgrupos vinculados
		redirect(base_url('classe_c/index'));
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
					'<td>'.'<a href="'.base_url('classe_c/ver/'.$c->classe_codigo).'">'.$c->classe_codigo.'</a>'.'</td>'.
					'<td>'.$c->classe_nome.'</td>'.
					'<td>'.$c->data.'</td>'.
					'<td>'.$ativa.'</td>'.
					'<td>'.
						'<div data-ls-module="dropdown" class="ls-dropdown">
                                <a href="#" class="ls-btn-primary">Ação</a>
                                <ul class="ls-dropdown-nav">'.
                                	'<li><a href="'.base_url('classe_c/edita/'.$c->classe_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Editar</span></a></li>'.
                                	'<li><a href="'.base_url('classe_c/desativa/'.$c->classe_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Desativar</span></a></li>'.
                                	'<li><a href="'.base_url('classe_c/reativa/'.$c->classe_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Reativar</span></a></li>'.
                                	'<li><a href="'.base_url('classe_c/extinguir/'.$c->classe_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Extinguir</span></a></li>'.
                                '</ul>
                            </div>'
					.'</td>'.
				'</tr>';
		}
		return $td;
	}

}