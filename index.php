<!DOCTYPE html>

<?php
    include("process.php");

?>

<script> //Prevents page load to process.php.
    document.getElementById("form-table").addEventListener("submit", function (e) {
        e.preventDefault();
    });
</script>
<html>
<head>
    <meta charset="UTF-8">
    <title>Word Frequency Counter</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="index.php">
    
</head>
<body>
    <h1>Word Frequency Counter</h1>
    
    <form action="process.php" method="post" id="form-table">
        <label for="text">Paste your text here:</label><br>
        <textarea id="text" name="text" rows="10" cols="50" required></textarea><br><br>
        
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
            foreach($limitArr as $x){
                echo $x, '<br>';
            }
            ?>
        </div>
    </section>
</body>
</html>
