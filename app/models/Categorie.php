<?php
class Categorie
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function fetch_categories()
    {
        $this->db->query('SELECT * FROM categories');
        $this->db->execute();
        return $this->db->resultSet();
    }
    // retreive a single category
    public function get_this_category($id_categ)
    {
        $this->db->query('SELECT * FROM categories WHERE categoryid=:categoryid');
        $this->db->bind(':categoryid', $id_categ);

        return  $this->db->single();
    }
    
    public function getcategotrybyid(){
        $this->db->query("SELECT * From wikimanager.categories ");
        return $this->db->resultSet();
    }

    
}
