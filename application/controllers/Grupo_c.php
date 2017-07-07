<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupo_c extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Subclasse_m','subclasse');
		$this->load->model('Grupo_m','grupo');
	}

	public function index(){
		$data['grupos'] = $this->get_table_grupos($this->grupo->get_grupos());
		$this->load->view('grupo/grupo_lista',$data);
	}

	public function novo(){
		$data['subclasses'] = $this->subclasse_select($this->subclasse->get_subclasses());
		$this->load->view('grupo/novo_grupo',$data);
	}

	public function add_grupo(){
		$data['grupo_codigo'] = $this->input->post('codigo');
		$data['grupo_nome'] = $this->input->post('nome');
		$data['grupo_ativo'] = 1;
		$data['subclasse_subclasse_codigo'] = $this->input->post('subclasse');
		$this->grupo->add_grupo($data);
		$data2['data'] = date("Y-m-d");
		$data2['hora'] = date("h:m:s");
		$data2['responsavel'] = 'user';
		$data2['grupo_grupo_codigo'] = $data['grupo_codigo'];
		$this->grupo->add_abertura($data2);
		redirect(base_url('Grupo_c/index'));
	}

	public function edita($grupocodigo){
		$data['grupo'] = $this->grupo->get_grupo_codigo($grupocodigo);
		$data['subclasses'] = $this->subclasse_select($this->subclasse->get_subclasses());
		$this->load->view('grupo/edita_grupo',$data);
	}


	public function edita_grupo($grupocodigo){
		$data['grupo_codigo'] = $this->input->post('codigo');
		$data['grupo_nome'] = $this->input->post('nome');
		$data['subclasse_subclasse_codigo'] = $this->input->post('subclasse');
		$nome = $this->grupo->get_grupo_nome($data['grupo_codigo']);
		if($nome[0]->grupo_nome != $this->input->post('nome')){
			$data2['data'] = date("Y-m-d");
			$data2['hora'] = date("h:m:s");
			$data2['responsavel'] = 'user';
			$data2['nome_anterior'] = $nome[0]->grupo_nome;
			$data2['grupo_grupo_codigo'] = $grupocodigo;
			$this->grupo->add_mudanca_nome($data2);
		}
		$this->grupo->edita_grupo($data,$grupocodigo);
		redirect(base_url('grupo_c/index'));
	}

	public function desativa($grupocodigo){
		$this->grupo->desativa($grupocodigo);
		redirect(base_url('grupo_c/index'));
	}

	public function reativa($grupocodigo){
		$this->grupo->reativa($grupocodigo);
		redirect(base_url('grupo_c/index'));	
	}

	public function extinguir($grupocodigo){
		$data['codigo'] = $grupocodigo;
		$this->load->view('grupo/extinguir_grupo',$data);
	}

	public function extinguir_grupo($grupocodigo){
		$this->grupo->desativa($grupocodigo);
		$data['data'] = date("y-m-d");
		$data['hora'] = date("h:m:s");
		$data['responsavel'] = 'user';
		$data['grupo_grupo_codigo'] = $grupocodigo;
		$this->grupo->extinguir_grupo($data);
		// $this->extincao_derivados(); //extingui subgrupos vinculados
		redirect(base_url('grupo_c/index'));
	}

	public function ver($grupocodigo){
		$data['grupo'] = $this->grupo->get_grupo_codigo($grupocodigo);
		$data['abertura'] = $this->grupo->get_grupo_abertura($grupocodigo);
		$data['extincao'] = $this->grupo->get_grupo_extinto($grupocodigo);
		$data['desativacao'] = $this->grupo->get_grupo_desativacao($grupocodigo);
		$data['reativacao'] = $this->grupo->get_grupo_reativacao($grupocodigo);
		$data['mudanca_nome'] = $this->grupo->get_grupo_mudancao_nome($grupocodigo);
		$this->load->view('grupo/grupo_ver',$data);
	}


	public function subclasse_select($subclasses){
		$opt = '<option></option>';
		foreach($subclasses as $s){
			$opt .= '<option value="'.$s->subclasse_codigo.'">'.$s->subclasse_codigo.' - '.$s->subclasse_nome.'</option>';
		}
		return $opt;
	}

	public function get_table_grupos($grupos){
		$td = '';
		foreach($grupos as $g){
			$ext = $this->grupo->get_grupo_extinto($g->grupo_codigo);
			if(count($ext) == 0 ){
				$ativa = ($g->grupo_ativo == 1) ? '<span class="ls-tag-primary">Ativo</span>' : '<span class="ls-tag-primary">Inativo</span>';
			}else{
				$ativa = '<span class="ls-tag-danger">Extinto</span>';
			}
			$td .= '<tr>'.
					'<td>'.'<a href="'.base_url('grupo_c/ver/'.$g->grupo_codigo).'">'.$g->grupo_codigo.'</a>'.'</td>'.
					'<td>'.$g->grupo_nome.'</td>'.
					'<td>'.$g->data.'</td>'.
					'<td>'.$g->subclasse_nome.'</td>'.
					'<td>'.$ativa.'</td>'.
					'<td>'.
						'<div data-ls-module="dropdown" class="ls-dropdown">
                                <a href="#" class="ls-btn-primary">Ação</a>
                                <ul class="ls-dropdown-nav">'.
                                	'<li><a href="'.base_url('grupo_c/edita/'.$g->grupo_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Editar</span></a></li>'.
                                	'<li><a href="'.base_url('grupo_c/desativa/'.$g->grupo_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Desativar</span></a></li>'.
                                	'<li><a href="'.base_url('grupo_c/reativa/'.$g->grupo_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Reativar</span></a></li>'.
                                	'<li><a href="'.base_url('grupo_c/extinguir/'.$g->grupo_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Extinguir</span></a></li>'.
                                '</ul>
                            </div>'
					.'</td>'.
				'</tr>';
		}
		return $td;
	}

}