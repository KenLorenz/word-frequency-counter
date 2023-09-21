<!DOCTYPE html>

<?php

/*
    * Convert array into associative array with unique words as key and has value, and return the result.
    * Does not include non counted words to the result.
    *
    * @param array $postArr the user input's array.
    * @return array the combination of $wordArr and $valueArr.
*/
function arrTableConstruct(array $postArr):array{
    $notWord = ["the", "a", "is", "this", "an", "and", "s", "at", "but", "if"
            ,"in", "it", "of", "on", "or", "to", "with", ""];
    $wordArr = []; $valueArr = [];
    foreach($postArr as $x){
        if(!in_array($x, $wordArr) && !in_array($x, $notWord)){
            $wordArr[] = $x;
            $valueArr[] = 0;
        }
    }
    return array_combine($wordArr, $valueArr);
}

/*
    * Count the words in the user input using associative array.
    *
    * @param array $resultArr The associative array with key words and int values.
    * @param array $postArr The user input array.
    * @return array Words frequency counted, resultArr values updated.
*/
function wordCount(array $resultArr, array $postArr):array{
    for($i = 0; $i < count($postArr); $i++){
        if(in_array($postArr[$i], array_keys($resultArr))){
            $resultArr[$postArr[$i]]++;
        }
    }
    return $resultArr;
}

/*
    * print the $ResultArr depending on word limit.
    *
    * @param array $resultArr The associative array with key words and int values.
    * @param array $limit The user input preferred word limit.
    * echo $resultArr.
    * @return void.
*/
function printWithLimit(array $resultArr, float $limit): void{
    for($i = 0, $count = 1,$key = array_keys($resultArr); $i < sizeof($resultArr); $i++, $count++){
        echo $key[$i], ": ", $resultArr[$key[$i]], "<br>";
        if($count == $limit) break;
    }
    return;
}

//acquisition of data from POST
$postArr = explode(" ", strtolower($_POST['text']));
$sort = $_POST["sort"];
$limit = $_POST["limit"];

$resultArr = arrTableConstruct($postArr);

$resultArr = wordCount($resultArr, $postArr);

// sorts $resultArr based on $sort. asort = ascending, arsort = descending.
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
    <p>Check the spellings for self-beneficial accuracy.</p>
    
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

