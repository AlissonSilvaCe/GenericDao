<?php

class FuncionarioDao extends GenericDao{
	
	//metodo para autenticação de usuários
	public function autenticar($idsocial,$senha){
	
			$query = "SELECT idf,idsocial,senha
                        FROM funcionario
    				   WHERE lower(idsocial)=? AND senha=? AND status=1";
			
			$campos  = array(1=> strtolower($idsocial), 2=> $senha);
			
			return parent::select($query, $campos);
			
	}
	
	//metodos para recuperação de senha
	public function verificaEmail($email){
		 
		$query = "SELECT email,idsocial FROM funcionario WHERE email=?";
	
		$campos = array(1=> $email);
		return parent::select($query, $campos);
	
	}
	
	
	public function atualizaSenha($email,$novasenha){
	
		//query de inserção no banco de dados
		$query = "UPDATE funcionario SET senha=? WHERE email=?";
		 
		//parametros do bindValue
		$campos = array(1 => $novasenha,2 => $email);
		parent::update($query, $campos);
	}
	
}