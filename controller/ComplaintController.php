<?php

    session_status() === PHP_SESSION_ACTIVE ?: session_start();
    include_once '../model/database.php';
    include '../model/Complaint.php';
    //get a DB connection
    $instance = Database::getInstance();
    $conn = $instance->getDBConnection();

    if(isset($_POST['submit'])) {

        $complaint = new Complaint();
        $complaint->comp_desc = $conn->real_escape_string($_POST['description']);
        $complaint->created_at = strftime('%Y-%m-%d %H:%M:%S');
        $complaint->user_id = intval($_SESSION['user_id']);
        $complaint->hide = intval(!empty($_POST['hide']) ? $_POST['hide'] : NULL);

        if($_FILES['file']['tmp_name'] !== '') {

            $file = $_FILES['file'];
            var_dump($file);
            var_dump($_POST['description']);
            var_dump(intval($_POST['hide']));
    
            //file properties;
            $file_ext = array("txt","jpg","zip","rar","gif","png","jpeg");
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
    
                $newDest = "../view/uploads/" . $newFileName;
    
                if(move_uploaded_file($file_tmp, $newDest)) {
    
                    $complaint->attached_file = $newDest;
                    echo "upload successful!";
                    $complaint->create();

                } else {
                    echo "upload failed!";
                }

            }else{
                echo "filetype not allowed!";
            }

        } else {
            $complaint->attached_file = NULL;
            $complaint->create();
        }


    }
?>