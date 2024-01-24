<?php

class Users extends Controller
{
    public $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }
    public function register()
    {


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);


            // init data
            $data = [


                'name' => trim($_POST['name']),
                'userlastname' => trim($_POST['userlastname']),
                'phoneNumber' => trim($_POST['phoneNumber']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'roleuser' => 'user',
                'name_err' => '',
                'userlastname_err' => '',
                'phoneNumber_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            //*******  VALIDATE DATA***********

            if (empty($data['name'])) {
                $data['name_err'] = 'please enter name ';
            }

            if (empty($data['userlastname'])) {
                $data['userlastname_err'] = 'please enter name ';
            }



            if (empty($data['phoneNumber'])) {
                $data['phoneNumber_err'] = 'Please enter a phone number.';
            } elseif (!preg_match('/^\d{10}$/', $data['phoneNumber'])) {
                $data['phoneNumber_err'] = 'Invalid phone number format.';
            }


            if (empty($data['email'])) {
                $data['email_err'] = 'please enter email ';
            } elseif ($this->userModel->findUserByEmail($data['email'])) {
                $data['email_err'] = 'EMAIL ALREADY EXIST ';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Invalid email format.';
            }


            if (empty($data['password'])) {
                $data['password_err'] = 'please ENTER PASSWORD ';
            } elseif (strlen($data['password']) < 8) {
                $data['password_err'] = ' PASSWORD  MUST BE AT LEAST 8';
            }
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter a password.';
            } elseif (strlen($data['password']) < 8) {
                $data['password_err'] = 'Password must be at least 8 characters long.';
            } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[\w\W_]{8,}$/', $data['password'])) {
                $data['password_err'] = 'Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.';
            }


            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'please ENTER confirm_password ';
            } else {
                if ($data['password'] !=  $data['confirm_password']) {
                    $data['confirm_password_err'] = ' PASSWORD DO NOT MATCH';
                }
            }

            if (empty($data['name_err']) && empty($data['userlastname_err']) && empty($data['phoneNumber_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // validated

                //********haching password *********
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                // var_dump($this->userModel);die();

                /************registring data by class User from the model that they have a function register ************** */
                if ($this->userModel->register($data)) {

                    redirect('users/login');
                } else {
                    die('something went wrong');
                }
            } else {
                // load the view
                $this->view('users/register', $data);
            }
        } else {

            $data = [
                'name' => '',
                'userlastname' => '',
                'phoneNumber' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'roleuser' => '',
                'name_err' => '',
                'userlastname_err' => '',
                'phoneNumber_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];


            $this->view('users/register', $data);
        }
    }
    public function login()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),

                'email_err' => '',
                'password_err' => '',
            ];
            // *************check the email*****************
            if (empty($data['email'])) {
                $data['email_err'] = 'please enter email ';
            }
            // /*************Check the password */
            if (empty($data['password'])) {
                $data['password_err'] = 'please ENTER PASSWORD ';
            }
            /**check if this user exist or not *********** */
            if ($this->userModel->findUserByEmail($data['email'])) {
            } else {

                $data['email_err'] = 'no user found';
            }




            if (empty($data['email_err']) && empty($data['password_err'])) {
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                // var_dump($loggedInUser);
                // die();

                if ($loggedInUser) {

                    /********* * Create Session  ************/
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password incorrect';

                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }
        } else {
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];


            $this->view('users/login', $data);
        }
    }




    public function createUserSession($user)
    {

        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->prenom;
        $_SESSION['user_image'] = $user->image;
        $_SESSION['user_lastname'] = $user->nom;
        $_SESSION['user_phone'] = $user->telephone;
        $_SESSION['user_role'] = $user->roleuser;
        if ($_SESSION['user_role'] == 'user') {
            redirect('pages/index');
        } elseif ($_SESSION['user_role'] == 'admin') {
            redirect('wikis/stats');
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_image']);
        unset($_SESSION['user_lastname']);
        unset($_SESSION['user_phone']);
        unset($_SESSION['user_role']);

        session_destroy();
        redirect('users/login');
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

    public function search()
    {
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
            $data = $this->userModel->search($search);
            echo json_encode($data);
        }
    }
}
