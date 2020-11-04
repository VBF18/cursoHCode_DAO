<?php  

require_once("config.php");

/*$sql = new Sql();
$usuarios = $sql->select("SELECT * FROM tb_usuarios");
echo json_encode($usuarios);*/

//*** Carrega um Usuário ***//
/*$root = new Usuario();
$root->loadById(5);
echo $root;*/

//*** Carrega uma Lista de  Usuários ***//
/*$lista = Usuario::getList();
echo "<pre>";
print_r($lista); 
echo "</pre>";*/

//*** Carrega uma Lista de  Usuários Buscando pelo Login ***//
/*$search = Usuario::search("m");
echo "<pre>";
print_r($search); 
echo "</pre>"*/

//*** Carrega um Usuário Usando o Login e a Senha ***//
$usuario = new Usuario();
$usuario->login("tedi", "hhsdy78");
echo $usuario; 

?>