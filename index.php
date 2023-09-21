<!DOCTYPE html>

<?php

function arrTableConstruct(array $postArr):array{
    $wordArr = []; $valueArr = [];
    foreach($postArr as $x){
        if(!in_array($x, $wordArr)){
            $wordArr[] = $x;
            $valueArr[] = 0;
        }
    }
    return array_combine($wordArr, $valueArr);
}

function wordCount(array $arr, array $inputArr):array{
    for($i = 0; $i < count($inputArr); $i++){
        if(in_array($inputArr[$i], array_keys($arr))){
            $arr[$inputArr[$i]]++;
        }
    }
    return $arr;
}

function sortingOrder(array $arr, string $sort):array{
    switch($sort){
        case "asc":
            return asort($arr);
        case "desc":
            return arsort($arr);
    }
    return $arr;
}

function printWithLimit (array $arr, float $limit): void{
    $notWord = ["the", "a", "is", "this", "an", "and", "as", "at", "but", "if"
            ,"in", "it", "of", "on", "or", "to", "with"];

    for($i = 0, $key = array_keys($arr); $i < sizeof($arr); $i++){
        if(!in_array($key[$i], $notWord)){
            echo $key[$i], ": ", $arr[$key[$i]], "<br>";
        }
        if(($i + 1) == $limit) break;
    }
}

//acquisition of data from POST
$str = explode(" ", strtolower($_POST['text']));
$sort = $_POST["sort"];
$limit = $_POST["limit"];

$resultArr = arrTableConstruct($str);

$resultArr = wordCount($resultArr, $str);

$sort == "asc" ? asort($resultArr) : arsort($resultArr);
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Word Frequency Counter</title>
    <link rel="stylesheet" type="text/css" href="styles.css">  
</head>
<body>
    <h1>Word Frequency Counter</h1>
    <p>Counter does not detect mispelled words, please check it yourself for self beneficial accuracy.</p>
    
    <form action="#" method="post" id="form-table">
        <label for="text">Paste your text here: </label><br>
        <textarea id="text" name="text" rows="10" cols="50" required style="resize: none;"></textarea><br><br>
        
        <label for="sort">Sort by frequency:</label>
        <select id="sort" name="sort">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select><br><br>
        
        <label for="limit">Number of words to display:</label>
        <input type="number" id="limit" name="limit" value="10" min="1"><br><br>
        
        <input type="submit" value="Calculate Word Frequency">
    </form>

    <section>
        <div id="result-table">
            <div class="result-header"><h1>Word Frequency: </h1></div>
            <?php
                printWithLimit($resultArr, $limit);
            ?>
        </div>
    </section>
</body>
</html>

