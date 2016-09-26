<?php session_start(); 
unset($_SESSION['edit_bmID']);
$_SESSION['table'] = "r";
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
//CODE TO PROCESS BOOKMARK DELETION IF REQUESTED//////////////
include 'lib/delete_bookmark.php';    
    
//PAGE HEADER////////////////
include 'lib/header.php';
?>


<nav>    
    <ul id="navbar">
        <li class="navbutton"><a class="navlink" href="index.php">Home</a></li>
        <li class="navbutton"><a class="navlink" href="alex.php">Alex</a></li>
        <li class="navbutton"><a class="navlink" href="freelance.php">About Freelance</a></li>
        <li class="navbutton"><a class="navlink active" href="research.php" class="active">Do Research</a></li>
        <li class="currentpage">Research URLs</li>
    </ul>
</nav> 
    

<div id="page-wrap">    
    <section id="side-panel">  
        <?php //INCLUDE ADD LINK FORM////////////////
        include 'lib/add_link_form.php';
        include 'lib/filter_by_tag.php';?>
    </section>


    <?php if (isset($_POST['submit'])) {include 'lib/process_submit.php';} ?>


    <section id="top-line">
        <div id="top-line-content">
            Find ► <input type="search" />
        </div>
    </section>


    <section id="results_table">
        <?php include 'lib/results_table.php';
        $connection->close();
        ?>
    </section>   
</div>
    
</body>
</html>