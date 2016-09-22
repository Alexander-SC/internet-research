<?php session_start(); include 'mysqlconnect.php';?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Alex Toneka's Research URLs</title>
    <?php include 'styles.php';?>
</head>  
<body>
<?php
//DELETE BOOKMARK
if (isset($_POST['delete_rbm_id'])) {
    $delete_rbm_id = $_POST['delete_rbm_id'];
    
    $sql_delete_map_id =
    "DELETE FROM rbm_rtag_map
    WHERE rbm_map_id = $delete_rbm_id";    
    
    $sql_delete_rbm_id =
    "DELETE FROM rbookmarks
    WHERE rbm_id = $delete_rbm_id";
         
    if ($connection->query($sql_delete_map_id) === TRUE) {
        if ($connection->query($sql_delete_rbm_id) === TRUE) {
            $deleted_bookmark = "Deleted a bookmark.";
        } else {
            $deleted_bookmark = "Bookmark not deleted...";
        }
    } else {
        $deleted_bookmark = "Entire bookmark + map not deleted.";
    }   
}
?>
    
<div id="all_wrap">    

<header>
    <div style="text-align:center; font-family:AlexBrush; font-size:3.5em; color:#3399ff; font-weight:bold;">Alex Toneka's</div>
    <div style="text-align:center; font-size:1.5em; font-weight:bold; color:#4d4e53;">-Research URLs-</div>
    <a href="http://localhost/phpmyadmin/" target="_blank" style="float:right;">phpMyAdmin</a>
</header>
    
<!--navigation---------------------------------------------------------------------->
<nav style="clear:right;">    
    <ul id="navbar">
        <li class="navbutton"><a class="navlink" href="index.php">Frequently Used</a></li>
        <li class="navbutton"><a class="navlink" href="freelance.php">About Freelance</a></li>
        <li class="navbutton"><a class="navlink active" href="research.php" class="active">Do Research</a></li>
    </ul>
</nav> 

<section id="side-panel">    
    <div id="add-link-form">    
        <form action="research.php" method="post">
            <br>ADD LINK<br>
            <input class="titleurl" type="text" name="name" placeholder=" Title"autofocus>
            <input class="titleurl" type="text" name="url" placeholder= " URL">
            <br>ADD TAG<br>
            <input class="titleurl" type="text" name="newtag" placeholder=" New tag">        
        <!--CHECKBOX COLUMNS----------------------------------------------------------->
            <div class="left_column">
            <?php
            $sql_tag_table = 
            "SELECT *
            FROM rtags t";
            $result_tag_table = $connection->query($sql_tag_table);
            $rows_divided_by_2 = ($result_tag_table->num_rows) / 2 + 1;    

            while ($tag_row_array = mysqli_fetch_assoc($result_tag_table)) {
                foreach ($tag_row_array as $key=>$value) {
                    if (is_numeric($value)) {
                        $id = $value;
                    } elseif (!is_numeric($value)) {
                        if ($id <= $rows_divided_by_2) {

                            //BEGIN LEFT COLUMN
                            echo 
                            "<input type=\"checkbox\" class=\"taglist\" id=\"rtag_$value\" 
                            name=\"rtags[]\" value=\"$id\">
                            <label for=\"rtag_$value\">$value</label><br>";
                        } else {

                            //BEGIN RIGHT COLUMN
                            echo "</div><div class=\"right_column\">";
                            while ($tag_row_array_right = mysqli_fetch_assoc($result_tag_table)) {
                                foreach ($tag_row_array_right as $key=>$value) {
                                    if (is_numeric($value)) {
                                        $id = $value;
                                    } elseif (!is_numeric($value)) {
                                        echo
                                        "<input type=\"checkbox\" class=\"taglist\" id=\"rtag_$value\" 
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
            <textarea name="notes" rows="5" cols="40" placeholder=" Notes" style="clear:left; margin-top:5px;"></textarea><br>
            <input style="width:55px;" type="submit" name="submit" value="Add">        
        </form>
    </div>

    <div id="filter-by-tag">
    <!--FILTER BY TAG ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
        <form id="filter-tags" method="post" action="research.php">
            <ul>
                <?php
                $sql_tag_table = 
                "SELECT *
                FROM rtags t";
                $result_tag_table = $connection->query($sql_tag_table);

                while ($tag_row_array = mysqli_fetch_assoc($result_tag_table)) {
                    foreach ($tag_row_array as $key=>$value) {
                        if (is_numeric($value)) {
                            $id = $value;
                        } elseif (!is_numeric($value)) {
                            echo
                            "<li class=\"filter-tags\">
                            <input type=\"checkbox\" class=\"filter-tag-checkbox\" id=\"filter_$value\" 
                            name=\"filter-tags[]\" value=\"$id\">";
                            echo
                            "<label class=\"filter-tag-label\" for=\"filter_$value\">$value</label></li>";
                        }
                    }
                }?>
            </ul>
            <input type="submit" name="filter-submit" value="Filter">
        </form>
        
    </div>
</section>
    
<?php if (isset($_POST['submit'])) {include 'submit_research_link.php';} ?>
       
<section id="top-line">
    <div id="top-line-content">
        <?php if (!empty($_POST['filter-tags'])) {
            $filterTags = $_POST['filter-tags'];
            foreach($filterTags as $filterTag) {
                echo $filterTag;
            }
        }?>
    </div>
</section>

<!--RESULTS TABLE |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<section id="results_table">
<?php $sql_linking_tables = 
"SELECT b.*, t.*, bt.*
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

if ($result_linking_tables->num_rows > 0) {
    if (isset($deleted_bookmark)) {
        echo $deleted_bookmark . "<br>";
    }
    echo "<table id=\"link_output\">";?>
        <thead>
        <tr>
            <th class="title" aria-sort="descending">Title</th>
            <th class="tags">Tags</th>
            <th class="notes">Notes</th>
            <th class="delete">X</th>
        </tr>
        </thead>
        
        <?php echo "<tbody>";   
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
            echo "<td class=\"alight-left\">";                                  
            $rbm_id = $row['rbm_id'];
            
            $sql_tag_map =
            "SELECT bt.rmap_id, b.rbm_id, t.rtag_name 
            FROM rbm_rtag_map bt, rbookmarks b, rtags t
            WHERE bt.rtag_map_id = t.rtag_id
            AND bt.rbm_map_id = b.rbm_id
            AND b.rbm_id = $rbm_id";
            $result_tag_map = $connection->query($sql_tag_map);
            
            while ($tagrow = mysqli_fetch_assoc($result_tag_map)) {
                //echo $tagrow['rtag_name'] . " • ";
                echo "<span class=\"tagDisplay\">$tagrow[rtag_name]</span>";
            }
            
            //DISPLAY NOTES
            echo "<td>" . $row["rbm_notes"] . "</td>";
            
            //DELETE BUTTON
            $delete_rbm_id = $row['rbm_id'];
            echo "<td>
            <form method=\"post\" action=\"research.php\">
                <input type=\"hidden\" name=\"delete_rbm_id\" value=\"$delete_rbm_id\">
                <input type=\"submit\" class=\"delete-x\" value=\"X\">
            </form>
            </td></tr>";
        }
        echo "</tbody></table>";
} else {
    echo "0 results";
}
$connection->close();
?>
</section>    
</div>
</body>
</html>