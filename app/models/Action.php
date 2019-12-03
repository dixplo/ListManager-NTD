<?php
namespace models;
/**
 * @table('action')
*/
class Action{
	/**
	 * @id
	 * @column("name"=>"id","nullable"=>false,"dbType"=>"int(11)")
	 * @validator("id","constraints"=>array("autoinc"=>true))
	**/
	private $id;

	/**
	 * @column("name"=>"name","nullable"=>false,"dbType"=>"varchar(30)")
	 * @validator("length","constraints"=>array("max"=>30,"notNull"=>true))
	**/
	private $name;

	/**
	 * @column("name"=>"action","nullable"=>false,"dbType"=>"varchar(30)")
	 * @validator("length","constraints"=>array("max"=>30,"notNull"=>true))
	**/
	private $action;

	/**
	 * @column("name"=>"global","nullable"=>false,"dbType"=>"tinyint(1)")
	 * @validator("isBool","constraints"=>array("notNull"=>true))
	**/
	private $global;

	/**
	 * @manyToMany("targetEntity"=>"models\\Template","inversedBy"=>"actions")
	 * @joinTable("name"=>"templateaction")
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

	 public function getAction(){
		return $this->action;
	}

	 public function setAction($action){
		$this->action=$action;
	}

	 public function getGlobal(){
		return $this->global;
	}

	 public function setGlobal($global){
		$this->global=$global;
	}

	 public function getTemplates(){
		return $this->templates;
	}

	 public function setTemplates($templates){
		$this->templates=$templates;
	}

	 public function __toString(){
		return $this->global;
	}

}