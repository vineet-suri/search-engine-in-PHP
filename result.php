<!DOCTYPE html>
<html lang="en">
<head>
    <title>Result Page</title>
    <style type="text/css">
.results {margin-left:12%; margin-right:12%; margin-top:10px;}
</style>
</head>

<body bgcolor="#F5DEB3">
		
<form action="result.php" method="GET"> 
		
		<span><b>Write your Keyword:</b></span>
		
		<input type="text" name="user_query" size="120"/> 
		<input type="submit" name="search" value="Search Now">
</form>
<a href="search.html"><button>Go Back</button></a>
    
<?php
    $conn = mysqli_connect("localhost", "root", "");
    mysqli_select_db($conn, "search");

    // echo "inside function";

    if(isset($_GET['search'])){
        // echo "inside get function";

        $get_value = $_GET['user_query'];

        if(!$get_value){
            echo "<script> alert('enter something to search!')</script>";
            exit();
        }

        $result = mysqli_query($conn, "select * from sites where site_keywords like '%$get_value%'");

        if(mysqli_num_rows($result)<1){
            echo "<center><b>No results found</b></center>";
        }

        while($row_result = mysqli_fetch_array($result)){
            $site_title=$row_result['site_title'];
            $site_link=$row_result['site_link'];
            $site_desc=$row_result['site_desc'];
            $site_image=$row_result['site_image'];
        
        echo "<div class='results'>
            
            <h2>$site_title</h2>
            <a href='$site_link' target='_blank'>$site_link</a>
            <p align='justify'>$site_desc</p> 
            <img src='images/$site_image' width='100' height='100' />
            
            </div>";
        }


    }


?>
</body>
</html>

