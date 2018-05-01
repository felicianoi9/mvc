<?php
class providersController extends controller {

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

        if($u->hasPermission('providers_view')){
            $p= new Providers();
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
            
            $data['providers_list']=$p->getList($offset,$u->getCompany());
            $data['providers_count'] = $p->getCount($u->getCompany());
            $data['p_count'] = ceil($data['providers_count']/8);
            $data['edit_permission']=$u->hasPermission('providers_edit');


            $this->loadTemplate('providers', $data);
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

        if($u->hasPermission('providers_edit')){
            $p = new Providers();
            

            if(isset($_POST['name']) && !empty($_POST['name'])){
                $name = addslashes($_POST['name']);
                $email = addslashes($_POST['email']);
                $phone = addslashes($_POST['phone']);
                $stars = addslashes($_POST['stars']);
                $internal_obs = addslashes($_POST['internal_obs']);
                $address_zipcode = addslashes($_POST['address_zipcode']);
                $address = addslashes($_POST['address']);
                $address_number = addslashes($_POST['address_number']);
                $address2 = addslashes($_POST['address2']);
                $address_neighb = addslashes($_POST['address_neighb']);
                $address_city = addslashes($_POST['address_city']);
                $address_state = addslashes($_POST['address_state']);
                $address_country = addslashes($_POST['address_country']);



                $p->add($u->getCompany(), $name, $email, $phone, $stars, $internal_obs, $address_zipcode, $address, $address_number, $address2, $address_neighb, $address_city, $address_state, $address_country );
                header("Location: ".BASE."/providers");
            }
            
            
            $this->loadTemplate('providers_add', $data);
        }else{
            header("Location: ".BASE."/providers");
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

        if($u->hasPermission('providers_edit')){
            $p = new Providers();
            

            if(isset($_POST['name']) && !empty($_POST['name'])){
                $name = addslashes($_POST['name']);
                $email = addslashes($_POST['email']);
                $phone = addslashes($_POST['phone']);
                $stars = addslashes($_POST['stars']);
                $internal_obs = addslashes($_POST['internal_obs']);
                $address_zipcode = addslashes($_POST['address_zipcode']);
                $address = addslashes($_POST['address']);
                $address_number = addslashes($_POST['address_number']);
                $address2 = addslashes($_POST['address2']);
                $address_neighb = addslashes($_POST['address_neighb']);
                $address_city = addslashes($_POST['address_city']);
                $address_state = addslashes($_POST['address_state']);
                $address_country = addslashes($_POST['address_country']);
                
                $p->edit($id, $u->getCompany(), $name, $email, $phone, $stars, $internal_obs, $address_zipcode, $address, $address_number, $address2, $address_neighb, $address_city, $address_state, $address_country );
                header("Location: ".BASE."/providers");
            }

            $data['provider_info'] = $p->getInfo($id, $u->getCompany());
            
            
            $this->loadTemplate('providers_edit', $data);
        }else{
            header("Location: ".BASE."/providers");
        }
    }  

    public function delete($id){
        $data = array();

        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();
        $data['user_name'] = $u->getName();

        if($u->hasPermission('providers_edit')){
            $p = new Providers();
            $p->del($id, $u->getCompany());
            header("Location: ".BASE."/providers");
            $this->loadTemplate('providers_edit', $data);
        }else{
            header("Location: ".BASE."/providers");
        }
    } 

    public function view($id){
        echo "Falta fazer!";
    } 
}    