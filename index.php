<!DOCTYPE html>

<?php

$str = explode(" ", strtolower($_POST['text']));
$sort = $_POST["sort"];
$limit = $_POST["limit"];

$notWord = ["the", "a", "is", "this", "an", "and", "as", "at", "but", "if"
            ,"in", "it", "of", "on", "or", "to", "with"];

$wordNum = [];
$strWord = []; //aligning amount of word and value.
for($i = 0; $i < sizeof($str); $i++){
    if(!in_array($str[$i], $strWord)){
        $strWord[$i] = $str[$i];
        $wordNum[$i] = 0;
    }
}

$wholeArr = array_combine($strWord, $wordNum); //combine! adding value to words.


for($i = 0; $i < count($str); $i++){ //word count for each word
    if(in_array($str[$i], array_keys($wholeArr))){
        $wholeArr[$str[$i]]++;
    }
}
/*
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
}*/
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
                /*
                var_dump($str);
                echo '<br>';
                var_dump($strWord);
                echo '<br>';
                var_dump($wordNum);
                echo '<br>';*/
                $count = 1;
                foreach($wholeArr as $key => $value){
                    if(!in_array($key, $notWord)){
                        echo $key, ": ", $value, "<br>";
                    }
                    if ($count == $limit){
                        break;
                    }
                    $count++;
                }
            ?>
        </div>
    </section>
</body>
</html>

