<?php


//will include doc about this function. might change name
function arrayToAssocArrayInt(array $arr):array{
    $notWord = ["the", "a", "is", "this", "an"];
    $arr = array_diff($arr, $notWord);

    $newArr = [];
    for($i = 0; $i < sizeof($arr); $i++){
        $newArr[$arr[$i]] = 0;
    }
    return $newArr;
}

//include("index.php");






$str = explode(" ", strtolower($_POST['text']));
$sort = $_POST['sort'];
$limit = $_POST['number'];

//make a function that counts words. (or use built-in functions.)
$notWord = ["the", "a", "is", "this", "an"];

$str = array_diff($str, $notWord); // removes non-counted words
$strWord = []; //for loop for assign value for each word & avoid dupes.
for($i = 0; $i < sizeof($str); $i++){
    if(!in_array($str[$i], $strWord)){
        $strWord[$str[$i]] = 0;
    }
}

for($i = 0; $i < sizeof($str); $i++){ //word count for each word
    if(in_array($str[$i], $strWord)){
        $strWord[$str[$i]]++;
    }
}
//krsort ksort for keys sort

switch($sort){
    case 'asc':
        sort($strWord);
    break;
    case 'desc':
        arsort($strWord);
    break;
}

$limitArr = [];
for($i = 0; $i < sizeof($strWord) - $limit; $i++){
    $limitArr[$str[$i]] = $strWord[$str[$i]];
}

foreach($limitArr as $x){
    echo $x, '<br>';
}
//display limit of showing words like mysql lol
//"The output should be presented in a clear and readable format." I gotchu.

//error handling? oh noes.