<?php

  class Pages extends Controller {
    private $wikis;
    private $user;
    private $category;
    private $tags;

    public function __construct(){
     $this->wikis=$this->model('wiki');
     $this->user=$this->model('user');
     $this->category=$this->model('categorie');
     $this->tags=$this->model('tag');
    }
    
    public function index(){
       $wiki= $this->wikis->get_wikis();
    
      $data = [
        'wikis'=>$wiki,
         'categories'=>$this->category->lastCategorys()
    
      ];
     
      $this->view('pages/index', $data);
      
    }



    public function read_more($id_wiki){
      $wiki=$this->wikis->get_this_wikis($id_wiki);
      $user=$this->user->findUserByid($wiki->user_id);
      $category=$this->category->get__this_category($wiki->category_id);
      $tags=$this->tags-> get_tags_wiki($id_wiki);
     
      $data=[
        'wiki'=>$wiki,
        'user'=>$user,
        'category'=>$category,
        'tags'=>$tags,
      ];
  

     $this->view('pages/wiki_details', $data);
    }

    public function indextest(){
      $wiki= $this->wikis->get_wikis();
      $data = [
        'wikis'=>$wiki,
        'categories'=>$this->category->lastCategorys()
    
      ];
      $this->view('pages/indextest' , $data);
    }
    
  }