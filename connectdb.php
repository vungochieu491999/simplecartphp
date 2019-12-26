<?php 

	class Database {

		public $host = 'localhost';

		public $user = 'root';

		public $pass = '';

		public $database = 'simple_cart';

		public $connection;

		public function __Construct() {
			$this->connection = $this->connectDatabase();
		}


		public function connectDatabase() {
			$connection = new mysqli($this->host,$this->user,$this->pass,$this->database);
			return $connection;
		}

		public function executeSql($sql) {
			$data = [];
			$result = $this->connection->query($sql);

			while($row = mysqli_fetch_assoc($result)) {
				$data[] = $row;
			}

			return $data;
		}

		public function countRows($sql) {
			$result = $this->connection->query($sql);
			$count = mysqli_num_rows($result);
			return $count;
		}
	}

 ?>