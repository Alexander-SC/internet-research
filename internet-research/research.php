<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Alex Toneka's Research URLs</title>
    <?php include 'styles.php';?>
</head>  
<body>
    
<div class="container">    

<header>
    <div style="text-align:center; font-size:150%; color:#004d4d;">Alex Toneka's</div>
    <div style="text-align:center; font-size:200%; color:#004d4d;">Research URLs</div>
</header>

<nav>    
    <ul>
        <li><a href="index.php">Frequently Used</a></li>
        <li><a href="freelance.php">About Freelance</a></li>
        <li><a href="research.php" class="active">Do Research</a></li>
    </ul>
</nav> 
       
<section id="add_link_form">    
    <form action="research.php" method="post">
        ADD LINKS:<br>
        Name <input type="text" name="name"><br>
        URL <input type="text" name="url"><br>
        Tags<br>
        <input type="checkbox" id="rtag_health" name="rtags[]" value="Health"><label for="rtag_health">Health</label><br>
        <input type="checkbox" id="rtag_science" name="rtags[]" value="Science"><label for="rtag_science">Science</label><br>
        Notes <textarea name="notes" rows="5" cols="20"></textarea><br>
        <input style="width:55px;" type="submit" name="submit" value="Add">
    </form>

<?php
    include 'mysqlconnect.php';
    if (isset($_POST['submit'])) {include 'submit_research_link.php';}
?>
</section>

<section id="results_table">
<?php $sql_select = "SELECT name, URL, tags, notes FROM do_research";
$result_select = $connection->query($sql_select);

if ($result_select->num_rows > 0) {?>
    <table id="link_output">
        <tr>
            <th>Name</th>
            <th>Tags</th>
            <th>Notes</th>
        </tr>
        <?php while($row = $result_select->fetch_assoc()) {
        if (!empty($row["name"])) {
            $rowname = $row["name"];
        } elseif (empty($row["name"]) && !empty($row["URL"])) {
            $rowname = $row["URL"];
        } else {
            $rowname = "null";
        }
        echo "<tr><td><a href=\"" . $row["URL"] . "\">" . $rowname . "</a></td><td style=\"text-align:center;\">" . $row["tags"] . "</td><td>" . $row["notes"] . "</td></tr>";
    }
    ?></table><?php
} else {
    echo "0 results";
}
$connection->close();
?>
</section>
    
</div>   

</body>
</html>