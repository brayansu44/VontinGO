<?php
	
	/**
	 * Modelo de la Tabla users
	 */
	class Rol
	{
		private $id_rol;
		private $name;
		private $status;
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
				$strSql = "SELECT * FROM ROL";
				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function getActiveRol()
		{
			try {
				$strSql = "SELECT * FROM ROL";
				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function newRol($data)
		{
			try {
				
				$this->pdo->insert('rol', $data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function getRolById($id)
		{
			try {
				$strSql = "SELECT * FROM ROL WHERE ID_ROL = :id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function editRol($data)
		{
			try {
				$strWhere = 'ID_ROL = '. $data['id_rol'];
				$this->pdo->update('ROL', $data, $strWhere);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		public function deleteRol($data)
		{
			try {
				$strWhere = 'ID_ROL = '. $data['id_rol'];
				$this->pdo->delete('ROL', $strWhere);
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}
	}