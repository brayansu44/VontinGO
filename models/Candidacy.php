<?php
	
	/**
	 * Modelo de la Tabla users
	 */
	class Candidacy
	{
		private $id;
		private $photo;
		private $candidatetype_idfk;
		private $studentlist_idfk;
		private $id_statusfk;
		private $pdo;
		
		public function __construct()
		{
			try {
				$this->pdo = new Database;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function getAll()
		{
			try {
				$strSql = "SELECT * FROM list_candidate";

				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}


		public function newCandidacy($data)
		{
			try {
				$this->pdo->insert('candidacies', $data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function getCandidacyById($id)
		{
			try {
				$strSql = "SELECT * FROM candidacies WHERE id = :id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}
		public function editCandidacy($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->update('candidacies', $data, $strWhere);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		public function editProposal($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->update('proposals', $data, $strWhere);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		//obtener listado propuestas candidato
		public function getProposalById($id)
		{
			try {
				$strSql = "SELECT CONCAT(u.name,' ', u.last_name) as student, ct.candidatetype_name, c.*, p.proposal_tittle,p.proposal_description, p.id as pId FROM candidacies c
					INNER JOIN proposals p ON p.candidacy_idfk=c.id
					INNER JOIN users u ON u.id=c.studentlist_idfk
					INNER JOIN student_listing sl ON sl.user_idfk=u.id
        			INNER JOIN candidate_types ct ON ct.id=c.candidatetype_idfk
					WHERE c.id=:id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				//if (empty($query)) {
				//	$condicion = true;
				//}else{
					//$condicion = false;
				//}
				//return $condicion;
				//var_dump($query);
				//echo $condicion;
				//die();
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function getCandidacyPById($id)
		{
			try {
				$strSql = "SELECT CONCAT(u.name,' ', u.last_name) as student, ct.candidatetype_name, c.id as id_candidato FROM users u	
					INNER JOIN student_listing sl ON sl.user_idfk=u.id
                    INNER JOIN candidacies c ON c.studentlist_idfk=sl.id
        			INNER JOIN candidate_types ct ON ct.id=c.candidatetype_idfk
					WHERE c.id=:id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}


		public function deleteCandidacy($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->delete('candidacies', $strWhere);
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		//registrar propuesta
		public function newProposal($data)
		{
			try {
				$this->pdo->insert('proposals', $data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function deleteProposal($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->delete('proposals', $strWhere);
				
			} catch (PDOException $e) {
				die($e->getMessage());
			}
		} 
	}