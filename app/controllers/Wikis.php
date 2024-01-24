<?php
class Wikis extends controller
{
  private $wikis;
  private $user;
  private $category;
  private $tags;

  public function __construct()
  {
    $this->wikis = $this->model('wiki');
    $this->user = $this->model('user');
    $this->category = $this->model('categorie');
    $this->tags = $this->model('tag');
  }


  public function formWiki()
  {
    if (isset($_SESSION['user_role'])) {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $data = [
          'categories' => $this->category->getCategories(),
          'tags' => $this->tags->fetch_tags(),
          'category_id' => trim($_POST['categorie']),
          'titre' => trim($_POST['titre']),
          'description' => trim($_POST['message']),
          'selected_tag_id' =>  $_POST['selected_tag_id'],
          'titre_err' => '',
          'tags_err' => '',
          'category_err' => '',
          'description_err' => ''
        ];

        // Validate category
        if (empty($data['category_id'])) {
          $data['category_err'] = 'Please select a category';
        }

        // Validate title
        if (empty($data['titre'])) {
          $data['titre_err'] = 'Please enter a title';
        }

        // Validate description
        if (empty($data['description'])) {
          $data['description_err'] = 'Please enter a description';
        }
        if (empty($data['selected_tag_id'])) {
          $data['tags_err'] = 'Please choose tags';
        }

        // Check if there are no validation errors
        if (empty($data['tags_err']) && empty($data['category_err']) && empty($data['titre_err']) && empty($data['description_err'])) {

          $id_wiki = $this->wikis->add_wiki($data);

          if ($id_wiki) {

            $selectedTagsArray = json_decode($data['selected_tag_id'], true);

            $this->tags->add_wiki_tags($id_wiki, $selectedTagsArray);

            redirect('pages/index');
          }
        } else {


          $this->view('pages/form-wiki', $data);
        }
      } else {
        // Load the view without any form data if it's a GET request
        $data = [
          'categories' => $this->category->getCategories(),
          'tags' => $this->tags->fetch_tags(),
          'category_id'=>'',
          'selected_tag_id' => '',
          'titre' => '',
          'tags_err' => '',
          'description' => '',
          'wiki_picture_err' => '',
          'category_err' => '',
          'titre_err' => '',
          'description_err' => ''
        ];

        $this->view('pages/form-wiki', $data);
      }
    } else {
      redirect("users/register");
    }
  }

  public function read_more($id_wiki)
  {

    $wiki = $this->wikis->get_this_wikis($id_wiki);
    $user = $this->user->findUserByid($wiki->user_id);
    $category = $this->category->get__this_category($wiki->category_id);
    $tags = $this->tags->get_tags_wiki($id_wiki);

    $data = [
      'wiki' => $wiki,
      'user' => $user,
      'category' => $category,
      'tags' => $tags,
    ];


    $this->view('pages/wiki_details', $data);
  }
  public function archiver_wiki($id_wiki)
  {
    $this->wikis->archiver_wiki($id_wiki);
    redirect('pages/index');
  }
  public function update_wiki($id_wiki)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


      if ($this->wikis->update_wiki($id_wiki, $_POST)) {

        if ($this->tags->delete_tags($id_wiki)) {
          $selectedTagsString = $_POST['selected_tag_id'];
          $selectedTagsArray = json_decode($selectedTagsString, true);
          $this->tags->add_wiki_tags($id_wiki, $selectedTagsArray);
          redirect('pages/index');
        }
      }
    } else {
      $wiki = $this->wikis->get_this_wikis($id_wiki);
      $user = $this->user->findUserByid($wiki->user_id);
      $category = $this->category->get__this_category($wiki->category_id);
      $tags = $this->tags->get_tags_wiki($id_wiki);

      $data = [
        'wiki' => $wiki,
        'user' => $user,
        'mycategory' => $category,
        'mytags' => $tags,
        'categories' => $this->category->getCategories(),
        'tags' => $this->tags->fetch_tags(),
      ];
      $this->view('pages/update_wiki', $data);
    }
  }
  public function delete_wiki($id_wiki)
  {
    $this->wikis->delete_wiki($id_wiki);
    redirect('pages/index');
  }




  public function stats()
  {

    $totalWikis = $this->wikis->getTotalWikis();


    $UserWithMostWikis = $this->wikis->getUserWithMostWikis();

    $totalTags = $this->wikis->getTotalTags();
    $totalAuthors = $this->wikis->getTotalAuthors();
    $totalCategories = $this->wikis->getTotalCategories();
    $mostUsedCategory = $this->wikis->getMostUsedCategory();

    $data = [
      'totalWikis' => $totalWikis,
      'UserWithMostWikis' => $UserWithMostWikis,
      'totalTags' => $totalTags,
      'totalAuthors' => $totalAuthors,
      'totalCategories' => $totalCategories,
      'mostUsedCategory' => $mostUsedCategory,
    ];
    // Load the dashboard view with the retrieved data
    $this->view('pages/stats', $data);
  }
}
