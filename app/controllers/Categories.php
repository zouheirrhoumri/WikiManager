<?php

class Categories extends Controller
{
    private $categoriesmodel;

    public function __construct()
    {
        $this->categoriesmodel = $this->model('categorie');
    }
    public function index()
    {
        // get Projects

        $categories = $this->categoriesmodel->getCategories();

        $data = [
            'categories' => $categories
        ];

        $this->view('categories/index', $data);
    }
    public function add()
{
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        $data = [
            'categories' => $this->categoriesmodel->getCategories(),
            'categorie_name' => trim($_POST['categoryName']),
            'user_id' => $_SESSION['user_id'],
            'categorie_name_error' => ''
        ];

        // Validate category name
        if (empty($data['categorie_name'])) {
            $data['categorie_name_error'] = 'Please enter a category name';
        }
 $categorie=$this->categoriesmodel->checkIfExist(trim($_POST['categoryName']));

        if ($categorie->name_exists) {
            $data['categorie_name_error'] = 'Category already exists';
        }

        // Make sure no errors
        if (empty($data['categorie_name_error'])) {
            if ($this->categoriesmodel->addCategorie($data)) {
                echo json_encode(['success' => true]);
                exit;
            } else {
                echo json_encode(['error' => 'Something went wrong']);
                exit;
            }
        } else {
            // Return validation errors as JSON
            echo json_encode(['error' => $data['categorie_name_error']]);
            exit;
        }
    } else {
        // Handle non-POST requests as needed
        echo json_encode(['error' => 'Invalid request method']);
        exit;
    }
}


    public function update($id)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $data = [
                'CategoryID' => $id,
                'categorie_name' => trim($_POST['categoryName']),
                'categorie_name_error' => ''
            ];

            // Validate category_name
            if (empty($data['categorie_name'])) {
                $data['categorie_name_error'] = 'Please enter Category name';
            }


            // Make sure no errors
            if (empty($data['categorie_name_error'])) {
                // Validated
               
                if ($this->categoriesmodel->updateCategorie($data)) {
                    flash('categories_message', 'Category Modified');
                    redirect('categories/index');
                } else {
                    die('Something went wrong');
                }
            } else {
              
            //  var_dump($data);
            //  die();   
                $this->view('categories/updatecategorie', $data);
            }

        } else {           
            $category = $this->categoriesmodel->get__this_category($id); 
            $data = [
                'CategoryID' =>$id,
                'categorie_name' => $category->name,
                'categorie_name_error'=>''
            ];

            // Pass additional parameter for modal
            // $data['modal'] = true;

            $this->view('categories/updatecategorie', $data);
        }
    }
    public function delete($id)
    {
        if ($this->categoriesmodel->deleteCategory($id)) {
            flash('category_message', 'categorie Deleted');
            redirect('categories/index');
        } else {
            die('Something went wrong');
        }
    }
}