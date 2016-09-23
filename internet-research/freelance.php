<?php session_start(); include 'mysqlconnect.php';?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Alex Toneka's Freelance URLs</title>
    <?php include 'styles.php';?>
</head>  
<body>
    
<!--DELETE BOOKMARK-->
<?php
if (isset($_POST['delete_bmID'])) {
    $delete_bmID = $_POST['delete_bmID'];
    
    $sql_delete_mapID =
    "DELETE FROM f_map
    WHERE bmMapID = $delete_bmID";    
    
    $sql_delete_bmID =
    "DELETE FROM f_bookmarks
    WHERE bmID = $delete_bmID";
         
    if ($connection->query($sql_delete_mapID) === TRUE) {
        if ($connection->query($sql_delete_bmID) === TRUE) {
            $deleted_bookmark = "Deleted a bookmark.";
        } else {
            $deleted_bookmark = "Bookmark not deleted...";
        }
    } else {
        $deleted_bookmark = "Entire bookmark + map not deleted.";
    }   
}
?>
    
    
<header>
    <div id="logo">
        Alex Toneka's
    </div>
</header>
   
    
<nav>  
    <ul id="navbar">
        <li class="navbutton"><a class="navlink" href="index.php">Home</a></li>
        <li class="navbutton"><a class="navlink active" href="freelance.php">About Freelance</a></li>
        <li class="navbutton"><a class="navlink" href="research.php" class="active">Do Research</a></li>
        <li class="currentpage">Freelance URLs</li>
    </ul>
</nav> 
    
    
<div id="page-wrap">    
<section id="side-panel">    
    <div id="add-link-form">    
        <form action="freelance.php" method="post" autocomplete="off">
            <br>New bookmark:
            <input class="add-link-input" type="text" name="name" placeholder=" Title"autofocus>
            <input class="add-link-input highlight" type="text" name="url" placeholder= " URL">
            <input class="add-link-input" type="text" name="shortdesc" placeholder= " Short description/tagline">
            <br>New tag:
            <input class="short add-link-input" type="text" name="newtag" placeholder=" New tag"><br />        
        <!--CHECKBOX COLUMNS----------------------------------------------------------->
            <div class="left_column">
            <?php
            $sql_tag_table = 
            "SELECT *
            FROM f_tags t";
            $result_tag_table = $connection->query($sql_tag_table);
            $divider = ceil($result_tag_table->num_rows + 2) / 2;    

            while ($tag_row_array = mysqli_fetch_assoc($result_tag_table)) {
                foreach ($tag_row_array as $key=>$value) {
                    if (is_numeric($value)) {
                        $id = $value;
                    } elseif (!is_numeric($value)) {
                        if ($id <= $divider) {

                            //BEGIN LEFT COLUMN
                            echo 
                            "<input type=\"checkbox\" class=\"taglist\" id=\"ftag_$value\" 
                            name=\"ftags[]\" value=\"$id\">
                            <label class=\"taglabel\" for=\"ftag_$value\">$value</label><br>";
                        } else {

                            //BEGIN RIGHT COLUMN
                            echo "</div><div class=\"right_column\">";
                            while ($tag_row_array_right = mysqli_fetch_assoc($result_tag_table)) {
                                foreach ($tag_row_array_right as $key=>$value) {
                                    if (is_numeric($value)) {
                                        $id = $value;
                                    } elseif (!is_numeric($value)) {
                                        echo
                                        "<input type=\"checkbox\" class=\"taglist\" id=\"ftag_$value\" 
                                        name=\"ftags[]\" value=\"$id\">
                                        <label class=\"taglabel\" for=\"ftag_$value\">$value</label><br>";
                                    }
                                }
                            }
                            echo "</div>";  //END RIGHT COLUMN
                        }
                    }
                }
            }
            ?>
            <textarea name="notes" class="add-link-input" placeholder=" Notes" style="clear:left; margin-top:5px;"></textarea><br>
            <input style="width:55px; float:right;" type="submit" name="submit" value="Add">        
        </form>
    </div>

    <div id="filter-by-tag">
    <!--FILTER BY TAG ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
        <form id="filter-tags" method="get" action="freelance.php">
            <ul>
                <?php
                $sql_tag_table = 
                "SELECT *
                FROM f_tags t";
                $result_tag_table = $connection->query($sql_tag_table);

                while ($tag_row_array = mysqli_fetch_assoc($result_tag_table)) {
                    foreach ($tag_row_array as $key=>$value) {
                        if (is_numeric($value)) {
                            $id = $value;
                        } elseif (!is_numeric($value)) {
                            echo
                            "<li class=\"filter-tags\">
                            <input type=\"checkbox\" class=\"filter-tag-checkbox\" id=\"filter_$value\" 
                            name=\"filterBy\" value=\"$id\">";
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
    
<?php if (isset($_POST['submit'])) {include 'submit_freelance_link.php';} ?>
       
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
    
<?php 
if (isset($_GET['filterBy'])) {
    $filterBy = $_GET['filterBy'];
    
    $sql_linking_tables = 
    "SELECT b.*, t.*, bt.*
    FROM f_map bt, f_bookmarks b, f_tags t
    WHERE bt.bmMapID = b.bmID
    AND bt.tagMapID = $filterBy
    GROUP BY b.bmID";
} else {
    
    $sql_linking_tables = 
    "SELECT b.*, t.*, bt.*
    FROM f_map bt, f_bookmarks b, f_tags t
    WHERE bt.bmMapID = b.bmID
    AND bt.tagMapID = t.tagID
    GROUP BY b.bmID";
}
$result_linking_tables = $connection->query($sql_linking_tables);

$sql_tags = 
"SELECT b.bmID, t.tagName
FROM f_map bt, f_bookmarks b, f_tags t
WHERE bt.tagMapID = t.tagID
AND bt.bmMapID = b.bmID";
$result_tags = $connection->query($sql_tags);

if ($result_linking_tables->num_rows > 0) {
    if (isset($deleted_bookmark)) {
        echo $deleted_bookmark . "<br>";
    }
    echo "<table id=\"link_output\">";?>
        <thead>
        <tr>
            <th class="title">Title</th>
            <th class="shortdesc">Summary</th>
            <th class="tags">Tags</th>
            <th class="notes">Notes</th>
            <th class="delete">x</th>
        </tr>
        </thead>
        
        <?php echo "<tbody>";   
        //BEGIN TO POPULATE THE ROWS
        while($row = mysqli_fetch_assoc($result_linking_tables)) {
            //DECLARE TITLE FOR TITLE CELL
            if (!empty($row["bmTitle"])) {
                $rowname = $row["bmTitle"];
            } elseif (empty($row["bmTitle"]) && !empty($row["bmURL"])) {
                $rowname = $row["bmURL"];
            } else {
                $rowname = "null";
            }
            
            //DISPLAY TITLE
            echo "<tr><td><a href=\"" . $row["bmURL"] . 
            "\" class=\"bookmark\" target=\"_blank\">
            <img src=\"http://www.google.com/s2/favicons?domain=" . 
            $row['bmURL'] . "\" height=\"16\" width=\"16\"> " . 
            $rowname . "</a></td>";
            
            //DISPLAY SHORT DESCRIPTION
            echo "<td>" . $row["bmShortDesc"] . "</td>";
            
            //DISPLAY THE TAGS
            echo "<td class=\"alight-left\">";                                  
            $bmID = $row['bmID'];
            
            $sql_tag_map =
            "SELECT bt.mapID, b.bmID, t.tagName 
            FROM f_map bt, f_bookmarks b, f_tags t
            WHERE bt.tagMapID = t.tagID
            AND bt.bmMapID = b.bmID
            AND b.bmID = $bmID";
            $result_tag_map = $connection->query($sql_tag_map);
            
            while ($tagrow = mysqli_fetch_assoc($result_tag_map)) {
                echo "<span class=\"tagDisplay\">$tagrow[tagName]</span>";
                //http_build_query()
            }
            
            //DISPLAY NOTES
            echo "<td>" . $row["bmNotes"] . "</td>";
            
            //DELETE BUTTON
            $delete_bmID = $row['bmID'];
            echo "<td>
            <form method=\"post\" action=\"freelance.php\">
                <input type=\"hidden\" name=\"delete_bmID\" value=\"$delete_bmID\">
                <input type=\"submit\" class=\"delete-x\" value=\"x\">
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