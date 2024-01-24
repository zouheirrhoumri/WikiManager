<?php
class Wiki
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function add_wiki($data)
    {
        $this->db->query('INSERT INTO wikis (title, content,user_id,category_id) VALUES (:title,:content,:user_id,:category_id)');
        $this->db->bind(':title', $data['titre']);
        $this->db->bind(':content', $data['description']);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->bind(':category_id', $data['category_id']);



        if ($this->db->execute()) {
            // Get the last inserted ID
            $lastInsertId = $this->db->lastInsertId();
            return $lastInsertId;
        } else {
            return false;
        }
    }
    public function get_wikis()
    {
        try {
            $this->db->query(" SELECT *, tags.name
            FROM wikis
            INNER JOIN categories ON wikis.category_id = categories.category_id
            INNER JOIN users ON wikis.user_id = users.user_id
            INNER JOIN wiki_tags ON wikis.wiki_id = wiki_tags.wiki_id
            INNER JOIN tags ON wiki_tags.tag_id = tags.tag_id
            WHERE wikis.archiver = :archiver
        ");


            $this->db->bind(':archiver', 1);
            $this->db->execute();
            return  $this->db->resultSet();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }



    public function get_this_wikis($id_wiki)
    {

        $this->db->query(" SELECT * FROM wikis WHERE wiki_id=:wiki_id");
        $this->db->bind(':wiki_id', $id_wiki);
        $this->db->execute();
        return  $this->db->single();
    }
    public function delete_wiki($id_wiki)
    {

        try {
            $this->db->query(" DELETE FROM wikis WHERE wiki_id=:wiki_id");
            $this->db->bind(':wiki_id', $id_wiki);
            $this->db->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }


    public function archiver_wiki($id_wiki)
    {
        try {
            $this->db->query("UPDATE wikis   SET archiver = 0   where wiki_id= :wiki_id");
            $this->db->bind(':wiki_id', $id_wiki);
            $this->db->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function update_wiki($id_wiki, $data)
    {
        try {

            $this->db->query('UPDATE wikis SET title = :title, content = :content, category_id = :category_id WHERE wiki_id = :wiki_id');
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


    /**********************************************/
    public function getTotalWikis()
    {
        $this->db->query('SELECT COUNT(wiki_id) as totalWikis FROM wikis');
        return $this->db->single()->totalWikis;
    }

    public function getUserWithMostWikis()
    {
        $this->db->query('SELECT u.nom ,u.prenom , COUNT(w.user_id) as wikiCount
        FROM wikis w
        JOIN users u ON w.user_id = u.user_id
        GROUP BY w.user_id
        ORDER BY wikiCount DESC
        LIMIT 1;
    ');

        return $this->db->single();
    }

    public function getTotalTags()
    {
        $this->db->query('SELECT COUNT(tag_id) as totalTags FROM tags');
        return $this->db->single()->totalTags;
    }

    public function getTotalAuthors()
    {
        $this->db->query('SELECT COUNT( user_id) as totalAuthors FROM users');
        return $this->db->single()->totalAuthors;
    }

    public function getTotalCategories()
    {
        $this->db->query('SELECT COUNT(*) as totalCategories FROM categories');
        return $this->db->single()->totalCategories;
    }

    public function getMostUsedCategory()
    {
        $this->db->query('SELECT categories.name, COUNT( categories.name) as number_used
         from categories
          join wikis on wikis.category_id=categories.category_id 
          GROUP by categories.name
           ORDER by number_used DESC 
           LIMIT 1;
    ');
        return $this->db->single();
    }


    /*********************************************/
}
