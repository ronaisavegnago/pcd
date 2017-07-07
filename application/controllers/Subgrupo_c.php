<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subgrupo_c extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Subgrupo_m','subgrupo');
		$this->load->model('Grupo_m','grupo');
	}

	public function index(){
		$data['subgrupos'] = $this->get_table_subgrupos($this->subgrupo->get_subgrupos());
		$this->load->view('subgrupo/subgrupo_lista',$data);
	}

	public function novo(){
		$data['grupos'] = $this->subclasse_select($this->grupo->get_grupos_ativos());
		$this->load->view('subgrupo/novo_subgrupo',$data);
	}

	public function add_subgrupo(){
		$data['subgrupo_codigo'] = $this->input->post('codigo');
		$data['subgrupo_nome'] = $this->input->post('nome');
		$data['subgrupo_ativo'] = 1;
		$data['grupo_grupo_codigo'] = $this->input->post('grupo');
		$this->subgrupo->add_subgrupo($data);
		$data2['data'] = date("Y-m-d");
		$data2['hora'] = date("h:m:s");
		$data2['responsavel'] = 'user';
		$data2['subgrupo_subgrupo_codigo'] = $data['subgrupo_codigo'];
		$this->subgrupo->add_abertura($data2);
		redirect(base_url('Subgrupo_c/index'));
	}

	public function edita($subgrupocodigo){
		$data['subgrupo'] = $this->subgrupo->get_subgrupo_codigo($subgrupocodigo);
		$data['grupo'] = $this->subclasse_select($this->grupo->get_grupos());
		$this->load->view('subgrupo/edita_subgrupo',$data);
	}


	public function edita_subgrupo($subgrupocodigo){
		$data['subgrupo_codigo'] = $this->input->post('codigo');
		$data['subgrupo_nome'] = $this->input->post('nome');
		$data['grupo_grupo_codigo'] = $this->input->post('grupo');
		$nome = $this->subgrupo->get_subgrupo_nome($data['subgrupo_codigo']);
		if($nome[0]->subgrupo_nome != $this->input->post('nome')){
			$data2['data'] = date("Y-m-d");
			$data2['hora'] = date("h:m:s");
			$data2['responsavel'] = 'user';
			$data2['nome_anterior'] = $nome[0]->subgrupo_nome;
			$data2['subgrupo_subgrupo_codigo'] = $subgrupocodigo;
			$this->subgrupo->add_mudanca_nome($data2);
		}
		$this->subgrupo->edita_subgrupo($data,$subgrupocodigo);
		redirect(base_url('subgrupo_c/index'));
	}

	public function desativa($subgrupocodigo){
		$this->subgrupo->desativa($subgrupocodigo);
		redirect(base_url('subgrupo_c/index'));
	}

	public function reativa($subgrupocodigo){
		$this->subgrupo->reativa($subgrupocodigo);
		redirect(base_url('subgrupo_c/index'));	
	}

	public function extinguir($subgrupocodigo){
		$data['codigo'] = $subgrupocodigo;
		$this->load->view('subgrupo/extinguir_subgrupo',$data);
	}

	public function extinguir_subgrupo($subgrupocodigo){
		$this->subgrupo->desativa($subgrupocodigo);
		$data['data'] = date("y-m-d");
		$data['hora'] = date("h:m:s");
		$data['responsavel'] = 'user';
		$data['subgrupo_subgrupo_codigo'] = $subgrupocodigo;
		$this->subgrupo->extinguir_subgrupo($data);
		// $this->extincao_derivados(); //extingui subgrupos vinculados
		redirect(base_url('subgrupo_c/index'));
	}

	public function ver($subgrupocodigo){
		$data['subgrupo'] = $this->subgrupo->get_subgrupo_codigo($subgrupocodigo);
		$data['abertura'] = $this->subgrupo->get_subgrupo_abertura($subgrupocodigo);
		$data['extincao'] = $this->subgrupo->get_subgrupo_extinto($subgrupocodigo);
		$data['desativacao'] = $this->subgrupo->get_subgrupo_desativacao($subgrupocodigo);
		$data['reativacao'] = $this->subgrupo->get_subgrupo_reativacao($subgrupocodigo);
		$data['mudanca_nome'] = $this->subgrupo->get_subgrupo_mudancao_nome($subgrupocodigo);
		$this->load->view('subgrupo/subgrupo_ver',$data);
	}


	public function subclasse_select($grupo){
		$opt = '<option></option>';
		foreach($grupo as $g){
			$opt .= '<option value="'.$g->grupo_codigo.'">'.$g->grupo_codigo.' - '.$g->grupo_nome.'</option>';
		}
		return $opt;
	}

	public function get_table_subgrupos($subgrupos){
		$td = '';
		foreach($subgrupos as $g){
			$ext = $this->subgrupo->get_subgrupo_extinto($g->subgrupo_codigo);
			if(count($ext) == 0 ){
				$ativa = ($g->subgrupo_ativo == 1) ? '<span class="ls-tag-primary">Ativo</span>' : '<span class="ls-tag-primary">Inativo</span>';
			}else{
				$ativa = '<span class="ls-tag-danger">Extinto</span>';
			}
			$td .= '<tr>'.
					'<td>'.'<a href="'.base_url('subgrupo_c/ver/'.$g->subgrupo_codigo).'">'.$g->subgrupo_codigo.'</a>'.'</td>'.
					'<td>'.$g->subgrupo_nome.'</td>'.
					'<td>'.$g->data.'</td>'.
					'<td>'.$g->grupo_nome.'</td>'.
					'<td>'.$ativa.'</td>'.
					'<td>'.
						'<div data-ls-module="dropdown" class="ls-dropdown">
                                <a href="#" class="ls-btn-primary">Ação</a>
                                <ul class="ls-dropdown-nav">'.
                                	'<li><a href="'.base_url('subgrupo_c/edita/'.$g->subgrupo_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Editar</span></a></li>'.
                                	'<li><a href="'.base_url('subgrupo_c/desativa/'.$g->subgrupo_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Desativar</span></a></li>'.
                                	'<li><a href="'.base_url('subgrupo_c/reativa/'.$g->subgrupo_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Reativar</span></a></li>'.
                                	'<li><a href="'.base_url('subgrupo_c/extinguir/'.$g->subgrupo_codigo).'"><span class="ls-ico-edit-admin ls-ico-left">Extinguir</span></a></li>'.
                                '</ul>
                            </div>'
					.'</td>'.
				'</tr>';
		}
		return $td;
	}

}