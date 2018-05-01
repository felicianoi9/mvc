<?php
class Providers extends Model{
	
	

	public function getList($offset, $id_company){
		$array = array();

		

		$sql = $this->db->prepare("SELECT * FROM providers WHERE id_company=:id_company LIMIT $offset, 8");
		$sql->bindValue(":id_company",$id_company);
		$sql->execute();

		if($sql->rowCount()>0){
			$array = $sql->fetchAll();
		}

		return $array;

	}

	public function getInfo($id, $id_company){
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM providers WHERE id=:id AND id_company=:id_company");
		$sql->bindValue(':id',$id);
		$sql->bindValue(':id_company',$id_company);
		$sql->execute();

		if($sql->rowCount()>0){
			$array = $sql->fetch();
		}

		return $array;
	}

	public function getName($id, $id_company){
		$array =array();
		$sql = $this->db->prepare("SELECT name FROM providers WHERE id=:id AND id_company=:id_company");
		$sql->bindValue(':id',$id);
		$sql->bindValue(':id_company',$id_company);
		$sql->execute();

		if($sql->rowCount()>0){
			$array = $sql->fetch();
		}
		array_shift($array);
		$name=implode("",$array);
		
		return $name;
	}

	public function getCount($id_company) {
		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) as c FROM providers WHERE id_company = :id_company");
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['c'];

		return $r;
	}

	public function add($id_company, $name, $email ='', $phone='', $stars='', $internal_obs='', $address_zipcode='', $address='', $address_number='', $address2='', $address_neighb='', $address_city='', $address_state='', $address_country='' ){
		

		$sql = $this->db->prepare("INSERT INTO providers SET id_company=:id_company, name=:name , email=:email, phone=:phone, stars=:stars, internal_obs=:internal_obs, address_zipcode=:address_zipcode, address=:address, address_number=:address_number, address_2=:address_2, address_neighb=:address_neighb, address_city=:address_city, address_state=:address_state, address_country=:address_country ");

		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":name", $name);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":phone", $phone);
		$sql->bindValue(":stars", $stars);
		$sql->bindValue(":internal_obs", $internal_obs);
		$sql->bindValue(":address_zipcode", $address_zipcode);
		$sql->bindValue(":address", $address);
		$sql->bindValue(":address_number", $address_number);
		$sql->bindValue(":address_2", $address2);
		$sql->bindValue(":address_neighb", $address_neighb);
		$sql->bindValue(":address_city", $address_city);
		$sql->bindValue(":address_state", $address_state);
		$sql->bindValue(":address_country", $address_country);
		$sql->execute();

		
		
		return $this->db->lastInsertId();
		

	} 

	public function del($id, $id_company) {
		$sql = $this->db->prepare("DELETE FROM providers WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

	}	

	public function edit($id, $id_company, $name, $email, $phone, $stars, $internal_obs, $address_zipcode, $address, $address_number, $address2, $address_neighb, $address_city, $address_state, $address_country ){
		$sql = $this->db->prepare("UPDATE providers SET name=:name , email=:email, phone=:phone, stars=:stars, internal_obs=:internal_obs, address_zipcode=:address_zipcode, address=:address, address_number=:address_number, address_2=:address_2, address_neighb=:address_neighb, address_city=:address_city, address_state=:address_state, address_country=:address_country WHERE id=:id AND id_company=:id_company ");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":name", $name);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":phone", $phone);
		$sql->bindValue(":stars", $stars);
		$sql->bindValue(":internal_obs", $internal_obs);
		$sql->bindValue(":address_zipcode", $address_zipcode);
		$sql->bindValue(":address", $address);
		$sql->bindValue(":address_number", $address_number);
		$sql->bindValue(":address_2", $address2);
		$sql->bindValue(":address_neighb", $address_neighb);
		$sql->bindValue(":address_city", $address_city);
		$sql->bindValue(":address_state", $address_state);
		$sql->bindValue(":address_country", $address_country);
		$sql->execute();	
		

		

	} 
	public function searchClientByName($name, $id_company){
		$array = array();
		$sql = $this->db->prepare("SELECT name, id FROM providers WHERE name LIKE :name LIMIT 10");
		$sql->bindValue(':name','%'.$name.'%');
		$sql->execute();

		if($sql->rowCount()>0){
			$array = $sql->fetchAll();
		}
		return $array;
	}

	public function view($id){
        echo "Falta fazer!";
    }

	
}