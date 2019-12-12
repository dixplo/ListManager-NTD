<?php
namespace models;
/**
 * @table('property')
*/
class Property{
	/**
	 * @id
	 * @column("name"=>"id","nullable"=>false,"dbType"=>"int(11)")
	 * @validator("id","constraints"=>array("autoinc"=>true))
	**/
	private $id;

	/**
	 * @column("name"=>"name","nullable"=>true,"dbType"=>"varchar(45)")
	 * @validator("length","constraints"=>array("max"=>45))
	**/
	private $name;

	/**
	 * @oneToMany("mappedBy"=>"property","className"=>"models\\Itemproperty")
	**/
	private $itempropertys;

	/**
	 * @manyToMany("targetEntity"=>"models\\Template","inversedBy"=>"propertys")
	 * @joinTable("name"=>"templateproperty")
	**/
	private $templates;

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

	 public function getItempropertys(){
		return $this->itempropertys;
	}

	 public function setItempropertys($itempropertys){
		$this->itempropertys=$itempropertys;
	}

	 public function getTemplates(){
		return $this->templates;
	}

	 public function setTemplates($templates){
		$this->templates=$templates;
	}

	 public function __toString(){
		return $this->id;
	}

}