<?php
class homeController extends Controller {

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

        //$data['products_sold'] = 136;
        //$data['revenue'] = 945.46;
        //$data['expenses'] = 650; 

        $s = new Sales();

        $r = new Revenue();

        $e = new Expenses();

        $data['statuses'] = array(
            '0'=>'Aguardando Pgto.',
            '1'=>'Pago',
            '2'=>'Cancelado'
        );

        $data['products_sold'] = $s->getSoldProducts(date('Y-m-d', strtotime('-30 days')), date('Y-m-d', strtotime('+1 days')), $u->getCompany());

        $data['revenue'] = $r->getTotalRevenue(date('Y-m-d', strtotime('-30 days')), date('Y-m-d', strtotime('+1 days')), $u->getCompany());

        $data['expenses'] = $e->getTotalExpenses(date('Y-m-d', strtotime('-30 days')), date('Y-m-d', strtotime('+1 days')), $u->getCompany());
        
        $data['days_list'] = array();
        for($q=30;$q>=0;$q--) {
            $data['days_list'][] = date('d/m', strtotime('-'.$q.' days'));
        }

        $data['revenue_list'] = $r->getRevenueList(date('Y-m-d', strtotime('-30 days')), date('Y-m-d', strtotime('+1 days')), $u->getCompany());

        $data['expenses_list'] = $e->getExpensesList(date('Y-m-d', strtotime('-30 days')), date('Y-m-d', strtotime('+1 days')), $u->getCompany());

        $data['status_list'] = $s->getQuantStatusList(date('Y-m-d', strtotime('-30 days')), date('Y-m-d', strtotime('+1 days')), $u->getCompany());

       
        $this->loadTemplate('home', $data);
    }

    

}