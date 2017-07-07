<?php

class Classe_m extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function add_classe($data){
		$this->db->insert('classe',$data);
	}

	public function add_data_abertura($data2){
		$this->db->insert('abertura_classe',$data2);
	}

	public function get_classes(){
		return $this->db->query("
			select * from classe c
			inner join abertura_classe ac on ac.classe_classe_codigo = c.classe_codigo
			order by c.classe_nome asc
		")->result();
	}

	public function get_classes_ativas(){
		return $this->db->query("
			select * from classe c
			inner join abertura_classe ac on ac.classe_classe_codigo = c.classe_codigo
			where c.classe_ativa = 1
			order by c.classe_nome asc
		")->result();
	}

	public function desativa($classecodigo){
		$data2['data'] = date("y-m-d");
		$data2['hora'] = date("h:m:s");
		$data2['responsavel'] = 'user';
		$data2['classe_classe_codigo'] = $classecodigo;
		$this->db->insert('desativacao_classe',$data2);

		$data['classe_ativa'] = 0;
		$this->db->where('classe_codigo',$classecodigo);
		$this->db->update('classe',$data);
	}

	public function reativa($classecodigo){
		$data2['data'] = date("y-m-d");
		$data2['hora'] = date("h:m:s");
		$data2['responsavel'] = 'user';
		$data2['classe_classe_codigo'] = $classecodigo;
		$this->db->insert('reativacao_classe',$data2);

		$data['classe_ativa'] = 1;
		$this->db->where('classe_codigo',$classecodigo);
		$this->db->update('classe',$data);
	}

	public function get_classe_codigo($classecodigo){
		$this->db->where('classe_codigo',$classecodigo);
		return $this->db->get('classe')->result();
	}

	public function get_classe_nome($classecodigo){
		$this->db->select('classe_nome');
		$this->db->where('classe_codigo',$classecodigo);
		return $this->db->get('classe')->result();
	}

	public function edita_classe($classecodigo,$data){
		$this->db->where('classe_codigo',$classecodigo);
		$this->db->update('classe',$data);
	}

	public function add_mudanca_nome($data2){
		$this->db->insert('mudanca_nome_classe',$data2);
	}

	public function extinguir_classe($data){
		$this->db->insert('extincao_classe',$data);
	}

	public function get_classe_extinta($classecodigo){
		$this->db->where('classe_classe_codigo',$classecodigo);
		$this->db->order_by('data');
		return $this->db->get('extincao_classe')->result();
	}

	public function get_classe_abertura($classecodigo){
		$this->db->where('classe_classe_codigo',$classecodigo);
		return $this->db->get('abertura_classe')->result();
	}

	public function get_classe_desativacao($classecodigo){
		$this->db->where('classe_classe_codigo',$classecodigo);
		$this->db->order_by('data');
		return $this->db->get('desativacao_classe')->result();
	}

	public function get_classe_mudancao_nome($classecodigo){
		$this->db->where('classe_classe_codigo',$classecodigo);
		$this->db->order_by('data');
		return $this->db->get('mudanca_nome_classe')->result();
	}

	public function get_classe_reativacao($classecodigo){
		$this->db->where('classe_classe_codigo',$classecodigo);
		$this->db->order_by('data');
		return $this->db->get('reativacao_classe')->result();
	}
}