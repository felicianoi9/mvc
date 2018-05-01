<?php
class purchasesController extends controller {

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

        $data['statuses'] = array(
            '0'=>'Aguardando Correios',
            '1'=>'Recebido',
            '2'=>'Cancelado'
        );

        
        if($u->hasPermission('purchases_view')){
        	$p = new Purchases();
            $offset = 0;
            $data['purchases_list'] = $p->getList($offset, $u->getCompany()); 
            
            $this->loadTemplate("purchases", $data);

        }else{
            header("Location: ".BASE);
        }	
    }

    public function add(){
        $data = array();

        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();
        $data['user_name'] = $u->getName();

        if($u->hasPermission('purchases_view')){
            $p = new Purchases();
            
            if(isset($_POST['provider_id']) && !empty($_POST['provider_id'])){
                $provider_id = addslashes($_POST['provider_id']);
                $name =addslashes($_POST['name']);
                $status =addslashes($_POST['status']);
                $quant = $_POST['quant'];
                $price = addslashes($_POST['price']);
                
                $price = str_replace('.','', $price );
                $price = str_replace(',','.', $price );

                $p->addPurchases($u->getCompany(), $provider_id, $u->getId(), $name, $quant, $status, $price );

                header("Location: ".BASE."/purchases");
            }
            
            $this->loadTemplate("purchases_add", $data);

        }else{
            header("Location: ".BASE);
        }   
    }

    public function edit($id){
        $data = array();

        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();
        $data['user_name'] = $u->getName();

        $data['statuses'] = array(
            '0'=>'Aguardando Correios',
            '1'=>'Recebido',
            '2'=>'Cancelado'
        );

        if($u->hasPermission('purchases_view')){
            $p = new Purchases();

            $data['permission_edit'] = $u->hasPermission('purchases_edit');
            
            if(isset($_POST['status']) && $data['permission_edit']){
                
                $status =addslashes($_POST['status']);

                $p->changeStatus($status, $id, $u->getCompany());
                
                header("Location: ".BASE."/purchases");
                
            }
            
            $data['purchases_info']= $p->getInfo($id, $u->getCompany());

            $this->loadTemplate("purchases_edit", $data);

        }else{
            header("Location: ".BASE."/purchases");
        }   
    }


}
?>
