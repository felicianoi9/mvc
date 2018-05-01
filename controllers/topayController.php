<?php
class topayController extends controller {

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
            '1'=>'A Pagar',
            '2'=>'Pago'
            
        );

        

        if($u->hasPermission('financial_view')){

            $t= new Topay();

            $offset = 0; 
            $data['p'] = 1;
            if(isset($_GET['p']) && !empty($_GET['p'])){
                $data['p'] = intVal($_GET['p']);
                if($data['p']==0){
                   $data['p']==1; 
                }else{

                }
            }

            $offset = (8*($data['p']-1));
            
            $data['topay_list']= $t->getList($offset,$u->getCompany());
            $data['topay_count'] = $t->getCount($u->getCompany());
            $data['p_count'] = ceil($data['topay_count']/8);
            $data['edit_permission']=$u->hasPermission('financial_view');

        	
            
            $this->loadTemplate("topay", $data);

        }else{
            header("Location: ".BASE);
        }	
    }

    public function add() {
        $data = array();

        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();
        $data['user_name'] = $u->getName();

        

        if($u->hasPermission('financial_view')){
            


            if(isset($_POST['description']) && !empty($_POST['description'])){
                $t= new Topay();

                $description = addslashes($_POST['description']);
                $maturity = addslashes($_POST['maturity']); 
                $n_pmt = addslashes($_POST['n_pmt']);
                $pmt_n = addslashes($_POST['pmt_n']);
                
                $price = addslashes($_POST['price']);

                $price = str_replace('.','',$price);
                $price = str_replace(',','.',$price);

                $maturity= explode('/', $maturity); 
                $tmp= $maturity[0];  
                $maturity[0] = $maturity[2];
                $maturity[2] = $tmp;

                $maturity= implode('-', $maturity); 
                

                $t->add( $u->getCompany(),$u->getId() , $description, $maturity, $n_pmt, $pmt_n, $price );

                

                header("Location: ".BASE."/topay");

            }

            $this->loadTemplate("topay_add", $data);

        }else{
            header("Location: ".BASE."/ops");
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
            '1'=>'A Pagar',
            '2'=>'Pago'
            
        );

        if($u->hasPermission('financial_view')){
            $t = new Topay();

            $data['permission_edit'] = $u->hasPermission('financial_edit');
            
            if(isset($_POST['status']) && $data['permission_edit']){
                
                $status =addslashes($_POST['status']);

                $t->changeStatus($status, $id, $u->getCompany());
                
                header("Location: ".BASE."/topay");
                
            }
            
            

            $this->loadTemplate("topay_edit", $data);

        }else{
            header("Location: ".BASE);
        }   
    }

    
    
}    