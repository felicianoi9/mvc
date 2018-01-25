<?php
class permissionsController extends controller {

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
        if($u->hasPermission('permissions_view')){
            $permissions = new Permissions();
            $data['permissions_list'] = $permissions->getList($u->getCompany());
            $data['permissions_group_list'] = $permissions->getGroupList($u->getCompany());
            $this->loadTemplate('permissions', $data);
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

        if($u->hasPermission('permissions_view')){
            $permissions = new Permissions();
            if(isset($_POST['name']) && !empty($_POST['name'])){
                $pname = addslashes($_POST['name']);
                $pname2 = addslashes($_POST['name2']);
                $permissions->add($pname, $pname2, $u->getCompany());
                header("Location: ".BASE."/permissions");
            }
            
            $this->loadTemplate('permissions_add', $data);
        }else{
            header("Location: ".BASE);
        }
        
        
        
    }

    public function add_group(){
        $data = array();

        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();
        $data['user_name'] = $u->getName();

        if($u->hasPermission('permissions_view')){
            $permissions = new Permissions();
            if(isset($_POST['name']) && !empty($_POST['name'])){
                $pname = addslashes($_POST['name']);
                $plist = $_POST['permissions'];
                $permissions->addGroup($pname, $plist, $u->getCompany());
                header("Location: ".BASE."/permissions");
            }

            $data['permissions_list'] = $permissions->getList($u->getCompany());
            
            $this->loadTemplate('permissions_add_group', $data);
        }else{
            header("Location: ".BASE);
        }
    }

    public function delete($id) {
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();
        $data['user_name'] = $u->getName();


        if($u->hasPermission('permissions_view')){
            $permissions = new Permissions();
            $permissions->delete($id);
            header("Location: ".BASE."/permissions");
        }else{
            header("Location: ".BASE);
        }
        
        
        
    }

    public function delete_group($id){

        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();
        $data['user_name'] = $u->getName();


        if($u->hasPermission('permissions_view')){
            $permissions = new Permissions();
            $permissions->deleteGroup($id);
            header("Location: ".BASE."/permissions");
        }else{
            header("Location: ".BASE);
        }
        
    }

    public function edit_group($id){
        $data = array();

        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();
        $data['user_name'] = $u->getName();

        if($u->hasPermission('permissions_view')){
            $permissions = new Permissions();
            if(isset($_POST['name']) && !empty($_POST['name'])){
                $pname = addslashes($_POST['name']);
                $plist = $_POST['permissions'];
                $permissions->editGroup($pname, $plist, $id,  $u->getCompany());
                header("Location: ".BASE."/permissions");
            }

            $data['permissions_list'] = $permissions->getList($u->getCompany());
            $data['group_info'] = $permissions->getGroup($id, $u->getCompany());
            
            $this->loadTemplate('permissions_edit_group', $data);
        }else{
            header("Location: ".BASE);
        }
    }

    

}