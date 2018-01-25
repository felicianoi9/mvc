<?php
class financialController extends controller {

    public function __construct() {
        parent::__construct();

        $u = new Users();

        if($u->isLogged() == false){
        	header("Location: ".BASE."/login");
        }
    }

    public function index() {
    	$data = array();

        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();
        $data['user_name'] = $u->getName();

        

        if($u->hasPermission('financial_view')){
        	
            
            $this->loadTemplate("financial", $data);

        }else{
            header("Location: ".BASE);
        }	
    }

    
    
}    