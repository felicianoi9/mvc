<?php
class expensesController extends controller {

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

        

        if($u->hasPermission('expenses_view')){
        	$e= new Expenses();

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
            
            $data['expenses_list']= $e->getList($offset,$u->getCompany());
            $data['expenses_count'] = $e->getCount($u->getCompany());
            $data['p_count'] = ceil($data['expenses_count']/8);
            $data['edit_permission']=$u->hasPermission('expenses_view');

            
            
            $this->loadTemplate("expenses_view", $data);

        }else{
            header("Location: ".BASE."/ops");
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

        

        if($u->hasPermission('expenses_view')){
            


            if(isset($_POST['name_desc']) && !empty($_POST['name_desc'])){
                $e= new Expenses();

                $name_desc = addslashes($_POST['name_desc']);
                $price = addslashes($_POST['price']);

                $price = str_replace('.','',$price);
                $price = str_replace(',','.',$price);

                

                $e->add( $u->getCompany(),$u->getId() , $name_desc, $price );

                

                header("Location: ".BASE."/expenses");

            }

            $this->loadTemplate("expenses_add", $data);

        }else{
            header("Location: ".BASE."/ops");
        }   
    }

    public function edit($id) {
        $data = array();

        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();
        $data['user_name'] = $u->getName();

        $e= new Expenses();

        $data['expense']=$e->getInfoById($id, $u->getCompany() );

        //echo '<pre>';print_r($data['expense']);exit;



        if($u->hasPermission('expenses_edit')){
            


            //if(isset($_POST['name_desc']) && !empty($_POST['name_desc'])){
            //    $e= new Expenses();

            //    $name_desc = addslashes($_POST['name_desc']);
            //    $price = addslashes($_POST['price']);

            //    $price = str_replace('.','',$price);
            //    $price = str_replace(',','.',$price);

                

            //    $e->add( $u->getCompany(),$u->getId() , $name_desc, $price );

                

            //    header("Location: ".BASE."/expenses");

            //}

            $this->loadTemplate("expenses_edit", $data);

        }else{
            header("Location: ".BASE."/ops");
        }   
    }

    
    
}    