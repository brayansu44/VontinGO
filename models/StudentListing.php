<?php
	
	/**
	 * Modelo de la Tabla student_listing
	 */
	class StudentListing
	{
		private $id;
		private $user_idfk;
		private $course_idfk;
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
			$strSql = "SELECT s.id,u.name,u.last_name,u.document,c.code, w.wday_name FROM student_listing s
				INNER JOIN users u ON u.id=s.user_idfk
				INNER JOIN courses c ON c.id=s.course_idfk
                INNER JOIN working_day w ON w.id=c.wday_idfk
                INNER JOIN usurol ur ON ur.user_idfk=u.id
                INNER JOIN roles r ON r.id=ur.role_idfk
                WHERE role_name='estudiante' 
                AND w.wday_name='Mañana' ";



				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function newStudent_listing($data)
		{
			try {
				$this->pdo->insert('student_listing', $data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function getStudent_listingById($id)
		{
			try {
				$strSql = "SELECT * FROM student_listing WHERE id = :id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function editStudent_listing($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->update('student_listing', $data, $strWhere);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		public function deleteStudent_listing($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->delete('student_listing', $strWhere);
				
			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}
	}	