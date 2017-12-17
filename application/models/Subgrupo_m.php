<?php

class Subgrupo_m extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function add_subgrupo($data){
		$this->db->insert('subgrupo',$data);
	}

	public function add_abertura($data2){
		$this->db->insert('abertura_subgrupo',$data2);
	}

	public function get_subgrupos(){
		return $this->db->query("
			select sg.*,`as`.*,g.grupo_nome,g.grupo_codigo 
			from subgrupo sg
			inner join abertura_subgrupo `as` on as.subgrupo_subgrupo_codigo = sg.subgrupo_codigo
			inner join grupo g on sg.grupo_grupo_codigo = g.grupo_codigo
			order by sg.subgrupo_nome asc
			")->result();
	}

	public function get_subgrupo_extinto($subgrupocodigo){
		$this->db->where('subgrupo_subgrupo_codigo',$subgrupocodigo);
		$this->db->order_by('data');
		return $this->db->get('extincao_subgrupo')->result();
	}

	public function get_subgrupo_codigo($subgrupo_codigo){
		return $this->db->query("
			select * from subgrupo sg
			inner join grupo g on g.grupo_codigo = sg.grupo_grupo_codigo
			where sg.subgrupo_codigo = ".$subgrupo_codigo."
			")->result();
	}

	public function get_subgrupo_nome($subgrupocodigo){
		$this->db->select('subgrupo_nome,grupo_grupo_codigo');
		$this->db->where('subgrupo_codigo',$subgrupocodigo);
		return $this->db->get('subgrupo')->result();
	}

	public function add_mudanca_nome($data2){
		$this->db->insert('mudanca_nome_subgrupo',$data2);
	}

	public function edita_subgrupo($data,$subgrupocodigo){
		$this->db->where('subgrupo_codigo',$subgrupocodigo);
		$this->db->update('subgrupo',$data);
	}

	public function desativa($subgrupocodigo){
		$data2['data'] = date("y-m-d");
		$data2['hora'] = date("h:m:s");
		$data2['responsavel'] = 'user';
		$data2['subgrupo_subgrupo_codigo'] = $subgrupocodigo;
		$this->db->insert('desativacao_subgrupo',$data2);

		$data['subgrupo_ativo'] = 0;
		$this->db->where('subgrupo_codigo',$subgrupocodigo);
		$this->db->update('subgrupo',$data);
	}

	public function reativa($subgrupocodigo){
		$data2['data'] = date("y-m-d");
		$data2['hora'] = date("h:m:s");
		$data2['responsavel'] = 'user';
		$data2['subgrupo_subgrupo_codigo'] = $subgrupocodigo;
		$this->db->insert('reativacao_subgrupo',$data2);

		$data['subgrupo_ativo'] = 1;
		$this->db->where('subgrupo_codigo',$subgrupocodigo);
		$this->db->update('subgrupo',$data);
	}

	public function extinguir_subgrupo($data){
		$this->db->insert('extincao_subgrupo',$data);
	}

	public function get_subgrupo_abertura($subgrupocodigo){
		$this->db->where('subgrupo_subgrupo_codigo',$subgrupocodigo);
		return $this->db->get('abertura_subgrupo')->result();
	}

	public function get_subgrupo_desativacao($subgrupocodigo){
		$this->db->where('subgrupo_subgrupo_codigo',$subgrupocodigo);
		$this->db->order_by('data');
		return $this->db->get('desativacao_subgrupo')->result();
	}

	public function get_subgrupo_mudanca_nome($subgrupocodigo){
		$this->db->where('subgrupo_subgrupo_codigo',$subgrupocodigo);
		$this->db->order_by('data');
		return $this->db->get('mudanca_nome_subgrupo')->result();
	}

	public function get_subgrupo_reativacao($subgrupocodigo){
		$this->db->where('subgrupo_subgrupo_codigo',$subgrupocodigo);
		$this->db->order_by('data');
		return $this->db->get('reativacao_subgrupo')->result();
	}

	public function get_subgrupo_codigo_grupo($grupocodigo){
		$this->db->where('grupo_grupo_codigo',$grupocodigo);
		return $this->db->get('subgrupo')->result();
	}

	public function count(){
		return $this->db->count_all_results('subgrupo');
	}

	public function add_deslocamento($data3){
		$this->db->insert('deslocamento_subgrupo',$data3);
	}

	public function get_subgrupo_deslocamento($subgrupo_codigo){
		$this->db->where('subgrupo_subgrupo_codigo',$subgrupo_codigo);
		$this->db->order_by('data','asc');
		return $this->db->get('deslocamento_subgrupo')->result();
	}

	public function add_extincao($data){
		$this->db->insert('extincao_subgrupo',$data);
	}

	public function add_desativacao($data){
		$this->db->inset('desativacao_subgrupo',$data);
	}

	public function add_reativacao($data){
		$this->db->insert('reativacao_subgrupo',$data);
	}

	public function set_status($codigo){
		$extincao = $this->db->query("select * from extincao_subgrupo as e where e.subgrupo_subgrupo_codigo = ".$codigo)->result();
		if(count($extincao) == 1){
			$data['subgrupo_ativo'] = 0;
			$this->db->where('subgrupo_codigo',$codigo);
			$this->db->update('subgrupo',$data);
		}else{
			$desativacao = $this->db->query("select * from desativacao_subgrupo as d where d.subgrupo_subgrupo_codigo = ".$codigo)->result();
			if(count($desativacao) > 0){
				$reativacao = $this->db->query("select * from reativacao_subgrupo as r where c.subgrupo_subgrupo_codigo = ".$codigo)->result();
				if(count($reativacao) > 0){
					$desativacao = $this->db->query("
							select d.data as data,d.hora as hora from desativacao_subgrupo as d 
							where d.subgrupo_subgrupo_codigo = ".$codigo." 
							order by d.data desc,d.hora desc
							limit 1
						")->result();
					$reativacao = $this->db->query("
						select r.data as data,r.hora as hora from reativacao_subgrupo as r
						where r.subgrupo_subgrupo_codigo = ".$codigo."
						order by r.data desc,r.hora desc
						limit 1
						")->result();

					$desativacao_data = $desativacao[0]->data.' '.$desativacao[0]->hora;
					$reativacao_data = $reativacao[0]->data.' '.$reativacao[0]->hora;

					if($desativacao_data > $reativacao_data){
						$data['subgrupo_ativo'] = 0;
						$this->db->where('subgrupo_codigo',$codigo);
						$this->db->update('subgrupo',$data);
					}
				}else{
					$data['subgrupo_ativo'] = 0;
					$this->db->where('subgrupo_codigo',$codigo);
					$this->db->update('subgrupo',$data);
				}
			}
		}
	}

}