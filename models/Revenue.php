<?php
class Revenue extends Model{
	public function getList($offset, $id_company){
		$array = array();
		
		$sql = $this->db->prepare("SELECT * FROM revenue WHERE id_company=:id_company ORDER BY  date_revenue DESC LIMIT $offset, 8 ");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
		
		if($sql->rowCount()>0){
			$array = $sql->fetchAll();
		}
		
		return $array;
	}
	public function getCount($id_company) {
		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) as c FROM revenue WHERE id_company = :id_company");
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['c'];

		return $r;
	}

	public function addRevenue( $id_company, $id_client, $id_user, $id_sale='', $total_price ){
		
		$c = new Clients();
		$name= $c->getName($id_client, $id_company);
		$name_desc = "Venda para: ".$name;

		
		$sql = $this->db->prepare("INSERT INTO revenue SET id_company=:id_company, name_desc=:name_desc ,id_user=:id_user, id_sale=:id_sale, date_revenue = NOW(), total_price=:total_price");	
		$sql->bindValue(":id_company",$id_company);
		$sql->bindValue(":name_desc",$name_desc);
		$sql->bindValue(":id_user",$id_user);
		$sql->bindValue(":id_sale",$id_sale);
		$sql->bindValue(":total_price", $total_price);
		$sql->execute();

	}

	public function add( $id_company, $id_user, $name_desc,  $total_price ){
		$id_sale='';
		$sql = $this->db->prepare("INSERT INTO revenue SET id_company=:id_company, name_desc=:name_desc ,id_user=:id_user, id_sale=:id_sale, date_revenue = NOW(), total_price=:total_price");	
		
		$sql->bindValue(":id_company",$id_company);
		$sql->bindValue(":name_desc",$name_desc);
		$sql->bindValue(":id_user",$id_user);
		$sql->bindValue(":id_sale",$id_sale);
		$sql->bindValue(":total_price", $total_price);
		$sql->execute();

	}

	public function getInfoById($id, $id_company){
		$array = array();
		
		$sql = $this->db->prepare("SELECT * FROM revenue WHERE id_company=:id_company AND id=:id ");
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":id", $id);
		$sql->execute();
		
		if($sql->rowCount()>0){
			$array['info'] = $sql->fetch();
		}



		if($array['info']['id_sale']>0){

			$id_sale = $array['info']['id_sale'];
			$s= new Sales();

			$array['products']=$s->getProds($id_sale, $id_company);

		}else{
			$array['products']='';
		}
		
		
		return $array;
	}

	public function getTotalRevenue($period1, $period2, $id_company) {
		$float = 0;

		$sql = "SELECT SUM(total_price) as total FROM revenue WHERE id_company = :id_company AND date_revenue BETWEEN :period1 AND :period2";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_company', $id_company);
		$sql->bindValue(':period1', $period1);
		$sql->bindValue(':period2', $period2);
		$sql->execute();

		$n = $sql->fetch();
		$float = $n['total'];

		return $float;
	}

	public function getRevenueList($period1, $period2, $id_company) {
		$array = array();
		$currentDay = $period1;
		while($period2 != $currentDay) {
			$array[$currentDay] = 0;
			$currentDay = date('Y-m-d', strtotime('+1 day', strtotime($currentDay)));
		}

		$sql = "SELECT DATE_FORMAT(date_revenue, '%Y-%m-%d') as date_revenue, SUM(total_price) as total FROM revenue WHERE id_company = :id_company AND date_revenue BETWEEN :period1 AND :period2 GROUP BY DATE_FORMAT(date_revenue, '%Y-%m-%d')";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_company', $id_company);
		$sql->bindValue(':period1', $period1);
		$sql->bindValue(':period2', $period2);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$rows = $sql->fetchAll();

			foreach($rows as $sale_item) {
				$array[$sale_item['date_revenue']] = $sale_item['total'];
			}
		}


		return $array;
	}
}	