<?php
class Tag
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  public function fetch_tags(){
    $this->db->query(" SELECT * FROM tags");
    $this->db->execute();
    return  $this->db->resultSet();
  }
  public function add_wiki_tags($id,$tags){

    foreach ($tags as $tag) {
     
      $this->db->query( "INSERT INTO wiki_tags (wiki_id,tag_id) VALUES (:wiki_id,:tag_id)");
      $this->db->bind(':wiki_id',$id);
      $this->db->bind(':tag_id',$tag);
      $this->db->execute();
  }
  echo "Record inserted successfully ";

}
public function get_tags_wiki($id_wiki){
  $this->db->query( "SELECT * FROM tags join wiki_tags on wiki_tags.tag_id = tags.tag_id WHERE wiki_tags.wiki_id=:wiki_id ");
      $this->db->bind(':wiki_id',$id_wiki);
      
      return $this->db->resultSet();
}

public function addTag($data){
  $this->db->query( "INSERT INTO tags (name) VALUES (:name)");
      $this->db->bind(':name',$data['tag_name']);
    
      return   $this->db->execute();
}
public function delete_tag($id){
 
  try {
    $this->db->query('DELETE FROM tags WHERE tag_id = :tag_id');
    $this->db->bind(':tag_id',$id);
    //Execute
    return $this->db->execute();
} catch (PDOException $e) {
    return $e->getMessage();
}
}
public function gettag($id){
  try{
    $this->db->query('SELECT * FROM tags WHERE tag_id = :tag_id');
    $this->db->bind(':tag_id',$id);
  
    return $this->db->single();
  }catch(PDOException $e){
    echo $e->getMessage();
  }
}
public function updateTag($data){
  
  try{
    $this->db->query('UPDATE  tags SET name =:tag_name  WHERE tag_id=:tag_id');
   
    $this->db->bind(':tag_id',$data['tag_id']);
    $this->db->bind(':tag_name',$data['tag_name']);
  
  
    return $this->db->execute();
  }catch(PDOException $e){
    echo $e->getMessage();
  }
}
public function delete_tags($id_wiki){
  try{
    $this->db->query('DELETE  FROM wiki_tags WHERE wiki_id  = :wiki_id');
    $this->db->bind(':wiki_id',$id_wiki);
   if( $this->db->execute()){
    return true;
   }else{
    return false;
   }
  
  }catch(PDOException $e){
    echo $e->getMessage();
  }

}


}