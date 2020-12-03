<?php

	class wday
	{
		private $id;
		private $wday_name;
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
				$strSql = "SELECT * FROM working_day";

				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function newWDay($data)
		{
			try {
				$this->pdo->insert('working_day', $data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function getWDayById($id)
		{
			try {
				$strSql = "SELECT * FROM working_day WHERE id = :id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function editWDay($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->update('working_day', $data, $strWhere);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		public function deleteWday($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->delete('working_day', $strWhere);
				
			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}
	}