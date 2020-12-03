<?php

	class Course
	{
		private $id;
		private $code;
		private $grade_idfk;
		private $wday_idfk;
		private $eprocess_idfk;
		private $status_idfk;
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
				$strSql = "SELECT * FROM numberstudent";
                

				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}
		public function getAllTwo()
		{
			try {
				$strSql = "SELECT c.*,CONCAT(u.name,' ',u.last_name) as Dt, g.grade_name, w.wday_name, s.status_name FROM courses c
                            inner join grades g on g.id=c.grade_idfk
							inner join working_day w on w.id=c.wday_idfk
							inner join statuses s on s.id=c.status_idfk
							inner join users u on u.id=c.user_idfk";

                

				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function newCourse($data)
		{
			try {
				$data['eprocess_idfk'] = 1;
				$data['status_idfk'] = 14;				
				$this->pdo->insert('courses', $data);
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		public function getCourseById($id)
		{
			try {
				$strSql = "SELECT * FROM courses WHERE id = :id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		//obtener listado estudiantes curso
		public function getCourseStudentsById($id)
		{
			try {
				$strSql = "SELECT u.*, c.code,wd.wday_name FROM student_listing sl 
					INNER JOIN users u ON u.id=sl.user_idfk
					INNER JOIN courses c ON c.id=sl.course_idfk
					INNER JOIN working_day wd ON wd.id=c.wday_idfk
					WHERE c.id=:id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage()); 
			}	
		}

		//obtener listado estudiantes curso
		public function getCourseJourById($id)
		{
			try {
				$strSql = "SELECT c.code,wd.wday_name FROM courses c 
					INNER JOIN working_day wd ON wd.id=c.wday_idfk
					WHERE c.id=:id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage()); 
			}	
		}

		public function editCourse($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->update('courses', $data, $strWhere);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		public function deleteCourse($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->delete('courses', $strWhere);
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}
	}