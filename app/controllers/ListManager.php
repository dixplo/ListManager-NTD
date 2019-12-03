<?php
namespace controllers;
 use models\Item;
 use models\Organization;
 use models\Slate;
 use models\Template;
 use models\User;
 use Ubiquity\orm\DAO;
 use Ubiquity\utils\http\URequest;

 /**
 * Controller ListManager
  * @property JsUtils $jquery
 **/
class ListManager extends ControllerBase{

	public function index()
    {
        $slates = DAO::getAll(Slate::class);
        $this->loadView('ListManager/home.html', ['slates' => $slates]);
    }

    /**
     *@route("afficheItems/{message}")
     **/
	public function afficheItems($message){
        $items=DAO::getAll(Item::class,'idSlate like '.$message.'');
        $this->loadView('ListManager/printItem.html',['items'=>$items]);
	}


    public function createslate(){
        $this->loadView('ListManager/createslate.html');
    }

    /**
     *@route("deleteSlate/{message}")
     **/
    public function deleteSlate($message){
        $items=DAO::getAll(Item::class,'idSlate like '.$message.'');
        if ($items > 0){
            DAO::deleteAll(Item::class,'idSlate like '.$message.'');
            DAO::delete(Slate::class,$message);
        }
        else{
            DAO::delete(Slate::class,$message);
        }
        $this->index();
    }

    public function newslate(){

        $user = DAO::getOne(User::class,(URequest::post('iduser')));
        $template = DAO::getOne(Template::class,(URequest::post('idtemp')));

        $slate = new Slate();
        $slate->setTemplate($template);
        $slate->setUser($user);
        $slate->setDescription(URequest::post('description'));
        $slate->setTitle(URequest::post('title'));

        DAO::save($slate);
        $this->index();

    }





}
