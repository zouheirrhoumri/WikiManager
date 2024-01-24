<?php
class Categorie
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function get__this_category($id_categ){
    $this->db->query(" SELECT * FROM categories WHERE category_id=:category_id");
    $this->db->bind(':category_id', $id_categ );
   
    return  $this->db->single();
  }
   public function lastCategorys(){
    try{
$this->db->query("SELECT * from categories order by date_categorie desc limit 6");
$this->db->execute();
return $this->db->resultSet();
    }catch(PDOException $e){
      return $e->getMessage();
    }
   }
/***************************************** */



public function getCategories(){
  $this->db->query('SELECT * FROM wiki.categories;');
  return $this->db->resultSet();
}
public function addCategorie($data){
  $this->db->query('INSERT INTO categories (name) VALUES(:categorie_name )');

  $this->db->bind(':categorie_name',$data['categorie_name']);

  return $this->db->execute();
}




public function updateCategorie($data){
  $this->db->query('UPDATE  categories SET name = :category_name, date_categorie = CURRENT_TIMESTAMP  WHERE Category_id = :categoryID');

  $this->db->bind(':categoryID',$data['CategoryID']);
  $this->db->bind(':category_name',$data['categorie_name']);

  return $this->db->execute();
}
public function deleteCategory($id){
  $this->db->query('DELETE FROM categories WHERE category_id = :categoryID');
  $this->db->bind(':categoryID',$id);
  
  return $this->db->execute();
}
public function checkIfexist($name){
try{
  $this->db->query(' SELECT COUNT(*) > 0 AS name_exists FROM categories WHERE name = :name');
  $this->db->bind(':name',$name);
  return $this->db->single();
}catch(PDOException $e){
 return $e->getMessage();
}
}

}