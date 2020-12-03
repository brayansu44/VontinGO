<?php

 
	/**
	 *  Modelo Login
	 */
	class Login
	{

		
		private $pdo;
		
		public function __construct()
		{
			try {
				$this->pdo = new Database;
			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}

		public function validateUser($data)
		{
			try{
				$strSql = "SELECT u.*, s.status_name as status, r.role_name as rol FROM usurol ur 
                INNER JOIN users u on u.id = ur.user_idfk
                INNER JOIN statuses s ON s.id = u.status_idfk
				INNER JOIN roles r ON r.id = ur.role_idfk
				WHERE u.document= '{$data['document']}' AND u.password = '{$data['password']}'";

				$query = $this->pdo->select($strSql);

				if (isset($query[0]->id)) {
					if ($query[0]->status_idfk == 1) {
					
						$_SESSION['user'] = $query[0];
						return true;

					} else {
						return 'Error al iniciar sesion, su usuario esta inactivo';
					}
				} else {
					return 'Error al iniciar sesion, verique sus credenciales';
				}
	 		} catch (PDOException $e) {
				return $e->getMessage();
			}
		}

		public function getStatusStudent($id) 
		{
			try{
				$strSql = "SELECT s.user_idfk, u.id, s.status_idFK from student_listing s
							INNER JOIN users u ON u.id = s.user_idfk
							WHERE s.user_idfk=$id";

				$query = $this->pdo->select($strSql);
				return $query;

	 		} catch (PDOException $e) {
				return $e->getMessage();
			}
		}
	}	