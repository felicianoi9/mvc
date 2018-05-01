<?php
class revenueController extends controller {

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

        

        if($u->hasPermission('revenue_view')){
        	$r= new Revenue();

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
            
            $data['revenue_list']= $r->getList($offset,$u->getCompany());

            //echo '<pre>'; print_r($data['revenue_list']);exit;
            $data['revenue_count'] = $r->getCount($u->getCompany());
            $data['p_count'] = ceil($data['revenue_count']/8);
            $data['edit_permission']=$u->hasPermission('revenue_view');

            
            
            $this->loadTemplate("revenue_view", $data);

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

        

        if($u->hasPermission('revenue_add')){
            


            if(isset($_POST['name_desc']) && !empty($_POST['name_desc'])){
                $r= new Revenue();

                $name_desc = addslashes($_POST['name_desc']);
                $price = addslashes($_POST['total_price']);

                $price = str_replace('.','',$price);
                $price = str_replace(',','.',$price);

                

                $r->add( $u->getCompany(),$u->getId() , $name_desc, $price );

                

                header("Location: ".BASE."/revenue");

            }

            $this->loadTemplate("revenue_add", $data);

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

        $r= new Revenue();

        $data['revenue']=$r->getInfoById($id, $u->getCompany() );

        //echo '<pre>';print_r($data['revenue']);exit;



        if($u->hasPermission('revenue_edit')){
            


            //if(isset($_POST['name_desc']) && !empty($_POST['name_desc'])){
            //    $e= new Expenses();

            //    $name_desc = addslashes($_POST['name_desc']);
            //    $price = addslashes($_POST['price']);

            //    $price = str_replace('.','',$price);
            //    $price = str_replace(',','.',$price);

                

            //    $e->add( $u->getCompany(),$u->getId() , $name_desc, $price );

                

            //    header("Location: ".BASE."/expenses");

            //}

            $this->loadTemplate("revenue_edit", $data);

        }else{
            header("Location: ".BASE."/ops");
        }   
    }
}    