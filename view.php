<html>
    <head>
    <title>View Page</title>
    </head>
<body>

<?php

if(isset($_COOKIE["signedin"]) && $_COOKIE["signedin"] == '1')
{
    if($_COOKIE["acclevel"] == "1")
        header('Location: karshenas.php');
    else
        header('Location: modir.php');
    //echo "<h5>Welcome " . $_COOKIE["username"] . "</h5>";
    //echo "<a href='signout.php'>SignOut</a><br/><br/>";
    
}
else{
    echo "<a href='signIn.php'>Sign in</a><br/><br/>";
}

if(isset($_POST["searchbook"]) && isset($_POST["searchwriter"]) && $_POST["searchbook"] && $_POST["searchwriter"]){
    $bname = $_POST["searchbook"];
    $wname = $_POST["searchwriter"];
    $con = mysqli_connect("localhost", "root", "", "my_db");
    if (!$con){
        die("Could not connect.");
    }
    $q = mysqli_query($con, "SELECT * from books WHERE bookName like '%$bname%' and writer like '%$wname%'");
    if(mysqli_num_rows($q) == 0){
        echo "Could not find."."<br/>";
    }
    while($row = mysqli_fetch_array($q)){
        echo $row['bookName'];
        echo "<br />";
    }
    mysqli_close($con);
}
else if(isset($_POST["searchbook"]) && $_POST["searchbook"]){
    $bname = $_POST["searchbook"];
    $con = mysqli_connect("localhost", "root", "", "my_db");
    if (!$con){
        die("Could not connect.");
    }
    $q = mysqli_query($con, "SELECT * from books WHERE bookName like '%$bname%'");
    if(mysqli_num_rows($q) == 0){
        echo "Could not find."."<br/>";
    }
    while($row = mysqli_fetch_array($q)){
        echo $row['bookName'];
        echo "<br />";
    }
    mysqli_close($con);

}
else if(isset($_POST["seacrhwriter"]) && $_POST["searchwriter"]){
    $wname = $_POST["searchwriter"];
    $con = mysqli_connect("localhost", "root", "", "my_db");
    if (!$con){
        die("Could not connect.");
    }
    $q = mysqli_query($con, "SELECT * from books WHERE writer like '%$wname%'");
    if(mysqli_num_rows($q) == 0){
        echo "Could not find."."<br/>";
    }
    while($row = mysqli_fetch_array($q)){
        echo $row['bookName'];
        echo "<br />";
    }
    mysqli_close($con);

}
else{
    echo "Enter book name or writer name to seacrh."."<br/>";
}
?>

<form action="view.php" method="POST">
<input type="text" name="searchbook" placeholder="Enter book name..."><br/>
<input type="text" name="searchwriter" placeholder="Enter writer name..."><br/>
<input type="submit" value="Search">
</form>
</body>
</html>