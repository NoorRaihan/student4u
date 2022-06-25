<?php

    session_status() === PHP_SESSION_ACTIVE ?: session_start();
    include_once '../model/database.php';
    include '../model/Complaint.php';
    
    function create_complaint($uid) 
    {
        //get a DB connection
        $instance = Database::getInstance();
        $conn = $instance->getDBConnection();

        $uid = intval($uid);

        $complaint = new Complaint();
        $complaint->comp_desc = $conn->real_escape_string($_POST['description']);
        $complaint->created_at = strftime('%Y-%m-%d %H:%M:%S');
        $complaint->user_id = intval($uid);
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
    
                $newDest = "../view/uploads/complaint/" . $newFileName;
    
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

    //edit the complaint
    function edit_complaintByID($id,$uid)
    {
        //get a DB connection
        $instance = Database::getInstance();
        $conn = $instance->getDBConnection();

        $id = intval($id);
        $uid = intval($uid);

        $complaint = new Complaint();
        $complaint->comp_id = $id;
        $complaint->comp_desc = $conn->real_escape_string($_POST['description']);
        $complaint->updated_at = strftime('%Y-%m-%d %H:%M:%S');
        $complaint->user_id = $uid;
        $complaint->hide = intval(!empty($_POST['hide']) ? $_POST['hide'] : NULL);

        if($_FILES['file']['tmp_name'] !== '') {

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
    
                $newDest = "../view/uploads/" . $newFileName;
    
                if(move_uploaded_file($file_tmp, $newDest)) {
    
                    $complaint->attached_file = $newDest;
                    $complaint->updateByUID();

                } else {
                    echo "upload failed!";
                }

            }else{
                echo "filetype not allowed!";
            }

        } else {
            if($_POST['curr-file'] != NULL || $_POST != "") {
                $complaint->attached_file = $_POST['curr-file'];
            }else{
                $complaint->attached_file = NULL;
            }
            $complaint->updateByUID();
        }
    }

    //get all the complaint
    function view_all_complaint()
    {
        return Complaint::getAllComplaint();
    }

    function view_all_complaint_uid()
    {
        $uid = intval($_SESSION['user-id']);
        return Complaint::getAllComplaintByUID($uid);
    }

    function get_complaint_UID($id)
    {
        $id = intval($id);
        $uid = intval($_SESSION['user_id']);
        return Complaint::getComplaintByUID($id,$uid);
    }

    function get_complaint($id)
    {
        $id = intval($id);
        return Complaint::getComplaintByID($id);
    }

    function deleteComplaintByUID($id)
    {
        $id = intval($id);
        $uid = intval($_SESSION['user_id']);

        //get the complaint data
        $complaint = Complaint::getComplaintByUID($id,$uid);

        //try to delete the file if have from the server
        if(!empty($complaint['attached_file'])) {

            if(file_exists($complaint['attached_file'])) {
                if(unlink($complaint['attached_file'])) {
                    Complaint::deleteByUID($id,$uid);
                }else{
                    echo "Deleting complaint went wrong!";
                }
            }else{
                Complaint::deleteByUID($id,$uid);
            }
        }else{
            Complaint::deleteByUID($id,$uid);
        }
    }

    function responseComplaint($id, $status)
    {
        //get a DB connection
        $instance = Database::getInstance();
        $conn = $instance->getDBConnection();

        $id = intval($id);

        $complaint = new Complaint();
        $complaint->comp_id = $id;
        $complaint->updated_at = strftime('%Y-%m-%d %H:%M:%S');
        $complaint->comp_status = $status;
        $complaint->comp_response = $conn->real_escape_string($_POST['response']);

        $complaint->responseByID();
    }

    if(isset($_POST['submit'])) {
        create_complaint($_SESSION['user_id']);
    }

    if(isset($_POST['update'])) {

        $id = $_POST['id'];
        $uid = $_SESSION['user_id'];
        edit_complaintByID($id,$uid);
    }

    if(isset($_POST['delete'])) {
        
        $id = $_POST['id'];
        deleteComplaintByUID($id);
    }

    if(isset($_POST['approve']) || isset($_POST['reject'])) {

        if(isset($_POST['approve'])) {
            $status = "APPROVED";
        }else{
            $status = "REJECTED";
        }

        $id = $_POST['id'];
        responseComplaint($id, $status);
    }

?>