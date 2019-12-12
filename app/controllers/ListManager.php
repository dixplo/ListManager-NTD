<?php
namespace controllers;
 use models\Item;
 use models\Slate;
 use models\Template;
 use models\User;
 use Ubiquity\controllers\auth\WithAuthTrait;
 use Ubiquity\orm\DAO;
 use Ubiquity\utils\http\URequest;
 use Ubiquity\utils\http\USession;
 use Ajax\php\ubiquity\JsUtils;
use Ajax;

 /**
 * Controller ListManager
  * @property JsUtils $jquery
 **/
class ListManager extends ControllerBase{


    //Code necessaire pour user_info
    use WithAuthTrait;
    protected function getAuthController(): \Ubiquity\controllers\auth\AuthController {
        return new AuthController();
        return new ListManager();
    }

	public function index()
    {
        $activeUser = USession::get("activeUser");
        $activeUserID = $activeUser->getId();

        $slates = DAO::getAll(Slate::class,"idUser=$activeUserID");


        // Pour que le javascript "agisse" sur toutes les balises <a>
        $this->jquery->getHref("a._listes", null, ["historize"=>false]);

        // Remplacement du loadView par renderView pour compiler le javaScript
        $this->jquery->renderView('ListManager/home.html', ['slates' => $slates]);
    }

    /**
     *@route("afficheItems/{message}")
     **/
	public function afficheItems($message){
        USession::set("activeSlate",$message);
        $items=DAO::getAll(Item::class,'idSlate like '.$message.'');
        //validbtn = id bouton submit du form, formadd = id du formulaire, permet d'executer du js au click du bouton du formulaire
        $this->jquery->postFormOnClick("#validbtn", "ListManager/newItem", "formadd", "#recepteur");
        // Preparation en jquery pour l'affichage des items sans actualisation
        $this->jquery->getHref("._delete", "#recepteur", ["historize"=>false]);
        $this->jquery->renderView('ListManager/printItem.html',['items'=>$items]);
	}


    public function createslate(){
        $templates = DAO::getAll(Template::class);
        $users = DAO::getAll(User::class);

        $this->loadView('ListManager/createslate.html',['templates' => $templates, 'users' => $users]);
    }

    /**
     *@route("deleteSlate/{message}")
     **/
    public function deleteSlate($message){
        DAO::delete(Slate::class,$message);
        $this->index();
    }

    public function newslate(){
        $user = USession::get("activeUser");
        $template = DAO::getOne(Template::class,(URequest::post('idtemp')));

        $slate = new Slate();
        $slate->setTemplate($template);
        $slate->setUser($user);
        $slate->setDescription(URequest::post('description'));
        $slate->setTitle(URequest::post('title'));
        DAO::save($slate);
        $this->index();
    }

    public function newItem(){
        
        $itemL = URequest::post('itemL'); //récupération des items par rapport à la session
        $slate= DAO::getOne(Slate::class,USession::get("activeSlate")); 
        
        $item = new Item();
        //$item->setChecked(false);
        $item->setLabel($itemL); 
        $item->setUser(USession::get("activeUser"));
        $item->setSlate($slate);
        DAO::save($item);
        
        $this->afficheItems($slate->getId());
    }
    

    public function deleteItem($idItem){
        DAO::delete(Item::class,$idItem);
        $slate= DAO::getOne(Slate::class,USession::get("activeSlate"));
        
        
        $this->afficheItems($slate->getId());
    }

    public function checkItem($idItem){
        $item= DAO::getOne(Item::class,$idItem);
        $item->setChecked();
        DAO::delete(Item::class,$idItem);
        $this->index();
    }
}
