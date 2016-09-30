<?php session_start(); 
unset($_SESSION['edit_bmID']);
$_SESSION['table'] = "f";
$pagename = htmlentities($_SERVER['PHP_SELF']);
include 'lib/mysqlconnect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Alex Toneka's Freelance URLs</title>
    <?php include 'styles.php';?>
</head>  
<body>
    

<?php
//CODE TO PROCESS BOOKMARK DELETION IF REQUESTED
include 'lib/delete_bookmark.php';    
    
//PAGE HEADER
include 'lib/header.php';
?>
    
    
<nav>  
    <ul id="main-nav">
        <li class="navbutton1"><a class="navlink1" href="index.php">Home</a></li>
        <li class="navbutton1"><a class="navlink1" href="alex.php">Alex</a></li>
        <li class="navbutton1"><a class="navlink1 active1" href="freelance.php">About Freelance</a></li>
        <li class="navbutton1"><a class="navlink1" href="research.php">Do Research</a></li>
        <li class="currentpage1">Freelance URLs</li>
    </ul>
    
    <ul id="saved-lists">
        <li class="navbutton2 nav-collections">Collections ► </li>
        <li class="navbutton2"><a class="navlink2" href="alex.php?filter%5B%5D=2&filter%5B%5D=3&filter-submit=Filter">Job Searches</a></li>
        <li class="navbutton2"><a class="navlink2" href="">Antiques at Park Row</a></li>
        <li class="navbutton2"><a class="navlink2" href="alex.php?filter%5B%5D=2&filter%5B%5D=3&filter-submit=Filter">Project #2</a></li>
        <li class="search-box">Find ► <input type="search" /></li>
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