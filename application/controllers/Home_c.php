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
		$subclasses = $this->subclasse->get_subclasses();
		$grupos = $this->grupo->get_grupos();
		$subgrupos = $this->subgrupo->get_subgrupos();

		$xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
		$xml .= "<classes> \n";

		$xml .= "\t<classe>\n";
		foreach($classe as $c){
			$xml .= '<classe_codigo>'.$c->classe_codigo.'</classe_codigo>';
			$xml .= '<classe_nome>'.$c->classe_nome.'</classe_nome>';
			$xml .= '<classe_subordinacao>'.$c->classe_subordinacao.'</classe_subordinacao>';

			$registro_abertura = $this->classe->get_classe_abertura($c->classe_codigo);
			$xml .= '<registro_abertura>';
			$xml .= '<data>'.$registro_abertura[0]->data.'</data>';
			$xml .= '<hora>'.$registro_abertura[0]->hora.'</hora>';
			$xml .= '<responsavel>'.$registro_abertura[0]->responsavel.'</responsavel>';
			$xml .= '</registro_abertura>';
			unset($registro_abertura);

			$desativacao = $this->classe->get_classe_desativacao($c->classe_codigo);
			foreach($desativacao as $d){
				$xml .= '<registro_desativacao>';
				$xml .= '<data>'.$d->data.'</data>';
				$xml .= '<hora>'.$d->hora.'</hora>';
				$xml .= '<responsavel>'.$d->responsavel.'</responsavel>';
				$xml .= '</registro_desativacao>';
			}
			unset($desativacao);

			$reativacao = $this->classe->get_classe_reativacao($c->classe_codigo);
			foreach($reativacao as $r){
				$xml .= '<reativacao_classe>';
				$xml .= '<data>'.$r->data.'</data>';
				$xml .= '<hora>'.$r->hora.'</hora>';
				$xml .= '<responsavel>'.$r->responsavel.'</responsavel>';
				$xml .= '</reativacao_classe>';
			}
			unset($reativacao);

			$mudanca_nome = $this->classe->get_classe_mudancao_nome($c->classe_codigo);
			foreach($mudanca_nome as $m){
				$xml .= '<registro_mudanca_nome_classe>';
				$xml .= '<data>'.$m->data.'</data>';
				$xml .= '<hora>'.$m->hora.'</hora>';
				$xml .= '<responsavel>'.$m->responsavel.'</responsavel>';
				$xml .= '<nome_anterior>'.$m->nome_anterior.'</nome_anterior>';
				$xml .= '</registro_mudanca_nome_classe>';
			}
			unset($mudanca_nome);

			$extincao = $this->classe->get_classe_extinta($c->classe_codigo);
			$xml .= '<registro_extincao>';
			$xml .= '<data>'.$extincao[0]->data.'</data>';
			$xml .= '<hora>'.$extincao[0]->hora.'</hora>';
			$xml .= '<responsavel>'.$extincao[0]->responsavel.'</responsavel>';
			$xml .= '</registro_extincao>';
			unset($extincao);
		}

		$xml .= "</classe>";




		$xml .= "</classes>";

		$ponteiro = fopen('pcd.xml','w');
		fwrite($ponteiro, $xml);
		$ponteiro = fclose($ponteiro);
	}
}