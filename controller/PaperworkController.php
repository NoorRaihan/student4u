<?php

    session_status() === PHP_SESSION_ACTIVE ?: session_start();
    include_once '../model/database.php';
    include '../model/Paperwork.php';
    include '../model/Club.php';


    function create_submission($uid)
    {
        //get a DB connection
        $instance = Database::getInstance();
        $conn = $instance->getDBConnection();

        $uid = intval($uid);
        //create the paperwork object
        $paperwork = new Paperwork();
        $paperwork->sender_role = $conn->real_escape_string($_POST['event-role']);
        $paperwork->program_name = $conn->real_escape_string($_POST['event-name']);
        $paperwork->advisor = $conn->real_escape_string($_POST['advisor-name']);
        $paperwork->club_id = intval($conn->real_escape_string($_POST['club']));
        $paperwork->user_id = $uid;
        $paperwork->created_at = strftime('%Y-%m-%d %H:%M:%S');

        //start to handle the file upload
        $file = $_FILES['file'];

        //file properties;
        $file_ext = array("txt","jpg","zip","rar","gif","png","jpeg","pdf");
        $filename = $file['name'];
        $file_type = $file['type'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        $file_tmp = $file['tmp_name'];

        //check for file format
        $fileExplode = explode(".", $filename);
        $file_format = strtolower(end($fileExplode));

        //sanitize the filename
        $newFileName = md5(time().$filename) . "." . $file_format;

        //check if the file format is allow
        if(in_array($file_format, $file_ext)) {

            $newDest = "../view/uploads/paperwork/" . $newFileName;

            if(move_uploaded_file($file_tmp, $newDest)) {

                $paperwork->attached_file = $newDest;
                
                echo "upload successful!";
                $paperwork->create();

            } else {
                echo "upload failed!";
            }

        }else{
            echo "filetype not allowed!";
        }

    }

    function edit_paperworkById($id, $uid)
    {
         //get a DB connection
         $instance = Database::getInstance();
         $conn = $instance->getDBConnection();
 
         $uid = intval($uid);
         $id = intval($id);
         //create the paperwork object
         $paperwork = new Paperwork();
         $paperwork->id = $id;
         $paperwork->sender_role = $conn->real_escape_string($_POST['event-role']);
         $paperwork->program_name = $conn->real_escape_string($_POST['event-name']);
         $paperwork->advisor = $conn->real_escape_string($_POST['advisor-name']);
         $paperwork->club_id = intval($conn->real_escape_string($_POST['club']));
         $paperwork->user_id = $uid;
         $paperwork->updated_at = strftime('%Y-%m-%d %H:%M:%S');
        
         if($_FILES['file']['tmp_name'] == "" && $_POST['curr-file'] == '') {
            echo "<script>alert('Attached file must be included'); window.location.href = document.referrer</script>";

         }else if($_POST['curr-file'] != NULL || $_POST['curr-file'] != ""){
            $paperwork->attached_file = $_POST['curr-file'];
            $paperwork->updateByUID();     
        }else{
            //start to handle the file upload
            $file = $_FILES['file'];

            //file properties;
            $file_ext = array("txt","jpg","zip","rar","gif","png","jpeg","pdf");
            $filename = $file['name'];
            $file_type = $file['type'];
            $file_size = $file['size'];
            $file_error = $file['error'];
            $file_tmp = $file['tmp_name'];

            //check for file format
            $fileExplode = explode(".", $filename);
            $file_format = strtolower(end($fileExplode));

            //sanitize the filename
            $newFileName = md5(time().$filename) . "." . $file_format;

            //check if the file format is allow
            if(in_array($file_format, $file_ext)) {

                $newDest = "../view/uploads/paperwork/" . $newFileName;

                if(move_uploaded_file($file_tmp, $newDest)) {

                    $paperwork->attached_file = $newDest;
                    
                    echo "upload successful!";
                    $paperwork->updateByUID();
                } else {
                    echo "upload failed!";
                }

            }else{
                echo "filetype not allowed!";
            }
        
        }
            
    }

    function getAllClubs()
    {
        return Club::getAllClubs();
    }

    function getAllPaperworks()
    { 
        return Paperwork::getAllPaperworks();
    }

    function getPaperworkByID($id)
    {
        return Paperwork::getPaperworkByID($id);
    }

    function deletePaperworkByUID($id)
    {
        $id = intval($id);
        $uid = intval($_SESSION['user_id']);
        //get the file url
        $paperwork = Paperwork::getPaperworkByUID($id, $uid);
        
        //delete the file and data from database and server
        if(file_exists($paperwork['attached_file'])) {
            
            if(unlink($paperwork['attached_file'])) {
                Paperwork::deleteByUID($id,$uid);
            }else{
                echo "delete process gone wrong!";
            }
        }else{
            Paperwork::deleteByUID($id,$uid);
        }
    }

    if(isset($_POST['submit'])) {
        create_submission($_SESSION['user_id']);
    }

    if(isset($_POST['delete'])) {
        
        $id = $_POST['id'];
        deletePaperworkByUID($id);
    }

    if(isset($_POST['update'])) {
        
        $id = $_POST['id'];
        $uid = $_SESSION['user_id'];
        edit_paperworkById($id,$uid);
    }

    if(isset($_POST['response']))
    {
        //code here
    }
?>