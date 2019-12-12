<?php
namespace controllers;
use models\Slate;
use models\User;
use Ubiquity\orm\DAO;
use Ubiquity\utils\http\USession;
use Ubiquity\utils\http\URequest;

 /**
 * Auth Controller AuthController
 * @route("/AuthController","inherited"=>true,"automated"=>true)
 **/
class AuthController extends \Ubiquity\controllers\auth\AuthController{

	protected function onConnect($connected) {
		$urlParts=$this->getOriginalURL();
		USession::set($this->_getUserSessionKey(), $connected);
		if(isset($urlParts)){
			$this->_forward(implode("/",$urlParts));
		}else{
			//TODO
			//Forwarding to the default controller/action
            $this->_forward("ListManager");
        }
	}

	protected function _connect() {
		if(URequest::isPost()){
			$email=URequest::post($this->_getLoginInputName());
			$password=URequest::post($this->_getPasswordInputName());
			//TODO
			//Loading from the database the user corresponding to the parameters
            $user = DAO::getOne(User::class, "email='$email'");
            if(empty($user)){
                echo "mail not exist on our database";
            }else{
                $userMPD = $user->getPassword();
                $userMAIL = $user->getEmail();

                //Checking user creditentials
                if($email==$userMAIL){

                    if($userMPD == $password){
                        //Returning the user
                        return $user;
                        USession::set("activeUser",$user);
                    }
                }
            }
		}
        return;
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\auth\AuthController::isValidUser()
	 */
	public function _isValidUser($action=null) {
		return USession::exists($this->_getUserSessionKey());
	}

	public function _getBaseRoute() {
		return '/AuthController';
	}

    public function _displayInfoAsString() {
        return true;
    }

}
