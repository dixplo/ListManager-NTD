<?php
namespace models;
/**
 * @table('itemproperty')
*/
class Itemproperty{
	/**
	 * @id
	 * @column("name"=>"idItem","nullable"=>false,"dbType"=>"int(11)")
	 * @validator("id","constraints"=>array("autoinc"=>true))
	**/
	private $idItem;

	/**
	 * @id
	 * @column("name"=>"idProperty","nullable"=>false,"dbType"=>"int(11)")
	 * @validator("id","constraints"=>array("autoinc"=>true))
	**/
	private $idProperty;

	/**
	 * @id
	 * @column("name"=>"idUser","nullable"=>false,"dbType"=>"int(11)")
	 * @validator("id","constraints"=>array("autoinc"=>true))
	**/
	private $idUser;

	/**
	 * @column("name"=>"value","nullable"=>true,"dbType"=>"varchar(45)")
	 * @validator("length","constraints"=>array("max"=>45))
	**/
	private $value;

	/**
	 * @manyToOne
	 * @joinColumn("className"=>"models\\Item","name"=>"idItem","nullable"=>false)
	**/
	private $item;

	/**
	 * @manyToOne
	 * @joinColumn("className"=>"models\\Property","name"=>"idProperty","nullable"=>false)
	**/
	private $property;

	/**
	 * @manyToOne
	 * @joinColumn("className"=>"models\\User","name"=>"idUser","nullable"=>false)
	**/
	private $user;

	 public function getIdItem(){
		return $this->idItem;
	}

	 public function setIdItem($idItem){
		$this->idItem=$idItem;
	}

	 public function getIdProperty(){
		return $this->idProperty;
	}

	 public function setIdProperty($idProperty){
		$this->idProperty=$idProperty;
	}

	 public function getIdUser(){
		return $this->idUser;
	}

	 public function setIdUser($idUser){
		$this->idUser=$idUser;
	}

	 public function getValue(){
		return $this->value;
	}

	 public function setValue($value){
		$this->value=$value;
	}

	 public function getItem(){
		return $this->item;
	}

	 public function setItem($item){
		$this->item=$item;
	}

	 public function getProperty(){
		return $this->property;
	}

	 public function setProperty($property){
		$this->property=$property;
	}

	 public function getUser(){
		return $this->user;
	}

	 public function setUser($user){
		$this->user=$user;
	}

	 public function __toString(){
		return $this->idItem;
	}

}