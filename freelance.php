<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Alex Toneka's Freelance URLs</title>
    <?php include 'styles.php';?>
</head>  
<body>
    
<div id="all_wrap">       

<header>
    <div style="text-align:center; font-size:1.5em; color:#3399ff; font-weight:bold;">Alex Toneka's</div>
    <div style="text-align:center; font-size:2.5em; color:#b3b3ff;">Research URLs</div>
    <a href="http://localhost/phpmyadmin/" target="_blank" style="float:right;">phpMyAdmin</a>
</header>

<nav style="clear:right;"> 
    <ul>
        <li><a href="index.php">Frequently Used</a></li>
        <li><a href="freelance.php" class="active">About Freelance</a></li>
        <li><a href="research.php">Do Research</a></li>
    </ul>
</nav>     
    
<div id="main_wrap">
       
<section id="add_link_form">    
    <form action="freelance.php" method="post">
        ADD LINKS:<br>
        Name <input type="text" name="name"><br>
        URL <input type="text" name="url"><br>
        Tags<br>
        <input type="checkbox" id="rtag_webdev" name="rtags[]" value="Web Dev"><label for="rtag_webdev">Web Dev</label><br>
        <input type="checkbox" id="rtag_freelance" name="rtags[]" value="Freelance"><label for="rtag_freelance">Freelance</label><br>
        <input type="checkbox" id="rtag_business" name="rtags[]" value="Business"><label for="rtag_business">Business</label><br> 
        <input type="checkbox" id="rtag_medicine" name="rtags[]" value="Medicine"><label for="rtag_medicine">Medicine</label><br> 
        <input type="checkbox" id="rtag_data" name="rtags[]" value="Data"><label for="rtag_data">Data</label><br> 
        <input type="checkbox" id="rtag_analytics" name="rtags[]" value="Analytics"><label for="rtag_analytics">Analytics</label><br> 
        <input type="checkbox" id="rtag_statistics" name="rtags[]" value="Statistics"><label for="rtag_statistics">Statistics</label><br> 
        <input type="checkbox" id="rtag_ecommerce" name="rtags[]" value="E-commerce"><label for="rtag_ecommerce">E-Commerce</label><br> 
        <input type="checkbox" id="rtag_database" name="rtags[]" value="Database"><label for="rtag_database">Database</label><br> 
        <input type="checkbox" id="rtag_tools" name="rtags[]" value="Tools"><label for="rtag_tools">Tools</label><br> 
        <input type="checkbox" id="rtag_legal" name="rtags[]" value="Legal"><label for="rtag_legal">Legal</label><br> 
        <input type="checkbox" id="rtag_government" name="rtags[]" value="Government"><label for="rtag_government">Government</label><br> 
        Notes <textarea name="notes" rows="5" cols="20"></textarea><br>
        <input style="width:55px;" type="submit" name="submit" value="Add">
    </form>

<?php
    include 'mysqlconnect.php';
    if (isset($_POST['submit'])) {include 'submit_freelance_link.php';}
?>
</section>

<section class="top-line">
    <div class="top-line-content">
    Select tags: Web Dev > Freelance > Business > Medicine > Data > Analytics > Statistics > E-Commerce > Database > Tools > Legal > Government > News > Patents > Drugs
    </div>
</section>
    
<section id="results_table">
<?php $sql_select = "SELECT name, URL, tags, notes FROM about_freelance";
$result_select = $connection->query($sql_select);

if ($result_select->num_rows > 0) {?>
    <table id="link_output">
        <tr>
            <th class="name">Name</th>
            <th class="tags">Tags</th>
            <th class="notes">Notes</th>
            <th class="delete">Delete</th>
        </tr>
        <?php while($row = $result_select->fetch_assoc()) {
        if (!empty($row["name"])) {
            $rowname = $row["name"];
        } elseif (empty($row["name"]) && !empty($row["URL"])) {
            $rowname = $row["URL"];
        } else {
            $rowname = "null";
        }
        echo "<tr><td><a href=\"" . $row["URL"] . "\" class=\"bookmark\" target=\"_blank\">" . $rowname . "</a></td><td style=\"text-align:center;\">" . $row["tags"] . "</td><td>" . $row["notes"] . "</td>";
        echo "<td>delete</td></tr>";
    }
    ?></table><?php
} else {
    echo "0 results";
}
$connection->close();
?>
</section>

</div>   
    

    
</div>

</body>
</html>

