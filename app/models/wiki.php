<?php
class Wiki {
    
        private $db;
      
        public function __construct()
        {
            $this->db = new Database;

}

public function add_wiki($data){
    $this->db->query('INSERT INTO wikis (wiki_picture,title, content,user_id,category_id) VALUES (:wiki_picture,:title,:content,:user_id,:category_id)');
    $this->db->bind(':wiki_picture', $data['wiki_picture']);
    $this->db->bind(':title', $data['titre']);
    $this->db->bind(':content', $data['description']);
    $this->db->bind(':user_id', $_SESSION['user_id']);
    $this->db->bind(':category_id',$data['category_id']);



    if ($this->db->execute()) {
        // Get the last inserted ID
        $lastInsertId = $this->db->lastInsertId();
        return $lastInsertId;
    } else {
        return false;
    }
}
public function get_wikis(){
    try {
        $this->db->query(" SELECT * FROM wikis WHERE   archiver =:archiver");
        $this->db->bind(':archiver', 1 );
        $this->db->execute();
        return  $this->db->resultSet();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
      
}



public function get_this_wikis($id_wiki){
 
    $this->db->query(" SELECT * FROM wikis WHERE wiki_id=:wiki_id");
    $this->db->bind(':wiki_id', $id_wiki );
    $this->db->execute();
    return  $this->db->single();
  
}
public function delete_wiki($id_wiki){
    try {
    $this->db->query(" DELETE FROM wikis WHERE wiki_id=:wiki_id");
    $this->db->bind(':wiki_id', $id_wiki );
    $this->db->execute();
    return  $this->db->execute();;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
  
}


public function archiver_wiki($id_wiki){
    try {
        $this->db->query("UPDATE wikis   SET archiver = 0   where wiki_id= :wiki_id");
        $this->db->bind(':wiki_id', $id_wiki );
        $this->db->execute();
       
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
public function found_wiki($input){

    try{
        $this->db->query("SELECT  categories.name AS category, GROUP_CONCAT(tags.name) AS tags ,wikis.*
        FROM wikis
        LEFT JOIN categories ON wikis.category_id = categories.category_id
        LEFT JOIN wiki_tags ON wikis.wiki_id = wiki_tags.wiki_id
        LEFT JOIN tags ON wiki_tags.tag_id = tags.tag_id
        WHERE (wikis.title LIKE '%{$input}%' OR categories.name LIKE '%{$input}%' OR tags.name LIKE '%{$input}%' ) and wikis.archiver = 1
        GROUP BY wikis.wiki_id
        ");
        $this->db->execute();
        return $this->db->resultSet();
    }catch(PDOException $e){
        return $e->getMessage();

    }

}
public function update_wiki($id_wiki,$data){
    try {
        
        $this->db->query('UPDATE wikis SET wiki_picture = :wiki_picture, title = :title, content = :content, category_id = :category_id WHERE wiki_id = :wiki_id');
        $this->db->bind(':wiki_picture', $data['wiki_picture']);
        $this->db->bind(':title', $data['titre']);
        $this->db->bind(':content', $data['message']);
        $this->db->bind(':category_id', $data['categorie']);
        $this->db->bind(':wiki_id', $id_wiki); // Assuming $data['wiki_id'] contains the ID of the wiki you want to update
        
        // Execute
        $this->db->execute();
        return true;
        
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

}