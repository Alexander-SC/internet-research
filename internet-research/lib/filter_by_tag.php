    <div id="filter-by-tag">
        <form id="filter-tags" method="get" action="<?php echo $pagename;?>">
            <ul>
                <?php
                $sql_tag_table = 
                "SELECT *
                FROM $table_tags t
                ORDER BY t.tagName";
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