<?php
namespace models;
/**
 * @table('user')
*/
class User{
	/**
	 * @id
	 * @column("name"=>"id","nullable"=>false,"dbType"=>"int(11)")
	 * @validator("id","constraints"=>array("autoinc"=>true))
	**/
	private $id;

	/**
	 * @column("name"=>"fname","nullable"=>false,"dbType"=>"varchar(30)")
	 * @validator("length","constraints"=>array("max"=>30,"notNull"=>true))
	**/
	private $fname;

	/**
	 * @column("name"=>"name","nullable"=>false,"dbType"=>"varchar(30)")
	 * @validator("length","constraints"=>array("max"=>30,"notNull"=>true))
	**/
	private $name;

	/**
	 * @column("name"=>"email","nullable"=>false,"dbType"=>"varchar(255)")
	 * @validator("email","constraints"=>array("notNull"=>true))
	 * @validator("length","constraints"=>array("max"=>255))
	**/
	private $email;

	/**
	 * @column("name"=>"password","nullable"=>false,"dbType"=>"varchar(30)")
	 * @validator("length","constraints"=>array("max"=>30,"notNull"=>true))
	**/
	private $password;

	/**
	 * @oneToMany("mappedBy"=>"user","className"=>"models\\Item")
	**/
	private $items;

	/**
	 * @oneToMany("mappedBy"=>"user","className"=>"models\\Itemproperty")
	**/
	private $itempropertys;

	/**
	 * @oneToMany("mappedBy"=>"user","className"=>"models\\Slate")
	 * @manyToMany("targetEntity"=>"models\\Slate","inversedBy"=>"users")
	 * @joinTable("name"=>"partage","joinColumns"=>array("name"=>"iduser","referencedColumnName"=>"id"))
	**/
	private $slates;

	/**
	 * @oneToMany("mappedBy"=>"user","className"=>"models\\Template")
	**/
	private $templates;

	 public function getId(){
		return $this->id;
	}

	 public function setId($id){
		$this->id=$id;
	}

	 public function getFname(){
		return $this->fname;
	}

	 public function setFname($fname){
		$this->fname=$fname;
	}

	 public function getName(){
		return $this->name;
	}

	 public function setName($name){
		$this->name=$name;
	}

	 public function getEmail(){
		return $this->email;
	}

	 public function setEmail($email){
		$this->email=$email;
	}

	 public function getPassword(){
		return $this->password;
	}

	 public function setPassword($password){
		$this->password=$password;
	}

	 public function getItems(){
		return $this->items;
	}

	 public function setItems($items){
		$this->items=$items;
	}

	 public function getItempropertys(){
		return $this->itempropertys;
	}

	 public function setItempropertys($itempropertys){
		$this->itempropertys=$itempropertys;
	}

	 public function getSlates(){
		return $this->slates;
	}

	 public function setSlates($slates){
		$this->slates=$slates;
	}

	 public function getTemplates(){
		return $this->templates;
	}

	 public function setTemplates($templates){
		$this->templates=$templates;
	}

	 public function __toString(){
		return $this->email;
	}

}