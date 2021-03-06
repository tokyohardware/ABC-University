<?php
session_start();
//Include database connection details
require_once('db.php');
$db_controller = new DbController();
$result = '';
if (isset($_POST['id']) && isset($_POST['type'])) {

    $user_id = $_SESSION['user_details']['user_id'];
    $user_type = $_SESSION['user_details']['user_role_id'];
    $idea_id = $_POST['id'];
    $status = $_POST['type'];

    if ($user_type = 2) {
        $user_type = 1;
    }else {
        $user_type = 2;
    }

    $db_controller->deleteLikeDislikeByIdeaUser($user_id,$idea_id,$user_type);
    
    $save = $db_controller->saveLikeDislike($user_id,$idea_id,$user_type,$status);

    //get like count
    $count_like = $db_controller->getCountLikeDislikeById(1,$idea_id);

    //get dislike count
    $count_dislike = $db_controller->getCountLikeDislikeById(2,$idea_id);


    if ($save != '') {
        $msg = "Done";
    }

    $result = array('result'=>$msg,'like'=>$count_like,'dislike'=>$count_dislike);
}
echo json_encode($result);
?>


