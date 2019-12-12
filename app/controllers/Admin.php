<?php
namespace controllers;
use Ubiquity\controllers\admin\UbiquityMyAdminBaseController;
use Ubiquity\controllers\auth\WithAuthTrait;

class Admin extends UbiquityMyAdminBaseController{
    use WithAuthTrait;
    protected function getAuthController(): \Ubiquity\controllers\auth\AuthController {
        return new AuthController();
        return new ListManager();
    }
}
