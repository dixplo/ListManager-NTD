<?php
namespace models;
/**
 * @table('item')
*/
class Item{
	/**
	 * @id
	 * @column("name"=>"id","nullable"=>false,"dbType"=>"int(11)")
	 * @validator("id","constraints"=>array("autoinc"=>true))
	**/
	private $id;

	/**
	 * @column("name"=>"label","nullable"=>true,"dbType"=>"varchar(45)")
	 * @validator("length","constraints"=>array("max"=>45))
	**/
	private $label;

	/**
	 * @column("name"=>"checked","nullable"=>true,"dbType"=>"tinyint(1)")
	 * @validator("isBool")
	**/
	private $checked;

	/**
	 * @column("name"=>"value","nullable"=>true,"dbType"=>"varchar(45)")
	 * @validator("length","constraints"=>array("max"=>45))
	**/
	private $value;

	/**
	 * @column("name"=>"order","nullable"=>true,"dbType"=>"int(11)")
	**/
	private $order;

	/**
	 * @column("name"=>"dateC","nullable"=>true,"dbType"=>"datetime")
	 * @validator("type","dateTime")
	**/
	private $dateC;

	/**
	 * @column("name"=>"dateM","nullable"=>true,"dbType"=>"datetime")
	 * @validator("type","dateTime")
	**/
	private $dateM;

	/**
	 * @oneToMany("mappedBy"=>"item","className"=>"models\\Itemproperty")
	**/
	private $itempropertys;

	/**
	 * @manyToOne
	 * @joinColumn("className"=>"models\\Slate","name"=>"idSlate","nullable"=>false)
	**/
	private $slate;

	/**
	 * @manyToOne
	 * @joinColumn("className"=>"models\\User","name"=>"idUser","nullable"=>false)
	**/
	private $user;

	 public function getId(){
		return $this->id;
	}

	 public function setId($id){
		$this->id=$id;
	}

	 public function getLabel(){
		return $this->label;
	}

	 public function setLabel($label){
		$this->label=$label;
	}

	 public function getChecked(){
		return $this->checked;
	}

	 public function setChecked($checked){
		$this->checked=$checked;
	}

	 public function getValue(){
		return $this->value;
	}

	 public function setValue($value){
		$this->value=$value;
	}

	 public function getOrder(){
		return $this->order;
	}

	 public function setOrder($order){
		$this->order=$order;
	}

	 public function getDateC(){
		return $this->dateC;
	}

	 public function setDateC($dateC){
		$this->dateC=$dateC;
	}

	 public function getDateM(){
		return $this->dateM;
	}

	 public function setDateM($dateM){
		$this->dateM=$dateM;
	}

	 public function getItempropertys(){
		return $this->itempropertys;
	}

	 public function setItempropertys($itempropertys){
		$this->itempropertys=$itempropertys;
	}

	 public function getSlate(){
		return $this->slate;
	}

	 public function setSlate($slate){
		$this->slate=$slate;
	}

	 public function getUser(){
		return $this->user;
	}

	 public function setUser($user){
		$this->user=$user;
	}

	 public function __toString(){
		return $this->id;
	}

}