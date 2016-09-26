<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Alex Toneka's Research URLs</title>
    <?php include 'test_styles.php';?>
</head>  
<body>
    
<div id="all_wrap">    

<header>
    <div style="text-align:center; font-size:1.5em; color:#3399ff; font-weight:bold;">Alex Toneka's</div>
    <div style="text-align:center; font-size:2.5em; color:#b3b3ff;">Research URLs</div>
    <a href="http://localhost/phpmyadmin/" target="_blank" style="float:right;">phpMyAdmin</a>
</header>
    
<!--navigation---------------------------------------------------------------------->
<nav style="clear:right;">    
    <ul>
        <li><a href="test_index.php">Frequently Used</a></li>
        <li><a href="test_freelance.php">About Freelance</a></li>
        <li><a href="test_research.php" class="active">Do Research</a></li>
    </ul>
</nav> 

<div id="main_wrap">
    
<section id="add_link_form">    
    <form action="test_research.php" method="post">
        ADD LINK<br>
        <input type="text" name="name" placeholder="Title"autofocus><br>
        <input type="text" name="url" placeholder="URL"><br>

        <div class="left_column">
        <input type="checkbox" id="rtag_health" name="rtags[]" value="1"><label for="rtag_health">Health</label><br>
        <input type="checkbox" id="rtag_powerhouse" name="rtags[]" value="17"><label for="rtag_powerhouse">Powerhouse</label><br>
        <input type="checkbox" id="rtag_none_defined" name="rtags[]" value="19"><label for="rtag_none_defined">None defined</label><br> 
        <input type="checkbox" id="rtag_medicine" name="rtags[]" value="Medicine"><label for="rtag_medicine">Medicine</label><br> 
        <input type="checkbox" id="rtag_data" name="rtags[]" value="Data"><label for="rtag_data">Data</label><br> 
        <input type="checkbox" id="rtag_analytics" name="rtags[]" value="Analytics"><label for="rtag_analytics">Analytics</label><br> 
        <input type="checkbox" id="rtag_statistics" name="rtags[]" value="Statistics"><label for="rtag_statistics">Statistics</label><br> 
        <input type="checkbox" id="rtag_ecommerce" name="rtags[]" value="E-commerce"><label for="rtag_ecommerce">E-Commerce</label><br> 
        <input type="checkbox" id="rtag_database" name="rtags[]" value="Database"><label for="rtag_database">Database</label><br> 
        <input type="checkbox" id="rtag_tools" name="rtags[]" value="Tools"><label for="rtag_tools">Tools</label><br> 
        <input type="checkbox" id="rtag_legal" name="rtags[]" value="Legal"><label for="rtag_legal">Legal</label><br> 
        <input type="checkbox" id="rtag_government" name="rtags[]" value="Government"><label for="rtag_government">Government</label><br> 
        </div>
        <div class="right_column">
        <input type="checkbox" id="rtag_news" name="rtags[]" value="News"><label for="rtag_news">News</label><br>
        <input type="checkbox" id="rtag_patents" name="rtags[]" value="Patents"><label for="rtag_patents">Patents</label><br>
        <input type="checkbox" id="rtag_drugs" name="rtags[]" value="Drugs"><label for="rtag_drugs">Drugs</label><br>
        <input type="checkbox" id="rtag_" name="rtags[]" value=""><label for="rtag_"></label><br>
        <input type="checkbox" id="rtag_" name="rtags[]" value=""><label for="rtag_"></label><br>
        <input type="checkbox" id="rtag_" name="rtags[]" value=""><label for="rtag_"></label><br>
        <input type="checkbox" id="rtag_" name="rtags[]" value=""><label for="rtag_"></label><br>
        <input type="checkbox" id="rtag_" name="rtags[]" value=""><label for="rtag_"></label><br>
        <input type="checkbox" id="rtag_" name="rtags[]" value=""><label for="rtag_"></label><br>
        <input type="checkbox" id="rtag_" name="rtags[]" value=""><label for="rtag_"></label><br>
        <input type="checkbox" id="rtag_" name="rtags[]" value=""><label for="rtag_"></label><br>
        <input type="checkbox" id="rtag_" name="rtags[]" value=""><label for="rtag_"></label><br>
        </div>
        <textarea name="notes" rows="5" cols="20" placeholder="Notes"></textarea><br>
        <input style="width:55px;" type="submit" name="submit" value="Add">
    </form>

<?php $filter_tag1 = "Health"; $filter_tag2 = "Science";
    include 'test_mysqlconnect.php';
    if (isset($_POST['submit'])) {include 'test_submit_research_link.php';}
?>
</section>
    
<section class="top-line">
    <div class="top-line-content">
    Select tags: Health > Science > Business > Medicine > Data > Analytics > Statistics > E-Commerce > Database > Tools > Legal > Government > News > Patents > Drugs
    </div>
</section>
    
<!--TEST CODE-------------------------------------------------------------------------->

<!--results table---------------------------------------------------------------------->
<section id="results_table">
<?php $sql_linking_tables = 
"SELECT b.*, t.*
FROM rbm_rtag_map bt, rbookmarks b, rtags t
WHERE bt.rbm_map_id = b.rbm_id
AND bt.rtag_map_id = t.rtag_id
GROUP BY b.rbm_id";
$result_linking_tables = $connection->query($sql_linking_tables);

$sql_tags = 
"SELECT b.rbm_id, t.rtag_name
FROM rbm_rtag_map bt, rbookmarks b, rtags t
WHERE bt.rtag_map_id = t.rtag_id
AND bt.rbm_map_id = b.rbm_id";
$result_tags = $connection->query($sql_tags);
    
if ($result_linking_tables->num_rows > 0) {?>
    <table id="link_output">
        <tr>
            <th class="title">Title</th>
            <th class="tags">Tags</th>
            <th class="notes">Notes</th>
            <th class="delete">Delete</th>
        </tr><?php
    
    
        //BEGIN TO POPULATE THE ROWS
        while($row = mysqli_fetch_assoc($result_linking_tables)) {
            //DECLARE TITLE FOR TITLE CELL
            if (!empty($row["rbm_title"])) {
                $rowname = $row["rbm_title"];
            } elseif (empty($row["rbm_title"]) && !empty($row["rbm_url"])) {
                $rowname = $row["rbm_url"];
            } else {
                $rowname = "null";
            }
            
            //DISPLAY TITLE
            echo "<tr><td><a href=\"" . $row["rbm_url"] . 
            "\" class=\"bookmark\" target=\"_blank\">
            <img src=\"http://www.google.com/s2/favicons?domain=" . 
            $row['rbm_url'] . "\" height=\"16\" width=\"16\"> " . 
            $rowname . 
            "</a></td>";
            
            //DISPLAY THE TAGS
            echo "<td style=\"text-align:center;\">";                      
            
            $rbm_id = $row['rbm_id'];
            
            $sql_tag_map =
            "SELECT bt.rmap_id, b.rbm_id, t.rtag_name 
            FROM rbm_rtag_map bt, rbookmarks b, rtags t
            WHERE bt.rtag_map_id = t.rtag_id
            AND bt.rbm_map_id = b.rbm_id
            AND b.rbm_id = $rbm_id";
            $result_tag_map = $connection->query($sql_tag_map);
            
            while ($tagrow = mysqli_fetch_assoc($result_tag_map)) {
                echo $tagrow['rtag_name'];
            }
            
            //DISPLAY NOTES
            echo "<td>" . $row["rbm_notes"] . "</td>";
            echo "<td>delete</td></tr>";
        }
        echo "</table>";
} else {
    echo "0 results";
}
    
    
    
$connection->close();
?>    

</section>
    
</div>
    
<form id="filter_tags" method="get">
    <input type="checkbox">
</form>
    
</div>

</body>
</html>