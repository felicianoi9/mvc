<?php
class Inventory extends Model{

	public function getList($offset, $id_company){ 
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM inventory WHERE id_company = :id_company LIMIT $offset, 8");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getInfo($id, $id_company) {
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM inventory WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function getCount($id_company) {
		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) as c FROM inventory WHERE id_company = :id_company");
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['c'];

		return $r;
	}

	public function setLog($id_product, $id_company, $id_user, $action) {
		$sql = $this->db->prepare("INSERT INTO inventory_history SET id_company = :id_company, id_product = :id_product, id_user = :id_user, action = :action, date_action = NOW()");
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":id_product", $id_product);
		$sql->bindValue(":id_user", $id_user);
		$sql->bindValue(":action", $action);
		$sql->execute();
	}

	public function add($name, $price, $quant, $min_quant, $id_company, $id_user) {
		
		$sql = $this->db->prepare("INSERT INTO inventory SET name = :name, id_user=:id_user, purchase_price = :purchase_price, quant = :quant, min_quant = :min_quant, id_company = :id_company");
		$sql->bindValue(":name", $name);
		$sql->bindValue(":id_user", $id_user);
		$sql->bindValue(":purchase_price", $price);
		$sql->bindValue(":quant", $quant);
		$sql->bindValue(":min_quant", $min_quant);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		$id_product = $this->db->lastInsertId();
		$this->setLog($id_product, $id_company, $id_user, 'add');
	}

	public function edit($id, $name, $price, $quant, $min_quant, $id_company, $id_user) {

		$sql = $this->db->prepare("UPDATE inventory SET name = :name, price = :price, quant = :quant, min_quant = :min_quant WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":name", $name);
		$sql->bindValue(":price", $price);
		$sql->bindValue(":quant", $quant);
		$sql->bindValue(":min_quant", $min_quant);
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":id", $id);
		$sql->execute();

		$this->setLog($id, $id_company, $id_user, 'edt');
	}

	public function delete($id, $id_company, $id_user) {
		$sql = $this->db->prepare("DELETE FROM inventory WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		$this->setLog($id, $id_company, $id_user, 'del');
	}

	public function searchProductsByName($name, $id_company ){
		$array = array();
		$sql = $this->db->prepare("SELECT name, price, id FROM inventory WHERE name LIKE :name AND id_company=:id_company  LIMIT 10");
		$sql->bindValue(':name','%'.$name.'%');
		$sql->bindValue("id_company",$id_company);
		$sql->execute();

		if($sql->rowCount()>0){
			$array = $sql->fetchAll();
		}
		return $array;
	}

	public function decrease($id_prod, $id_company, $quant_prod, $id_user) {
		$sql = $this->db->prepare("UPDATE inventory SET quant = quant - $quant_prod WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id_prod);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		$this->setLog($id_prod, $id_company, $id_user, 'dwn');
	}
	
	public function increase($id_prod, $id_company, $quant_prod, $id_user) {
		$sql = $this->db->prepare("UPDATE inventory SET quant = quant + $quant_prod WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id_prod);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		$this->setLog($id_prod, $id_company, $id_user, 'add');
	}

	public function enterProduct($id_company, $id_user, $name, $price, $quant  ){
		$sql = $this->db->prepare("INSERT INTO inventory SET  id_company=:id_company, name=:name, purchase_price=:purchase_price, quant=:quant , min_quant=1");
		$sql->bindValue(":id_company",$id_company);
		$sql->bindValue(":name",$name);
		$sql->bindValue(":purchase_price",$price);
		$sql->bindValue(":quant",$quant);
		$sql->execute();
		$id_prod = $this->db->lastInsertId();
		$this->setLog($id_prod, $id_company, $id_user, 'add');

	}
}
