<?php
    include "./../../inc/dbconfig.php";

    $db = $pdo;

    include "./../../inc/portfolio.php";

    $portfolio = new Portfolio($db);

    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $mode = isset($_POST['mode']) ? $_POST['mode'] : '';

    if ($category == '') {
        die(json_encode(['result' => 'empty_category']));
    };

    if ($name == '') {
        die(json_encode(['result' => 'empty_name']));
    };

    if ($description == '') {
        die(json_encode(['result' => 'empty_description']));
    };

    if ($mode == '') {
        die(json_encode(['result' => 'empty_mode']));
    };

    if ($mode == 'portfolio_input') {
        $upload_dir = "../../data/admin_portfolio/";

        $uploadedFiles = array();

        for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
            $filename = $_FILES['files']['name'][$i];
            $tmp_name = $_FILES['files']['tmp_name'][$i];

            $extArray = explode('.', $filename);
            $ext = end($extArray);

            $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
            if (in_array(strtolower($ext), $allowedExtensions)) {
                // 허용되는 확장자일 경우 파일을 지정된 디렉토리로 복사
                $newFilename = $name . '-' . ($i + 1) . '.' . $ext;
                if (move_uploaded_file($tmp_name, $upload_dir . $newFilename)) {
                    $uploadedFiles[] = $newFilename; // 업로드된 파일명을 배열에 추가
                } else {
                    // 파일 업로드 실패
                    die("File upload failed");
                }
            }
        };

        $uploadedFilesString = implode(',', $uploadedFiles);

        $arr = [
            'Category' => $category,
            'Name' => $name,
            'Description' => $description,
            'ImageRoute' => $uploadedFilesString
        ];

        try {
            $result = $portfolio->input($arr);
    
            header('Content-Type: application/json');
            if ($result) {
                die(json_encode(['result' => 'success']));
            } else {
                die(json_encode(['result' => 'fail']));
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            die(json_encode(['result' => 'error', 'message' => $e->getMessage()]));
        }
    } else if ($mode == "portfolio_edit") {
        session_start();

        $old_name = (isset($_POST['old_name']) && $_POST['old_name'] != '') ? $_POST['old_name'] : '';
        $old_images = (isset($_POST['old_images']) && $_POST['old_images'] != '') ? $_POST['old_images'] : '';
        $uploadedFiles = [];
        $uploadedFilesString = '';
        $idx = (isset($_GET['idx']) && $_GET['idx'] != '') ? $_GET['idx'] : '';
    
        if ($name != $old_name && empty($_FILES['files']['tmp_name'])) {
            $upload_dir = "../../data/admin_portfolio/";
    
            // $old_name으로 시작하는 모든 파일을 찾아서 $name으로 변경한다.
            $files = glob($upload_dir . $old_name . ".*");
            foreach ($files as $file) {
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                rename($file, $upload_dir . $name . "." . $ext);
    
                // 변경된 파일명을 배열에 추가
                $uploadedFiles[] = $name . "." . $ext;
            };
            $uploadedFilesString = implode(',', $uploadedFiles);
        };

        if ($name == $old_name && !empty($_FILES['files']['tmp_name'])) {
            $upload_dir = "../../data/admin_portfolio/";
            $uploadedFiles = [];
        
            // 새로 업로드된 파일을 저장
            foreach ($_FILES['files']['tmp_name'] as $index => $tmp_name) {
                $ext = pathinfo($_FILES['files']['name'][$index], PATHINFO_EXTENSION);
                $newFilename = $name . "." . $ext;
                move_uploaded_file($tmp_name, $upload_dir . $newFilename);
        
                // 새로 업로드된 파일명을 배열에 추가
                $uploadedFiles[] = $newFilename;
            }
        
            // 기존에 있던 파일을 삭제
            $oldFiles = explode(',', $old_images);
            foreach ($oldFiles as $oldFile) {
                if (file_exists($upload_dir . $oldFile)) {
                    unlink($upload_dir . $oldFile);
                }
            }
            // 파일명들을 하나의 문자열로 만듦
            $uploadedFilesString = implode(',', $uploadedFiles);
        };

        if ($name != $old_name && !empty($_FILES['files']['tmp_name'])) {
            $upload_dir = "../../data/admin_portfolio/";
            $uploadedFiles = [];
        
            // 새로 업로드된 파일을 저장
            foreach ($_FILES['files']['tmp_name'] as $index => $tmp_name) {
                $ext = pathinfo($_FILES['files']['name'][$index], PATHINFO_EXTENSION);
                $newFilename = $name . "." . $ext;
                move_uploaded_file($tmp_name, $upload_dir . $newFilename);
        
                // 새로 업로드된 파일명을 배열에 추가
                $uploadedFiles[] = $newFilename;
            }
        
            // 기존에 있던 파일을 삭제
            $oldFiles = glob($upload_dir . $old_name . ".*");
            foreach ($oldFiles as $oldFile) {
                unlink($oldFile);
            }
        
            // 파일명들을 하나의 문자열로 만듦
            $uploadedFilesString = implode(',', $uploadedFiles);
        };

        $arr = [
            'category' => $category,
            'name' => $name,
            'description' => $description,
            'imageRoute' => $uploadedFilesString,
            'idx' => $idx
        ];

        $result = $portfolio->admin_portfolio_edit($arr);

        if ($result['success']) {
            die(json_encode(['result' => 'success']));
        } else {
            die(json_encode(['result' => 'fail', 'message' => $result['error']]));
        }
    };
    
?>