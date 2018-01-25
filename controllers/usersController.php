<?php
class usersController extends controller {

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

        if($u->hasPermission('users_view')){
            $data['users_list'] = $u->getList($u->getCompany());
            
            $this->loadTemplate('users', $data);
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

        if($u->hasPermission('users_view')){
            $p = new Permissions();

            if(isset($_POST['email']) && !empty($_POST['email'])){
                $name = addslashes($_POST['name']);
                $email = addslashes($_POST['email']);
                $pass = addslashes($_POST['password']);
                $group = addslashes($_POST['group']);

                $a = $u->add($name, $email, $pass, $group, $u->getCompany());
                if($a=='1'){
                    header("Location: ".BASE."/users");
                }else{
                    $data['error_msg'] = "Já existe usuário cadastrado com esse e-mail ( ".$email." ) !";
                }
                
            }

            

            $data['group_list'] = $p->getGroupList($u->getCompany());
            
            $this->loadTemplate('users_add', $data);
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

        if($u->hasPermission('users_view')){
            $p = new Permissions();

            if(isset($_POST['group']) && !empty($_POST['group'])){
                $name = addslashes($_POST['name']);
                $pass = addslashes($_POST['password']);
                $group = addslashes($_POST['group']);

                $u->edit($name, $pass, $group, $id, $u->getCompany());
                header("Location: ".BASE."/users");
                
                
            }

            
            $data['user_info'] = $u->getInfo($id,$u->getCompany());
            $data['group_list'] = $p->getGroupList($u->getCompany());
            
            $this->loadTemplate('users_edit', $data);
        }else{
            header("Location: ".BASE);
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

        if($u->hasPermission('users_view')){
            $p = new Permissions();
            $u->delete($id, $u->getCompany());                       
            header("Location: ".BASE."/users");
        }else{
            header("Location: ".BASE);
        }        

    }
    
    

}