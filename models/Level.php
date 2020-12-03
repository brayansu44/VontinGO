<?php
	
	/**
	 * Modelo de la Tabla NIVEL
	 */
	class Level
	{
		private $id;
		private $level_name;
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
				$strSql = "SELECT * FROM levels";

				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function newLevel($data)
		{
			try {
				$this->pdo->insert('levels', $data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function getLevelById($id)
		{
			try {
				$strSql = "SELECT * FROM levels WHERE id = :id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function editLevel($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->update('levels', $data, $strWhere);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		public function deleteLevel($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->delete('levels', $strWhere);
				
			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}
	}