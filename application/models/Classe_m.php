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

	public function get_classe_codigo2($nome){
		$this->db->select('classe_codigo');
		$this->db->where('classe_nome',$nome);
		$classe = $this->db->get('classe')->result();
		return $classe[0]->classe_codigo;
	}

	public function get_classes_ativas(){
		return $this->db->query("
			select * from classe c
			inner join abertura_classe ac on ac.classe_classe_codigo = c.classe_codigo
			where c.classe_ativa = 1
			order by c.classe_nome asc
		")->result();
	}

	public function insere_desativacao($data){
		$this->db->insert('desativacao_classe',$data);
	}

	public function insere_reativacao($data){
		$this->db->insert('reativacao_classe',$data);
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

	public function count(){
		return $this->db->count_all_results('classe');
	}

	public function set_status($codigo){
		$extincao = $this->db->query("select * from extincao_classe as e where e.classe_classe_codigo = ".$codigo)->result();
		if(count($extincao) == 1){
			$data['classe_ativa'] = 0;
			$this->db->where('classe_codigo',$codigo);
			$this->db->update('classe',$data);
		}else{
			$desativacao = $this->db->query("select * from desativacao_classe as d where d.classe_classe_codigo = ".$codigo)->result();
			if(count($desativacao) > 0){
				$reativacao = $this->db->query("select * from reativacao_classe as r where r.classe_classe_codigo = ".$codigo)->result();
				if(count($reativacao) > 0){
					$desativacao = $this->db->query("
							select d.data as data,d.hora as hora from desativacao_classe as d 
							where d.classe_classe_codigo = ".$codigo." 
							order by d.data desc,d.hora desc
							limit 1
						")->result();
					$reativacao = $this->db->query("
						select r.data as data,r.hora as hora from reativacao_classe as r
						where r.classe_classe_codigo = ".$codigo."
						order by r.data desc,r.hora desc
						limit 1
						")->result();

					$desativacao_data = $desativacao[0]->data.' '.$desativacao[0]->hora;
					$reativacao_data = $reativacao[0]->data.' '.$reativacao[0]->hora;

					if($desativacao_data > $reativacao_data){
						$data['classe_ativa'] = 0;
						$this->db->where('classe_codigo',$codigo);
						$this->db->update('classe',$data);
					}
				}else{
					$data['classe_ativa'] = 0;
					$this->db->where('classe_codigo',$codigo);
					$this->db->update('classe',$data);
				}
			}
		}
	}
}