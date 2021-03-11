<?php

require_once("config.php");

/*$sql = new Sql();
$usuarios = $sql->select("SELECT * FROM tb_usuarios");
echo json_encode($usuarios);
echo "<br>";
echo "<hr>";
echo "<pre>";
print_r($usuarios);
echo "</pre>"*/

//*** Carrega um Usuário ***/
/*$root = new Usuario();
$root->loadById(2);
echo $root;*/

//*** Carrega uma Lista de  Usuários ***//
/*$lista = Usuario::getList();
echo "<pre>";
print_r($lista);
echo "</pre>";*/

//*** Carrega uma Lista de  Usuários Buscando pelo Login ***//
/*$search = Usuario::search("c");
print_r($search);
echo "</pre>";*/

//*** Carrega um Usuário Usando o Login e a Senha ***//
/*$usuario = new Usuario();
$usuario->login("josiele", "hygnd89");
echo $usuario;*/

//*** Insert de um Usuário Novo ***//
//$aluno = new Usuario("Priscila", "bla569");

// Sem o método construtor, na classe usuários, teríamos que escrever as linhas baixo:
/*$aluno = new Usuario();
$aluno->setDeslogin("Priscila");
$aluno->setDessenha("bla569");*/
/*$aluno->insert();
echo $aluno;

echo "<pre>";
print_r($aluno);
echo "</pre>";*/

// Alterar um usuário
/*$usuario = new Usuario();
$usuario->loadById(11);
$usuario->update("Dalila", "hyu7800");
echo $usuario;*/

// Deletar um usuário
$usuario = new Usuario();
$usuario->loadById(9);
$usuario->delete();
echo $usuario;

?>