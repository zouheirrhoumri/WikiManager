<?php

class Tags extends Controller
{
    private $tagmodel;

    public function __construct()
    {
        $this->tagmodel = $this->model('tag');
    }
    public function index()
    {
        // get Projects

        $tags = $this->tagmodel->fetch_tags();

        $data = [
            'tags' => $tags
        ];

        $this->view('tags/index', $data);
    }
    public function addTag(){

    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            // var_dump($_POST);
            // die();
            $data = [
                'tags'=>$this->tagmodel->fetch_tags(),
                'tag_name' => trim($_POST['tagName']),
                'tag_id'=>'',
                'tag_name_error' => ''

            ];
            //Validate project_name
            if (empty($data['tag_name'])) {
                $data['tag_name_error'] = 'Please entre Categorie name';
            }

            //Make sure no errors
            if (empty($data['tag_name_error'])) {
               
             
                if ($this->tagmodel->addTag($data)) {
                  
                    redirect('tags/index');
                    # code...
                } else {
                    die('Something went wrong ');
                }
            } else {
               
                $this->view('tags/index', $data);
            }

        } else {
            $data = [
                'categorie_name' => '',

            ];
            $this->view('categories/index', $data);
        }

    }
    public function delete_tag($id)
    {
        if ($this->tagmodel->delete_tag($id)) {
           
            redirect('tags/index');
        } else {
            die('Something went wrong');
        }
    }
    public function update_tag($id){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $data = [
                'tag_id' => $id,
                'tag_name' => trim($_POST['tagName']),
                'tag_name_error' => ''
            ];

            // Validate category_name
            if (empty($data['tag_name'])) {
                $data['tag_name_error'] = 'Please enter Category name';
            }


            // Make sure no errors
            if (empty($data['tag_name_error'])) {
                // Validated
               
                if ($this->tagmodel->updateTag($data)) {
                    
                    redirect('tags/index');
                } else {
                    die('Something went wrong');
                }
            } else {
              
            //  var_dump($data);
            //  die();   
                $this->view('tags/update_tag', $data);
            }

        } else {
            // Get existing category from model
            
            $tag = $this->tagmodel->gettag($id);
            // Check for owner
            // var_dump($category);
            // die();
          
            $data = [
                'tag_id' =>$id,
                'tag_name' => $tag->name,
                'tag_name_error'=>''
            ];

            // Pass additional parameter for modal
            // $data['modal'] = true;

            $this->view('tags/update_tag', $data);
        }
    }
}