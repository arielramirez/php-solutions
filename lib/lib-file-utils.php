<?php
/**
 * This function parses out and returns data contained in a given text file
 *
 * If a first delimiter is given, it will parse only the rows
 * If a second delimiter is given, it will parse individual cells as well
 *
 * NOTE: MUST USE DOUBLE QUOTES FOR DELIMITERS
 *
 * @param array $fileData
 * @param string $rowDelim
 * @param string $colDelim
 * @param array $extensions
 * @return mixed
 */
function getFileContents($fileData, $rowDelim = "\r\n", $colDelim = "", $extensions = array('txt')) {
    $errorsArray = array();

    $errors = validateFileData($fileData, $extensions);
    if(!empty($errors)) {
        //if any errors occurred, throw them to the error log
        foreach($errors as $error) {
            error_log($error);
        }

        //exit;
        return false;
    }

    //getting text from file
    $txt = file_get_contents($fileData['tmp_name']);

    //getting rows of data to process
    $rows = explode($rowDelim, $txt);

    //empty array to hold data
    $dataArray = array();
    if ($colDelim != '') {
        //iterating through rows to perform calcuations and dispaly output
        foreach($rows as $row => $data)
        {
            //extracting all the pieces into an array
            $dataArray[] = explode($colDelim, $data);
        }
        return $dataArray;
    }

    return $rows;
}

/**
 * This function accepts an array of file data and array of extensions and
 *   verifies that the fileData is acceptable
 *
 * @param array $fileData
 * @param array $extensions
 * @return array
 */
function validateFileData($fileData, $extensions) {
    $errors = array();
    //ensuring file contents are good
    if(!isset($fileData) || empty($fileData)) {
        $errorsArray[] = "Invalid file data. Please try again";
    }

    //validating that extension type is acceptable
    $exts = explode('.',$fileData['name']);
    $file_ext = strtolower(array_pop($exts));
    if(in_array($file_ext,$extensions)=== false){
        $errors[]="Extension type $file_ext is not allowed. Please choose one of these file 
        types: " . implode(', ', $extensions) . ".";
    }

    //ensuring file size is not too large
    if($fileData['size'] > 2097152){
        $errors[]='File size must be less than 2 MB.';
    }

    //returning empty array if no errors, values if errors occurred
    return $errors;

}
