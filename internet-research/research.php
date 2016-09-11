<?php session_start(); include 'mysqlconnect.php';?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Alex Toneka's Research URLs</title>
    <?php include 'styles.php';?>
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
        <li><a href="index.php">Frequently Used</a></li>
        <li><a href="freelance.php">About Freelance</a></li>
        <li><a href="research.php" class="active">Do Research</a></li>
    </ul>
</nav> 

<div id="main_wrap">
    
<section id="add_link_form">    
    <form action="research.php" method="post">
        <br>ADD LINK<br>
        <input class="titleurl" type="text" name="name" placeholder="Title"autofocus>
        <input class="titleurl" type="text" name="url" placeholder="URL">

        
<!--CHECKBOXES LEFT COLUMN----------------------------------------------------------->
        <div class="left_column">
        <?php
        $sql_tag_table = 
        "SELECT *
        FROM rtags t";
        $result_tag_table = $connection->query($sql_tag_table);
            
        $result_biggest_tag_id = $connection->query(
        "SELECT rtag_id
        FROM rtags
        ORDER BY rtag_id DESC
        LIMIT 1");

        $row = $result_biggest_tag_id->fetch_assoc();
        $half_biggest_id = round($row['rtag_id'] / 2);
            
        while ($tag_row_array = mysqli_fetch_assoc($result_tag_table)) {
            foreach ($tag_row_array as $key=>$value) {
                if (is_numeric($value)) {
                    $id = $value;
                } elseif (!is_numeric($value)) {
                    if ($id <= $half_biggest_id) {     //MAXIMUM NUMBER OF FIELDS IN LEFT COLUMN
                        echo 
                        "<input type=\"checkbox\" id=\"rtag_$value\" 
                        name=\"rtags[]\" value=\"$id\">
                        <label for=\"rtag_$value\">$value</label><br>";
                    } else {
                        //CHECKBOXES RIGHT COLUMN
                        echo "</div><div class=\"right_column\">";
                        while ($tag_row_array_right = mysqli_fetch_assoc($result_tag_table)) {
                            foreach ($tag_row_array_right as $key=>$value) {
                                if (is_numeric($value)) {
                                    $id = $value;
                                } elseif (!is_numeric($value) && $id > 5) {
                                    echo
                                    "<input type=\"checkbox\" id=\"rtag_$value\" 
                                    name=\"rtags[]\" value=\"$id\">
                                    <label for=\"rtag_$value\">$value</label><br>";
                                }
                            }
                        }
                        echo "</div>";  //END RIGHT COLUMN
                    }
                }
            }
        }
?>
        <textarea name="notes" rows="5" cols="40" placeholder="Notes" style="clear:left; margin-top:5px;"></textarea><br>
        <input style="width:55px;" type="submit" name="submit" value="Add">        
    </form>

<?php if (isset($_POST['submit'])) {include 'submit_research_link.php';} ?>
    
</section>
    
<section class="top-line">
    <div class="top-line-content">
    Select tags: Health > Science > Business > Medicine > Data > Analytics > Statistics > E-Commerce > Database > Tools > Legal > Government > News > Patents > Drugs
    </div>
</section>

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
                echo $tagrow['rtag_name'] . "--";
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