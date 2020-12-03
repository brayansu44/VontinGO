<?php
	
	/**
	 * Modelo de la Tabla users
	 */
	class Proposal
	{
		private $id;
		private $proposal_tittle;
		private $proposal_description;
		private $candidacy_idfk;
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
				$strSql = "SELECT * FROM proposals";
				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		// public function getAllProposalCandidacy($id)
		// {
		// 	try {
		// 		$strSql = "
		// 			SELECT u.name,u.last_name,p.proposal_tittle,p.proposal_description FROM proposals p INNER JOIN candidacies c on c.id=p.candidacy_idfk INNER JOIN student_listing s on s.id=c.studentlist_idfk INNER JOIN users u on u.id=s.user_idfk WHERE p.id=':id'
		// 		";
		// 		//Llamado al metodo general que ejecuta un select a la BD
		// 		$arrayData = ['id' => $id];
		// 		$query = $this->pdo->select($strSql);
		// 		//retorna el objeto del query
		// 		return $query;
		// 	} catch(PDOException $e) {
		// 		die($e->getMessage());
		// 	}
		// }

		public function getActiveProposal()
		{
			try {
				$strSql = "SELECT * FROM Proposal";
				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function newProposal($data)
		{
			try {
				
				$this->pdo->insert('Proposal', $data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function getProposalById($id)
		{
			try {
				$strSql = "SELECT * FROM Proposal WHERE ID_ROL = :id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function editProposal($data)
		{
			try {
				$strWhere = 'ID_ROL = '. $data['id_rol'];
				$this->pdo->update('ROL', $data, $strWhere);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		public function deleteProposal($data)
		{
			try {
				$strWhere = 'ID_ROL = '. $data['id_rol'];
				$this->pdo->delete('ROL', $strWhere);
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}
	}