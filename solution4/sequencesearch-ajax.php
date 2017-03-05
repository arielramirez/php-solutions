<?php
/**
 * All function in this file are designed to be called via AJAX
 */

include_once('../lib/lib-file-utils.php');


$call = isset($_POST['function']) ? $_POST['function'] : '';

if($call != '') {
    //executing desired function
    $call();
}

/**
 * This function accepts file selected by the user, json encodes the file results
 * and echos out the results
 */
function extractStringsFromFile() {
    if(isset($_FILES['substring_file'])) {
        $stringsToSearch = getFileContents($_FILES['substring_file'], "\r\n");

        if(!is_array($stringsToSearch)) {
            echo 'fail';
            return;
        }
        echo json_encode($stringsToSearch);
        return;
    }
    else {
        echo 'fail';
        return;
    }
}

/**
 * algorithm located at http://www.geeksforgeeks.org/count-distinct-occurrences-as-a-subsequence/
 *
 * Crawls through a string and identifies the unique occurrences of a given substring
 *
 * @return string
 */

function findSubsequenceCount() {
    //$str = S (string to search within)
    //$seq = T (sequence to search for)
    //$seqLength = N
    //$strLength = M

    //S
    $str = json_decode($_POST['string']);
    //T
    $seq = json_decode($_POST['sequence']);

    //m
    $seqLength = count($seq) - 1; //storing length of sequence
    //n
    $strLength = count($str) - 1; //storing length of string

    // sequence can't appear as a subsequence in string if string is shorter than sequence
    if ($seqLength > $strLength)
        return '0';

    // matches[i][j] stores the count of occurrences of
    // seq(1..i) in str(1..j).
    $matches = array();

    // Initializing first column with all 0s. An empty
    // string can't have another string as subsequence
    for ($i = 1; $i <= $seqLength; $i++) {
        $matches[$i][0] = 0;
    }

    // Initializing first row with all 1s. An empty
    // string is subsequence of all.
    for ($j = 0; $j <= $strLength; $j++)
        $matches[0][$j] = 1;

    // Fill matches[][] in bottom up manner
    for($i = 1; $i <= $seqLength; $i++)
    {
        for ($j = 1; $j <= $strLength; $j++)
        {
            // If last characters don't match, then value
            // is same as the value without last character
            // in S.
            if ($seq[$i - 1] != $str[$j - 1])
                $matches[$i][$j] = $matches[$i][$j - 1];

            // Else value is obtained considering two cases.
            // a) All substrings without last character in S
            // b) All substrings without last characters in
            //    both.
            else
                $matches[$i][$j] = $matches[$i][$j - 1] + $matches[$i - 1][$j - 1];
        }
    }

    //uncomment this to print matrix of matches
    //for ($i = 1; $i <= $seqLength; $i++)
        //for ($j = 1; $j <= $strLength; $j++)
            //error_log("Match Printout: " . $matches[$i][$j]);

    echo substr(number_format($matches[$seqLength][$strLength], 0, '', ''), -5);
}
