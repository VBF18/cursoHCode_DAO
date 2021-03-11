<?php

class Usuario
{
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario(){
		return $this->idusuario;
	}
	public function setIdusuario($value){
		$this->idusuario = $value;
	}
	public function getDeslogin(){
		return $this->deslogin;
	}
	public function setDeslogin($value){
		$this->deslogin = $value;
	}
	public function getDessenha(){
		return $this->dessenha;
	}
	public function setDessenha($value){
		$this->dessenha = $value;
	}
	public function getDtcadastro(){
		return $this->dtcadastro;
	}
	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}

	public function loadById($id){
	$sql = new Sql();

	$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
		":ID"=>$id
	));

	if (count($results) > 0) {
		$this->setData($results[0]);
	}
}
	//Já que esse método não usa this podemos transformá-lo em estático. Vantagem - Podemos chamar a função getlist, diretamente, no index.php
	public static function getList(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
	}

	public static function search($login){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			':SEARCH'=>"%".$login."%"
		));
}
	public function login($login, $password){
		$sql = new Sql();

	$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
		":LOGIN"=>$login,
		":PASSWORD"=>$password
	));

	if (count($results) > 0) {
		$this->setData($results[0]);
	} else {
		throw new Exception("Login e/ou Senha Inválidos.");
	}
	}
	public function setData($data){
		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));
	}
	// Nos 3 métodos acima, nós recebemos o statement do banco de dados, carregamos nossas varáveis com os setter e recuperamos os dados com os getters. No insert, abaixo, fazemos o caminho contrário: carregamos os dados que queremos inserir nas variáveis com os setter e usamos os getters para criar a query que será submetida ao banco de dados.
	public function insert(){
		$sql = new Sql();
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha()
		));
		if (count($results) > 0) {
		$this->setData($results[0]);
	}
	}

	public  function update($login, $password){
		$this->setDeslogin($login);
		$this->setDessenha($password);
		$sql = new Sql();
		$sql->grew("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha(),
			':ID'=>$this->getIdusuario()
		));
	}

	public function delete(){
		$sql = new Sql();
		$sql->grew("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
			':ID'=>$this->getIdusuario()
		));
		$this->setIdusuario(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcadastro(new DateTime());
	}

	//O método abaixo poderia se útil para simplificar, ainda mais , o chamamento da função insert, dentro do arquivo index.php. Ficaria assim : $aluno = new Usuario("Priscila", "bla569"); e só. Se não adicionássemos as aspas vazias, teríamos, sempre que declarar esses parâmetros.
	public function __construct($login = "", $password = ""){
		$this->setDeslogin($login);
		$this->setDessenha($password);
	}

	public function __toString(){
	return json_encode(array(
		"idusuario"=>$this->getIdusuario(),
		"deslogin"=>$this->getDeslogin(),
		"dessenha"=>$this->getDessenha(),
		"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
	));
}
}
?>