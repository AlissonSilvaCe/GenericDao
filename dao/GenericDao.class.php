<?php
/*
  * Classe GenericDAO
  * classe que será herdada pelas Classes DAO do sistema
  * para realização de inserão, exclusão e edição de elementos no 
  * banco de dados
  */
include_once '../conexao/Conexao.class.php';

//usando o metodo getconnection do singleton conexao
$conn = Conexao::getConnection();

class GenericDao {	
 /*
 * Metodo salvar = Executa a inserção de dados no BD
 */
 public function save($query,$campos){
 	
 try {
 	
            $stmt = $this->conn->prepare($query);
            
            foreach ($campos as $i => $parametros){
            	
            	$stmt->bindValue($i, $parametros);
            }
            	
            $stmt->execute();
            
        }catch(connException $ex){
            echo "Erro: ".$ex->getMessage();
        }
 }
 
 /*
 * Metodo excluir = Executa a exclusão no banco de dados
 * $query = string de conexao com o banco de dados
 * $campos = array com os parametros do bindvalue
 */
    public function delete($query,$id) {
    	
        try {
            
            $stmt = $this->conn->prepare($query);
        	
            $stmt->bindValue(1, $id);
            
            $stmt->execute();
            
        }catch(connException $ex){
            echo "Erro: ".$ex->getMessage();
        }
    }
  
/*
* Metodo editar = Executa a alterações no banco de dados
* $query = string de conexao com o banco de dados
* $campos = array com os parametros do bindvalu
*/ 
 public function update($query,$campos){
   
   try{
   	
       $stmt = $this->conn->prepare($query);
       
       $this->conn->beginTransaction();
       
   	   foreach($campos as $i => $parametros){
            	
            	$stmt->bindValue($i, $parametros);
            }
       
       $stmt->execute();
       
       $this->conn->commit();
       
       }catch(connException $ex){  
          echo "Erro: ".$ex->getMessage(); 
       }
 	}
 	
 	
/* realiza uma consulta no banco dados com parametros no bindvalue*/
public function select($query,$campos){
 	
 try {
 	
            $stmt = $this->conn->prepare($query);
            
            foreach ($campos as $i => $parametros){
            	
            	$stmt->bindValue($i, $parametros);
            }
            	
            $stmt->execute();
            
            return $stmt;
            
        }catch(connException $ex){
            echo "Erro: ".$ex->getMessage();
        }
 }
 
 /* realiza uma consulta no banco dados sem parametros no bindvalue*/
 public function selectAll($query){
 
 	try {
 
 		$stmt = $this->conn->prepare($query);
 		$stmt->execute();
 
 		return $stmt;
 
 	}catch(connException $ex) {
 		echo "Erro: ".$ex->getMessage();
 	}
 }
 
 	
}
?>
