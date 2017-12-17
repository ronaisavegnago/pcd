<?php

class Subclasse_m extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function add_subclasse($data){
		$this->db->insert('subclasse',$data);
	}

	public function add_abertura($data2){
		$this->db->insert('abertura_subclasse',$data2);
	}

	public function get_subclasses(){
		return $this->db->query("
			select s.*,`as`.*,c.classe_nome,c.classe_codigo from subclasse s
			inner join abertura_subclasse `as` on as.subclasse_subclasse_codigo = s.subclasse_codigo
			inner join classe c on c.classe_codigo = s.classe_classe_codigo
			order by s.subclasse_nome asc
			")->result();
	}

	public function get_classe_nome_where($nome){
		$this->db->select('classe_codigo');
		$this->db->where('classe_nome',$nome);
		return $this->db->get('classe')->result();
	}

	public function get_subclasses_ativas(){
		return $this->db->query("
			select s.*,`as`.*,c.classe_nome,c.classe_codigo from subclasse s
			inner join abertura_subclasse `as` on as.subclasse_subclasse_codigo = s.subclasse_codigo
			inner join classe c on c.classe_codigo = s.classe_classe_codigo
			where s.subclasse_ativa = 1
			order by s.subclasse_nome asc
			")->result();
	}

	public function get_subclasse_codigo($subclasse_codigo){
		return $this->db->query("
			select * from subclasse s
			inner join classe c on c.classe_codigo = s.classe_classe_codigo
			where s.subclasse_codigo = ".$subclasse_codigo."
			")->result();
	}

	public function get_subclasse_nome($subclassecodigo){
		$this->db->select('subclasse_nome, classe_classe_codigo');
		$this->db->where('subclasse_codigo',$subclassecodigo);
		return $this->db->get('subclasse')->result();
	}

	public function add_mudanca_nome($data2){
		$this->db->insert('mudanca_nome_subclasse',$data2);
	}

	public function edita_subclasse($data,$subclassecodigo){
		$this->db->where('subclasse_codigo',$subclassecodigo);
		$this->db->update('subclasse',$data);
	}

	public function desativa($subclassecodigo){
		$data2['data'] = date("y-m-d");
		$data2['hora'] = date("h:m:s");
		$data2['responsavel'] = 'user';
		$data2['subclasse_subclasse_codigo'] = $subclassecodigo;
		$this->db->insert('desativacao_subclasse',$data2);

		$data['subclasse_ativa'] = 0;
		$this->db->where('subclasse_codigo',$subclassecodigo);
		$this->db->update('subclasse',$data);
	}

	public function reativa($subclassecodigo){
		$data2['data'] = date("y-m-d");
		$data2['hora'] = date("h:m:s");
		$data2['responsavel'] = 'user';
		$data2['subclasse_subclasse_codigo'] = $subclassecodigo;
		$this->db->insert('reativacao_subclasse',$data2);

		$data['subclasse_ativa'] = 1;
		$this->db->where('subclasse_codigo',$subclassecodigo);
		$this->db->update('subclasse',$data);
	}

	public function extinguir_subclasse($data){
		$this->db->insert('extincao_subclasse',$data);
	}

	public function get_subclasse_extinta($subclassecodigo){
		$this->db->where('subclasse_subclasse_codigo',$subclassecodigo);
		$this->db->order_by('data');
		return $this->db->get('extincao_subclasse')->result();
	}

	public function get_subclasse_abertura($subclassecodigo){
		$this->db->where('subclasse_subclasse_codigo',$subclassecodigo);
		return $this->db->get('abertura_subclasse')->result();
	}

	public function get_subclasse_desativacao($subclassecodigo){
		$this->db->where('subclasse_subclasse_codigo',$subclassecodigo);
		$this->db->order_by('data');
		return $this->db->get('desativacao_subclasse')->result();
	}

	public function get_subclasse_mudanca_nome($subclassecodigo){
		$this->db->where('subclasse_subclasse_codigo',$subclassecodigo);
		$this->db->order_by('data');
		return $this->db->get('mudanca_nome_subclasse')->result();
	}

	public function get_subclasse_reativacao($subclassecodigo){
		$this->db->where('subclasse_subclasse_codigo',$subclassecodigo);
		$this->db->order_by('data');
		return $this->db->get('reativacao_subclasse')->result();
	}

	public function get_subclasse_codigo_classe($classecodigo){
		$this->db->where('classe_classe_codigo',$classecodigo);
		return $this->db->get('subclasse')->result();
	}

	public function count(){
		return $this->db->count_all_results('subclasse');
	}

	public function add_deslocamento($data3){
		$this->db->insert('deslocamento_subclasse',$data3);
	}

	public function get_subclasse_deslocamento($subclasse_codigo){
		$this->db->where('subclasse_subclasse_codigo',$subclasse_codigo);
		$this->db->order_by('data','asc');
		return $this->db->get('deslocamento_subclasse')->result();
	}

	public function add_registro_desativacao($data){
		$this->db->insert('desativacao_subclasse',$data);
	}

	public function add_registro_reativacao($data){
		$this->db->insert('reativacao_subclasse',$data);
	}

	public function get_subclasse_codigo2($subclasse){
		$this->db->select('subclasse_codigo');
		$this->db->where('subclasse_nome',$subclasse);
		$subc = $this->db->get('subclasse')->result();
		return $subc[0]->subclasse_codigo;
	}

	public function set_status($codigo){
		$extincao = $this->db->query("select * from extincao_subclasse as e where e.subclasse_subclasse_codigo = ".$codigo)->result();
		if(count($extincao) == 1){
			$data['subclasse_ativa'] = 0;
			$this->db->where('subclasse_codigo',$codigo);
			$this->db->update('subclasse',$data);
		}else{
			$desativacao = $this->db->query("select * from desativacao_subclasse as d where d.subclasse_subclasse_codigo = ".$codigo)->result();
			if(count($desativacao) > 0){
				$reativacao = $this->db->query("select * from reativacao_subclasse as r where c.subclasse_subclasse_codigo = ".$codigo)->result();
				if(count($reativacao) > 0){
					$desativacao = $this->db->query("
							select d.data as data,d.hora as hora from desativacao_subclasse as d 
							where d.subclasse_subclasse_codigo = ".$codigo." 
							order by d.data desc,d.hora desc
							limit 1
						")->result();
					$reativacao = $this->db->query("
						select r.data as data,r.hora as hora from reativacao_subclasse as r
						where r.subclasse_subclasse_codigo = ".$codigo."
						order by r.data desc,r.hora desc
						limit 1
						")->result();

					$desativacao_data = $desativacao[0]->data.' '.$desativacao[0]->hora;
					$reativacao_data = $reativacao[0]->data.' '.$reativacao[0]->hora;

					if($desativacao_data > $reativacao_data){
						$data['subclasse_ativa'] = 0;
						$this->db->where('subclasse_codigo',$codigo);
						$this->db->update('subclasse',$data);
					}
				}else{
					$data['subclasse_ativa'] = 0;
					$this->db->where('subclasse_codigo',$codigo);
					$this->db->update('subclasse',$data);
				}
			}
		}
	}
}