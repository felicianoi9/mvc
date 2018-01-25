<?php
class Expenses extends Model{
	public function getList($offset, $id_company){
		$array = array();
		
		$sql = $this->db->prepare("SELECT * FROM expenses WHERE id_company=:id_company ORDER BY  date_expense DESC LIMIT $offset, 8 ");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
		
		if($sql->rowCount()>0){
			$array = $sql->fetchAll();
		}
		
		return $array;
	}

	public function getInfoById($id, $id_company){
		$array = array();
		
		$sql = $this->db->prepare("SELECT * FROM expenses WHERE id_company=:id_company AND id=:id ");
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":id", $id);
		$sql->execute();
		
		if($sql->rowCount()>0){
			$array['info'] = $sql->fetch();
		}

		

		if($array['info']['id_purchase']>0){

			$id_purchase = $array['info']['id_purchase'];
			$p= new Purchases();

			$array['products']=$p->getProds($id_purchase, $id_company);

		}else{
			$array['products']='';
		}
		
		
		return $array;
	}

	public function getCount($id_company) {
		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) as c FROM expenses WHERE id_company = :id_company");
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['c'];

		return $r;
	}

	public function addExpenses( $id_company, $id_provider, $id_user, $id_purchase='', $price ){
		
		$p = new Providers();
		$name= $p->getName($id_provider, $id_company);
		$name_desc = "Compra do fornecedor ".$name;

		
		$sql = $this->db->prepare("INSERT INTO expenses SET id_company=:id_company, name_desc=:name_desc ,id_user=:id_user, id_purchase=:id_purchase, date_expense = NOW(), price=:price");	
		$sql->bindValue(":id_company",$id_company);
		$sql->bindValue(":name_desc",$name_desc);
		$sql->bindValue(":id_user",$id_user);
		$sql->bindValue(":id_purchase",$id_purchase);
		$sql->bindValue(":price", $price);
		$sql->execute();

	}
	public function add( $id_company, $id_user, $name_desc,  $price ){
		$id_purchase='';
		$sql = $this->db->prepare("INSERT INTO expenses SET id_company=:id_company, name_desc=:name_desc ,id_user=:id_user, id_purchase=:id_purchase, date_expense = NOW(), price=:price");	
		$sql->bindValue(":id_company",$id_company);
		$sql->bindValue(":name_desc",$name_desc);
		$sql->bindValue(":id_user",$id_user);
		$sql->bindValue(":id_purchase",$id_purchase);
		$sql->bindValue(":price", $price);
		$sql->execute();

	}

	public function getTotalExpenses($period1, $period2, $id_company) {
		$float = 0;

		$sql = "SELECT SUM(price) as total FROM expenses WHERE id_company = :id_company AND date_expense BETWEEN :period1 AND :period2";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_company', $id_company);
		$sql->bindValue(':period1', $period1);
		$sql->bindValue(':period2', $period2);
		$sql->execute();

		$n = $sql->fetch();
		$float = $n['total'];

		return $float;
	}
	public function getExpensesList($period1, $period2, $id_company) {
		$array = array();
		$currentDay = $period1;
		while($period2 != $currentDay) {
			$array[$currentDay] = 0;
			$currentDay = date('Y-m-d', strtotime('+1 day', strtotime($currentDay)));
		}

		$sql = "SELECT DATE_FORMAT(date_expense, '%Y-%m-%d') as date_expense, SUM(price) as total FROM expenses WHERE id_company = :id_company AND date_expense BETWEEN :period1 AND :period2 GROUP BY DATE_FORMAT(date_expense, '%Y-%m-%d')";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_company', $id_company);
		$sql->bindValue(':period1', $period1);
		$sql->bindValue(':period2', $period2);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$rows = $sql->fetchAll();

			foreach($rows as $sale_item) {
				$array[$sale_item['date_expense']] = $sale_item['total'];
			}
		}


		return $array;
	}

	

}