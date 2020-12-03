<?php
	
	/**
	 * Modelo de la Tabla users
	 */
	class Role
	{
		private $id;
		private $role_name;
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
				$strSql = "SELECT * FROM roles r";
				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function getActiveRole()
		{
			try {
				$strSql = "SELECT * FROM roles";
				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function newRole($data)
		{
			try {
				$data['id_statusfk'] = 9;
				$this->pdo->insert('roles', $data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function getRoleById($id)
		{
			try {
				$strSql = "SELECT * FROM roles WHERE id = :id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function editRole($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->update('roles', $data, $strWhere);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		public function deleteRole($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->delete('roles', $strWhere);
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}
	}