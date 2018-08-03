<?php

namespace Models

use core\DB;
use core\DBerror;

class UserModel extends BaseModel
{   

    public static function Instance()
    {
        if(self::$instance == null) {
            self::$instance = new UserModel();
        }
        return self::$instance;
    } 

    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
        $this->pk = 'id_user';
        $this->dt = 'dt_reg';
    }
    /**
    *Класс, предназначенный для операций записи, редактирования и удаления учетной записи в БД.
    */      
    
    public function newUser($login, $password, $email)
    {			
		$query = $this->db->prepare("INSERT INTO {$this->table} (login, password, email) VALUES (:login, :password, :email)");
		$params = ['login' => $login,'password'=> $password, 'email' => $email];
		$res = $query->execute($params);
		
		if(!$res){
			DBerror::db_error_log($query);
		}
		return $this->db->lastInsertID();
    }
    /**
    *
    */    
    
    public function updatePassword($login, $password, $id)
    {
		$masq = ['password' => $password];
		$query = $this->db->prepare("UPDATE {$this->table} SET password =:password WHERE {$this->pk}='$id', login = '$login', password = '$password'");	 			
		$query->execute($masq);
		if(!$res){
			DBerror::db_error_log($query);
		}
 		return $squery->fetch();	
    }
    /**
    *
    */
    public function delUser($id, $login, $password)
    {
    	$query = $this->db->prepare("DELETE FROM {$this->table} WHERE {$this->pk} = '$id', login = '$login', password = '$password'");
        $query->execute();
        if(!$res){
			DBerror::db_error_log($query);
		}    
    	return $query->fetch();
    }
}