<?php session_start(); 
if (isset($_GET['table_prefix'])) {
    $_SESSION['table'] = $_GET['table_prefix'];
}
if (isset($_GET['edit_bmID'])) {
    $_SESSION['edit_bmID'] = $_GET['edit_bmID'];
}
$pagename = htmlentities($_SERVER['PHP_SELF']);

include 'lib/mysqlconnect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Alex Toneka's Research URLs</title>
    <?php include 'styles.php';?>
</head>  
<body>
 
    
<?php
//CODE TO PROCESS BOOKMARK DELETION IF REQUESTED
include 'lib/delete_bookmark.php';    
    
//PAGE HEADER
include 'lib/header.php';
    
//PROCESSING PAGE
if (isset($_POST['submit'])) {include 'lib/process_edit.php';}
?>

    
<nav>  
    <ul id="main-nav">
        <li class="navbutton1"><a class="navlink1" href="index.php">Home</a></li>
        <li class="navbutton1"><a class="navlink1" href="alex.php">Alex</a></li>
        <li class="navbutton1"><a class="navlink1" href="freelance.php">About Freelance</a></li>
        <li class="navbutton1"><a class="navlink1" href="research.php">Do Research</a></li>
        <li class="navbutton1"><a class="navlink1 active1" href="edit.php">Edit Bookmark</a>
        <li class="currentpage1">Edit bookmark</li>
    </ul>
    
    <ul id="saved-lists">
        <li class="navbutton2 nav-collections">Collections ► </li>
        <li class="navbutton2"><a class="navlink2" href="alex.php?filter%5B%5D=2&filter%5B%5D=3&filter-submit=Filter">Desteni</a></li>
        <li class="navbutton2"><a class="navlink2" href="">Web Dev</a></li>
        <li class="navbutton2"><a class="navlink2" href="alex.php?filter%5B%5D=2&filter%5B%5D=3&filter-submit=Filter">Monies</a></li>
        <li class="search-box">
            <?php if (isset($output_message)) {echo $output_message;};?>
            Edit bookmark #<?php echo $_SESSION['edit_bmID'];?> ► 
            (in table "<?php echo $_SESSION['table'];?>") 
        </li>
    </ul>
</nav>   
    
    
<div id="page-wrap">    
    <section id="side-panel">  
        <?php //INCLUDE EDIT LINK FORM/////
        include 'lib/edit_link_form.php';
        ?>
    </section>


    <section id="top-line">
        <div id="top-line-content">
        </div>
    </section>


    <section id="results_table">
        <?php include 'lib/results_table.php';
        $connection->close();
        ?>
    </section>   
</div>
    
<?php include 'lib/footer.php'; ?>
    
</body>
</html>