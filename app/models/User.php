<?php
class User
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  //************ register user *************
  public function register($data)
  {

    $this->db->query('INSERT INTO users (prenom, nom, telephone, email, motdepasse, roleuser) VALUES (:prenom,:nom,:telephone,:email,:motdepasse,:roleuser)');
    $this->db->bind(':prenom', $data['name']);
    $this->db->bind(':nom', $data['userlastname']);
    $this->db->bind(':telephone', $data['phoneNumber']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':motdepasse', $data['password']);
    $this->db->bind(':roleuser', $data['roleuser']);
  

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
 
  public function login($email, $password)
  {
    $this->db->query("SELECT * FROM users WHERE email = '$email' ");

    $row = $this->db->single();
    $hashed_password = $row->motdepasse;
    if (password_verify($password, $hashed_password)) {
      return $row;
    } else {
      return false;
    }
  }

  
  public function findUserByEmail($email)
  {
    $this->db->query("SELECT * FROM users WHERE email = '$email' ");


    $row = $this->db->single();

    // Check row
    if ($this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }
  public function findUserByid($user_id)
  {
   
    $this->db->query("SELECT * FROM users WHERE user_id = :user_id ");
    $this->db->bind(':user_id', $user_id);

    $row = $this->db->single();

    // Check row
    if ($this->db->rowCount() > 0) {
      return $row;
    } else {
      return false;
    }
  }

  public function search($search)
    {

        $searchparam = filter_var($search , FILTER_SANITIZE_SPECIAL_CHARS);
        $query = "SELECT wikis.*, categories.name AS category, GROUP_CONCAT(tags.name) AS tags
            FROM wikis
            LEFT JOIN categories ON wikis.category_id = categories.category_id
            LEFT JOIN wiki_tags ON wikis.wiki_id = wiki_tags.wiki_id
            LEFT JOIN tags ON wiki_tags.tag_id = tags.tag_id
            WHERE (wikis.title LIKE :search OR categories.name LIKE :search OR tags.name LIKE :search)
            AND wikis.archiver = 1 ";
        $query .= " GROUP BY wikis.wiki_id";
        $this->db->query($query);
        $this->db->bind(':search', "%$searchparam%");
        $data = $this->db->resultSet();
        if($data){
          return  $data ;

        }
    }
}
