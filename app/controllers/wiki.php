<?php
class Wikis extends controller{
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
    
 
    
    public function formWiki(){
        
      if(isset($_SESSION['user_role'])){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
          
            $data = [

                'wiki_picture' => trim($_POST['wiki_picture']),
                'category_id'=>trim($_POST['categorie']),
                'titre' => trim($_POST['titre']),
                'description' => trim($_POST['message']),
                'wiki_picture_err' => '',
                'titre_err' => '',
                'description_err' => ''
            ];

         
          
            $id_wiki=$this->wikis->add_wiki($data);
            
            if($id_wiki){
                
                $selectedTagsString = $_POST['selected_tag_id'];

                // Decode the JSON string to an array
                $selectedTagsArray = json_decode($selectedTagsString, true);
          
                $this->tags->add_wiki_tags($id_wiki,$selectedTagsArray);
                
                redirect('pages/index');
            }
        }
        else{
        $data = [
            'categories'=> $this->category->fetch_categories(),
            'tags'=>$this->tags->fetch_tags(),
            'selected_tags'=>'',
            'wiki_picture' => '',
            'titre' => '',
            'description' => '',
            'wiki_picture_err' => '',
            'titre_err' => '',
            'description_err' => ''
        ];
     
        $this->view('pages/form-wiki',$data);
    }}else{
      redirect("users/login");
    }
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
      public function archiver_wiki($id_wiki){
        $this->wikis->archiver_wiki($id_wiki);
        redirect('pages/index');
      }
      public function update_wiki($id_wiki){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          
          
            if( $this->wikis->update_wiki($id_wiki,$_POST)) {
             
          if( $this->tags->delete_tags($id_wiki)){
           $selectedTagsString = $_POST['selected_tag_id'];
           $selectedTagsArray = json_decode($selectedTagsString, true);
           $this->tags->add_wiki_tags($id_wiki,$selectedTagsArray);
           redirect('pages/index');
          }}
        }else{
        $wiki=$this->wikis->get_this_wikis($id_wiki);
        $user=$this->user->findUserByid($wiki->user_id);
        $category=$this->category->get__this_category($wiki->category_id);
        $tags=$this->tags-> get_tags_wiki($id_wiki);
        
        $data=[
          'wiki'=>$wiki,
          'user'=>$user,
          'mycategory'=>$category,
          'mytags'=>$tags,
          'categories'=>$this->category->fetch_categories(),
          'tags'=>$this->tags->fetch_tags(),
        ];
      // var_dump($category);die();
        $this->view('pages/update_wiki',$data);
      }}


      public function search_wiki(){
        if (isset($_POST['input'])) {
            $input = $_POST['input'];
            
            $wikis = $this->wikis->found_wiki($input);
   
            foreach($wikis as $wiki) {
                echo '
                    <section id="wikis" class="text-blueGray-700 bg-white ">
                        <div class="container flex flex-col items-center px-5 py-16 mx-auto md:flex-row md:justify-around ">
                            <div class="w-full lg:w-1/3 lg:max-w-lg md:w-1/2">
                                <img class="object-cover object-center rounded-lg " alt="hero" src="' . URLROOT . '/img/' . $wiki->wiki_picture . '">
                            </div>
                            <div class="flex flex-col items-start mb-16 text-left  md:w-1/3  ">
                                <h1 class="mb-8 text-2xl font-black tracking-tighter text-black md:text-5xl title-font">' . $wiki->title . '</h1>
                                <p class="mb-8 text-base leading-relaxed text-left text-blueGray-600 max-h-[25vh] overflow-y-hidden ">' . $wiki->content . '</p>
                                <div class="flex flex-col justify-center lg:flex-row">
                                    <a href="' . URLROOT . '/wikis/read_more/' . $wiki->wiki_id . '" class="flex items-center px-6 py-2 mt-auto font-semibold text-white transition duration-500 ease-in-out transform bg-blue-600 rounded-lg hover:bg-blue-700 focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2"> Show me </a>
                                    <p class="mt-2 text-sm text-left text-blueGray-600 md:ml-6 md:mt-0"> It will take you to read more <br class="hidden lg:block">
                                        <a href="' . URLROOT . '/wikis/read_more/' . $wiki->wiki_id . '" class="inline-flex items-center font-semibold text-blue-600 md:mb-2 lg:mb-0 hover:text-black " title="read more"> Read more about it » </a>
                                    </p>
                                </div>
                                <div class="flex w-full mt-16  justify-around ">
                                    <a href="' . URLROOT . '/wikis/archiver_wiki/' . $wiki->wiki_id . '" class="p-2 bg-red-400  rounded cursor-pointer "><i class="fa-solid fa-box-archive "> ARCHIVER</i></a>
                                    <a href="' . URLROOT . '/wikis/update_wiki/' . $wiki->wiki_id . '" class="p-2 bg-green-400 rounded cursor-pointer "><i class="fa-regular fa-pen-to-square "> UPDATE</i></a>
                                </div>
                            </div>
                        </div>
                    </section>
                ';
    
              
            }
        }
    }
    
}