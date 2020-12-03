<?php
class Voting
	{
		private $id;
		private $candidacy_idfk;
		private $number_votes;
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
				$strSql = "SELECT * FROM candidate_list";

				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		


		public function VoteRegister($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->updateVote('scrutinies', $data, $strWhere);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

	}	