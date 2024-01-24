<?php
if (isset( $_SESSION['user_id']) && isset( $_SESSION['user_email'])) {   
}else{
    redirect('users/login');
    exit;
}
?>