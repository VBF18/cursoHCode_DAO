<?php  

class Sql extends PDO
{
	private $conn;	

	public function __construct()
	{
		$this->conn = new PDO("mysql:dbname=dbcursophp;host=localhost", "root", "jwFBR6KemHP%");
	}

	private function setParams($statment, $parameters = array()){
		foreach ($parameters as $key => $value) {
			$this->setParam($key, $value);
		}
	}

	private function setParam($statment, $key, $value){
		$statment->bindParam($key, $Value);
	}

	public function query($rawQuery, $params = array()){
		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();
		return $stmt;
	}

	public function select($rawQuery, $params = array()):array //declaração de retorno de função/método, que tem o objetivo de declarar que, esta dada função/método retorna um array. 
	{
		$stmt = $this->query($rawQuery, $params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

?>