<?php
class Purchases extends Model{
	public function getList($offset, $id_company){
		$array = array();
		$sql = $this->db->prepare("
			SELECT 
				purchases.id,
				purchases.date_purchase,
				purchases.total_price,
				purchases.status,
				providers.name
			FROM purchases
			LEFT JOIN providers ON providers.id = purchases.id_provider 
			WHERE 
				purchases.id_company=:id_company 
			ORDER BY purchases.date_purchase DESC  
			LIMIT $offset, 10");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
		
		if($sql->rowCount()>0){
			$array = $sql->fetchAll();
		}

		
		return $array;
	}

	public function getInfo($id, $id_company){
		$array = array();

		$sql = $this->db->prepare("
			SELECT 
				*, (select providers.name from providers where providers.id = purchases.id_provider) as provider_name
			FROM purchases
			WHERE 
				id=:id AND 
				id_company=:id_company");
		$sql->bindValue(":id",$id);
		$sql->bindValue(":id_company",$id_company);
		$sql->execute();
		
		if($sql->rowCount()>0){
			$array['info'] = $sql->fetch();
		}

		$sql = $this->db->prepare("SELECT * FROM purchases_products WHERE id_purchase = :id_purchase AND id_company = :id_company");
		$sql->bindValue(":id_purchase", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array['products'] = $sql->fetchAll();
		}
		

		return $array;
	}

	public function changeStatus($status, $id, $id_company) {

		$sql = $this->db->prepare("UPDATE purchases SET status = :status WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":status", $status);
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if($status == 1 ){
			$i = new Inventory();
			$array = array();
			$sql = $this->db->prepare("SELECT * FROM purchases_products WHERE id_purchase = :id_purchase AND id_company = :id_company");
			$sql->bindValue(":id_purchase", $id);
			$sql->bindValue(":id_company", $id_company);
			$sql->execute();

			$array = $sql->fetch();

			$name = $array['name'];
			$price = $array['price'];
			$quant = $array['quant'];

			$sql = $this->db->prepare("SELECT id_user FROM purchases WHERE id = :id AND id_company = :id_company");
			$sql->bindValue(":id", $id);
			$sql->bindValue(":id_company", $id_company);
			$sql->execute();

			$array['id_user'] = $sql->fetch();

			$id_user = $array['id_user'];

			$i->enterProduct($id_company, $id_user, $name, $price, $quant  );
		}

	}

	
	public function addPurchases($id_company, $id_provider, $id_user, $name, $quant, $status, $price ){
		$e = new Expenses();
		$i = new Inventory();

		$total_price = $price*$quant;

		$sql = $this->db->prepare("INSERT INTO purchases SET id_company=:id_company, id_provider=:id_provider, id_user=:id_user, date_purchase = NOW(), total_price=:total_price, status=:status ");	
		$sql->bindValue(":id_company",$id_company);
		$sql->bindValue(":id_provider",$id_provider);
		$sql->bindValue(":id_user",$id_user);
		$sql->bindValue(":total_price", $total_price);
		$sql->bindValue(":status",$status);
		$sql->execute();

		$id_purchase = $this->db->lastInsertId();
		
		$sqlp = $this->db->prepare("INSERT INTO purchases_products SET id_company=:id_company , id_purchase=:id_purchase, name=:name, quant=:quant, price=:price");
		$sqlp->bindValue(":id_company",$id_company);
		$sqlp->bindValue(":id_purchase",$id_purchase);
		$sqlp->bindValue(":name",$name);
		$sqlp->bindValue(":quant",$quant);
		$sqlp->bindValue(":price",$price);
		$sqlp->execute();


		$e->addExpenses( $id_company, $id_provider, $id_user, $id_purchase, $total_price );

		if($status == 1 ){
			
			$i->enterProduct($id_company, $id_user,  $name, $price, $quant  );

		}
 
		


	}

	public function getProds($id_purchase, $id_company){
		$array = array();
		$sql = $this->db->prepare("SELECT * FROM purchases_products WHERE id_purchase = :id_purchase AND id_company = :id_company");
		$sql->bindValue(":id_purchase", $id_purchase);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if($sql->rowCount()>0){
			$array=$sql->fetch();
		}

		return $array;
	}
}

?>	