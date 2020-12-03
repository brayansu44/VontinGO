<?php
	
	/**
	 * Modelo de la Tabla users
	 */
	class CandidateType
	{
		private $id;
		private $candidatetype_name;
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
				$strSql = "SELECT * FROM candidate_types";

				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function newCandidateType($data)
		{
			try {
				$this->pdo->insert('candidate_types', $data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function getCandidateTypeById($id)
		{
			try {
				$strSql = "SELECT * FROM candidate_types WHERE id = :id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function getCandidateProposalById($id)
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

		public function editCandidateType($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->update('candidate_types', $data, $strWhere);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		public function deleteCandidateType($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->delete('usuario', $strWhere);
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}
	}