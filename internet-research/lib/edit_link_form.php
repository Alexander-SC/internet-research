<?php

//GET AND STORE TITLE, URL, SHORTDESC, NOTES
$sql_row_to_edit = 
    "SELECT b.*
    FROM $table_bm b
    WHERE b.bmID = '" . $_SESSION['edit_bmID'] . "'";
$result_row_to_edit = $connection->query($sql_row_to_edit);

while($row = mysqli_fetch_assoc($result_row_to_edit)) {
    $title = $row['bmTitle'];
    $url = $row['bmURL'];
    $shortdesc = $row['bmShortDesc'];
    $notes =$row['bmNotes'];
}

?>




<div id="add-link-form">    
    <form action="<?php echo $pagename;?>" method="post" autocomplete="off">
        
        <br>Edit bookmark<br>
        <input class="add-link-input" type="text" name="name" value="<?php echo $title;?>" autofocus>
        <input class="add-link-input highlight" type="text" name="url" value="<?php echo $url;?>">
        <input class="add-link-input" type="text" name="shortdesc" value="<?php echo $shortdesc;?>">
        
        <br>Add new tag:
        <input class="short add-link-input" type="text" name="newtag" placeholder="Enter new tag"><br />

            
        <div class="left_column">
        <?php
        $sql_tag_table = 
        "SELECT *
        FROM $table_tags t
        ORDER BY tagName";
        $result_tag_table = $connection->query($sql_tag_table);
        $counter = 0;   
        $divider = (ceil($result_tag_table->num_rows) / 2) + 2;     

        while ($tag_row_array = mysqli_fetch_assoc($result_tag_table)) {
            $counter++;                
                
            foreach ($tag_row_array as $key=>$value) {
                    
                if (is_numeric($value)) {
                    $id = $value;
                        
                } elseif (!is_numeric($value)) {
                            
                    if ($counter <= $divider) {
                            
                        //BEGIN LEFT COLUMN
                        echo 
                        "<input type=\"checkbox\" class=\"taglist\" id=\"tag_$value\" name=\"tags[]\" value=\"$id\">
                        <label class=\"taglabel\" for=\"tag_$value\">$value</label><br>";
                            
                    } else {

                        //BEGIN RIGHT COLUMN
                        echo "</div><div class=\"right_column\">";
                        while ($tag_row_array_right = mysqli_fetch_assoc($result_tag_table)) {
                                
                            foreach ($tag_row_array_right as $key=>$value) {
                                    
                                if (is_numeric($value)) {
                                    $id = $value;
                                        
                                } elseif (!is_numeric($value)) {
                                    echo
                                    "<input type=\"checkbox\" class=\"taglist\" id=\"tag_$value\" 
                                    name=\"tags[]\" value=\"$id\">
                                    <label class=\"taglabel\" for=\"tag_$value\">$value</label><br>";
                                }
                            }
                        }
                        echo "</div>";  //END RIGHT COLUMN
                    }
                }
            }
        }
        ?>
        <input type="text" name="notes" class="add-link-input" style="clear:left; margin-top:5px;" value="<?php echo $notes;?>"><br>
        <input type="submit" class="edit-submit" name="submit" value="">          
    </form>
</div>