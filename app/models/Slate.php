<?php
namespace models;
/**
 * @table('slate')
*/
class Slate{
	/**
	 * @id
	 * @column("name"=>"id","nullable"=>false,"dbType"=>"int(11)")
	 * @validator("id","constraints"=>array("autoinc"=>true))
	**/
	private $id;

	/**
	 * @column("name"=>"title","nullable"=>true,"dbType"=>"varchar(45)")
	 * @validator("length","constraints"=>array("max"=>45))
	**/
	private $title;

	/**
	 * @column("name"=>"description","nullable"=>true,"dbType"=>"text")
	**/
	private $description;

	/**
	 * @oneToMany("mappedBy"=>"slate","className"=>"models\\Item")
	**/
	private $items;

	/**
	 * @manyToOne
	 * @joinColumn("className"=>"models\\Template","name"=>"idTemplate","nullable"=>false)
	**/
	private $template;

	/**
	 * @manyToOne
	 * @joinColumn("className"=>"models\\User","name"=>"idUser","nullable"=>false)
	**/
	private $user;

	/**
	 * @manyToMany("targetEntity"=>"models\\User","inversedBy"=>"slates")
	 * @joinTable("name"=>"partage","inverseJoinColumns"=>array("name"=>"iduser","referencedColumnName"=>"id"))
	**/
	private $users;

	 public function getId(){
		return $this->id;
	}

	 public function setId($id){
		$this->id=$id;
	}

	 public function getTitle(){
		return $this->title;
	}

	 public function setTitle($title){
		$this->title=$title;
	}

	 public function getDescription(){
		return $this->description;
	}

	 public function setDescription($description){
		$this->description=$description;
	}

	 public function getItems(){
		return $this->items;
	}

	 public function setItems($items){
		$this->items=$items;
	}

	 public function getTemplate(){
		return $this->template;
	}

	 public function setTemplate($template){
		$this->template=$template;
	}

	 public function getUser(){
		return $this->user;
	}

	 public function setUser($user){
		$this->user=$user;
	}

	 public function getUsers(){
		return $this->users;
	}

	 public function setUsers($users){
		$this->users=$users;
	}

	 public function __toString(){
		return $this->id;
	}

}