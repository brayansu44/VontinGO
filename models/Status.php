<?php
	
	/**
	 * Modelo de la Tabla users
	 */
	class Status
	{
		private $id_status;
		private $name;

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
				$strSql = "SELECT s.*, t.typestatus_name AS name_type FROM statuses s INNER JOIN type_statuses t ON t.id = s.typestatus_idfk 		ORDER BY s.id ASC";
				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function getActiveStatus()
		{
			try {
				$strSql = "SELECT * FROM statuses";
				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function newStatus($data)
		{
			try {
				
				$this->pdo->insert('statuses', $data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function getStatusById($id)
		{
			try {
				$strSql = "SELECT * FROM statuses WHERE id = :id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function editStatus($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->update('statuses', $data, $strWhere);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		
	}