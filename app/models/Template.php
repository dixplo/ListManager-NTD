<?php
namespace models;
/**
 * @table('template')
*/
class Template{
	/**
	 * @id
	 * @column("name"=>"id","nullable"=>false,"dbType"=>"int(11)")
	 * @validator("id","constraints"=>array("autoinc"=>true))
	**/
	private $id;

	/**
	 * @column("name"=>"name","nullable"=>false,"dbType"=>"varchar(100)")
	 * @validator("length","constraints"=>array("max"=>100,"notNull"=>true))
	**/
	private $name;

	/**
	 * @column("name"=>"description","nullable"=>false,"dbType"=>"text")
	 * @validator("notNull")
	**/
	private $description;

	/**
	 * @oneToMany("mappedBy"=>"template","className"=>"models\\Slate")
	**/
	private $slates;

	/**
	 * @manyToOne
	 * @joinColumn("className"=>"models\\User","name"=>"idUser","nullable"=>false)
	**/
	private $user;

	/**
	 * @manyToMany("targetEntity"=>"models\\Action","inversedBy"=>"templates")
	 * @joinTable("name"=>"templateaction")
	**/
	private $actions;

	/**
	 * @manyToMany("targetEntity"=>"models\\Property","inversedBy"=>"templates")
	 * @joinTable("name"=>"templateproperty")
	**/
	private $propertys;

	 public function getId(){
		return $this->id;
	}

	 public function setId($id){
		$this->id=$id;
	}

	 public function getName(){
		return $this->name;
	}

	 public function setName($name){
		$this->name=$name;
	}

	 public function getDescription(){
		return $this->description;
	}

	 public function setDescription($description){
		$this->description=$description;
	}

	 public function getSlates(){
		return $this->slates;
	}

	 public function setSlates($slates){
		$this->slates=$slates;
	}

	 public function getUser(){
		return $this->user;
	}

	 public function setUser($user){
		$this->user=$user;
	}

	 public function getActions(){
		return $this->actions;
	}

	 public function setActions($actions){
		$this->actions=$actions;
	}

	 public function getPropertys(){
		return $this->propertys;
	}

	 public function setPropertys($propertys){
		$this->propertys=$propertys;
	}

	 public function __toString(){
		return $this->description;
	}

}