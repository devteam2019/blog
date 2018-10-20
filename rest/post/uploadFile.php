<?php
    header('Access-Control-Allow-Origin: *'); 
    header('Content-type: application/json');
    
    //no validation. You should validate something before uploading. 
    // e.g. file extension, file size, file already exists or not  etc
    // file upload allowed on server with max size greater than 2MB.
    
    $res = [];
            
    $target_dir = "../../upload/";
    $target_file = $target_dir . basename($_FILES["fileImage"]["name"]);
    
    if (move_uploaded_file($_FILES["fileImage"]["tmp_name"], $target_file)) {
        $res["message"] =  "The file " . basename( $_FILES["fileImage"]["name"]). " has been uploaded.";
        $res["uploadedUrl"] = $target_file;
    } else {
        http_response_code(200);
        $res["message"] =  "Sorry, there was an error uploading your file.".$_FILES["fileImage"]["tmp_name"];
    }
        
    echo json_encode($res);
    die();