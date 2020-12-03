<?php

	class Grade
	{
		private $id;
        private $grade_name;
        private $level_idfk;
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
				$strSql = "SELECT g.*, level_name FROM grades g
				inner join levels l on l.id=g.level_idfk";

				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function newgrade($data)
		{
			try {
				$this->pdo->insert('grades', $data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function getGradeById($id)
		{
			try {
				$strSql = "SELECT * FROM grades WHERE id = :id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function editgrade($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->update('grades', $data, $strWhere);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		public function deleteGrade($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->delete('grades', $strWhere);
				
			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}
	}