<?php

if (isset($_FILES['file']['name'])) {
    /* Getting file name */
    $filename = $_FILES['file']['name'];

    /* Location */
    $location =  __DIR__ . "images/" . $filename;
    $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);

    /* Valid extensions */
    $valid_extensions = array("jpg", "jpeg", "png");
    // die($location);
    /* Check file extension */
    if (in_array($imageFileType, $valid_extensions)) {
        /* Upload file */
        $done = move_uploaded_file($_FILES['file']['tmp_name'], $location);
        if ($done > 0) {
            die($location);
            $response = $location;
        }
    }

    echo $response;
    exit;
}
echo 0;
