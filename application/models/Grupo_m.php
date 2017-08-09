<?php

class Grupo_m extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function add_grupo($data){
		$this->db->insert('grupo',$data);
	}

	public function add_abertura($data2){
		$this->db->insert('abertura_grupo',$data2);
	}

	public function get_grupos(){
		return $this->db->query("
			select g.*,`ag`.*,s.subclasse_nome,s.subclasse_codigo from grupo g
			inner join abertura_grupo `ag` on ag.grupo_grupo_codigo = g.grupo_codigo
			inner join subclasse s on g.subclasse_subclasse_codigo = s.subclasse_codigo
			order by g.grupo_nome asc
			")->result();
	}

	public function get_grupos_ativos(){
		return $this->db->query("
			select g.*,`ag`.*,s.subclasse_nome,s.subclasse_codigo from grupo g
			inner join abertura_grupo `ag` on ag.grupo_grupo_codigo = g.grupo_codigo
			inner join subclasse s on g.subclasse_subclasse_codigo = s.subclasse_codigo
			where g.grupo_ativo = 1
			order by g.grupo_nome asc
			")->result();
	}

	public function get_grupo_extinto($grupocodigo){
		$this->db->where('grupo_grupo_codigo',$grupocodigo);
		$this->db->order_by('data');
		return $this->db->get('extincao_grupo')->result();
	}

	public function get_grupo_codigo($grupo_codigo){
		return $this->db->query("
			select * from grupo g
			inner join subclasse s on s.subclasse_codigo = g.subclasse_subclasse_codigo
			where g.grupo_codigo = ".$grupo_codigo."
			")->result();
	}

	public function get_grupo_nome($grupocodigo){
		$this->db->select('grupo_nome');
		$this->db->where('grupo_codigo',$grupocodigo);
		return $this->db->get('grupo')->result();
	}

	public function add_mudanca_nome($data2){
		$this->db->insert('mudanca_nome_grupo',$data2);
	}

	public function edita_grupo($data,$grupocodigo){
		$this->db->where('grupo_codigo',$grupocodigo);
		$this->db->update('grupo',$data);
	}

	public function desativa($grupocodigo){
		$data2['data'] = date("y-m-d");
		$data2['hora'] = date("h:m:s");
		$data2['responsavel'] = 'user';
		$data2['grupo_grupo_codigo'] = $grupocodigo;
		$this->db->insert('desativacao_grupo',$data2);

		$data['grupo_ativo'] = 0;
		$this->db->where('grupo_codigo',$grupocodigo);
		$this->db->update('grupo',$data);
	}

	public function reativa($grupocodigo){
		$data2['data'] = date("y-m-d");
		$data2['hora'] = date("h:m:s");
		$data2['responsavel'] = 'user';
		$data2['grupo_grupo_codigo'] = $grupocodigo;
		$this->db->insert('reativacao_grupo',$data2);

		$data['grupo_ativo'] = 1;
		$this->db->where('grupo_codigo',$grupocodigo);
		$this->db->update('grupo',$data);
	}

	public function extinguir_grupo($data){
		$this->db->insert('extincao_grupo',$data);
	}

	public function get_grupo_abertura($grupocodigo){
		$this->db->where('grupo_grupo_codigo',$grupocodigo);
		return $this->db->get('abertura_grupo')->result();
	}

	public function get_grupo_desativacao($grupocodigo){
		$this->db->where('grupo_grupo_codigo',$grupocodigo);
		$this->db->order_by('data');
		return $this->db->get('desativacao_grupo')->result();
	}

	public function get_grupo_mudancao_nome($grupocodigo){
		$this->db->where('grupo_grupo_codigo',$grupocodigo);
		$this->db->order_by('data');
		return $this->db->get('mudanca_nome_grupo')->result();
	}

	public function get_grupo_reativacao($grupocodigo){
		$this->db->where('grupo_grupo_codigo',$grupocodigo);
		$this->db->order_by('data');
		return $this->db->get('reativacao_grupo')->result();
	}

	public function get_grupo_codigo_subclasse($subclassecodigo){
		$this->db->where('subclasse_subclasse_codigo',$subclassecodigo);
		return $this->db->get('grupo')->result();
	}

	public function count(){
		return $this->db->count_all_results('grupo');
	}

}