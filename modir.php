<html>
    <head>
    <title>Add or Delete Page</title>
    </head>
<body>
<?php
echo "<a href='signout.php'>Signout</a>"."<br/>";
if(isset($_COOKIE["signedin"]) && $_COOKIE["signedin"]=='1'){
    if($_COOKIE["acclevel"] == "1")
        header('Location: karshenas.php');
}
else{
    header('Location: view.php');
}
if(isset($_POST["searchbook"]) && isset($_POST["searchwriter"]) && isset($_POST["option"]) && $_POST["searchbook"] && $_POST["searchwriter"] && $_POST["option"] ){
    $bname = $_POST["searchbook"];
    $wname = $_POST["searchwriter"];
    $con = mysqli_connect("localhost", "root", "", "my_db");
    if (!$con){
        die("Could not connect.");
    }
    if($_POST['option'] == "A"){
        $q1 = mysqli_query($con, "INSERT INTO books values('$bname','$wname')");
        echo $bname." from ".$wname." is added."."<br/>";
        
    }
    else{
        $q1 = mysqli_query($con, "SELECT * from books WHERE bookName='$bname' and writer='$wname'");
        if(mysqli_num_rows($q1) == 0){
            echo "Could not find."."<br/>";
        }
        else{
            $q2 = mysqli_query($con, "DELETE from books WHERE bookName='$bname' and writer='$wname'");
            echo $bname." from ".$wname." is deleted."."<br/>";
        }
    }
    mysqli_close($con);
}
else if(isset($_POST["searchbook"]) && isset($_POST["option"]) && $_POST["searchbook"] && $_POST["option"]){
    $bname = $_POST["searchbook"];
    $con = mysqli_connect("localhost", "root", "", "my_db");
    if (!$con){
        die("Could not connect.");
    }
    if($_POST['option'] == "A"){
        echo "Enter writer name."."<br/>";
    }
    else{
        $q1 = mysqli_query($con, "SELECT * from books WHERE bookName='$bname'");
        $wname = "";
        if(mysqli_num_rows($q1) == 0){
            echo "Could not find."."<br/>";
        }
        while($row = mysqli_fetch_array($q1)){
            $wname = $row["writer"];
            echo $bname." from ".$wname." is deleted."."<br/>";
        }
        
        $q2 = mysqli_query($con, "DELETE from books WHERE bookName='$bname'");
    }
    mysqli_close($con);

}
else if(isset($_POST["searchwriter"]) && isset($_POST["option"]) && $_POST["searchwriter"] && $_POST["option"]){
    $wname = $_POST["searchwriter"];
    $con = mysqli_connect("localhost", "root", "", "my_db");
    if (!$con){
        die("Could not connect.");
    }
    if($_POST['option'] == "A"){
        echo "Enter book name."."<br/>";
        
    }
    else{
        $q1 = mysqli_query($con, "SELECT * from books WHERE writer='$wname'");
        $bname = "";
        if(mysqli_num_rows($q1) == 0){
            echo "Could not find."."<br/>";
        }
        while($row = mysqli_fetch_array($q1)){
            $bname = $row["bookName"];
            echo $bname." from ".$wname." is deleted."."<br/>";
        }
        $q2 = mysqli_query($con, "DELETE from books WHERE writer='$wname'");
    }
    mysqli_close($con);
}
else{
    echo "Enter book name or writer name to add or delete."."<br/>";
}
?>
<body>
<form action="modir.php" method="POST">
<input type="text" name="searchbook" placeholder="Enter book name..."><br/>
<input type="text" name="searchwriter" placeholder="Enter writer name..."><br/>
<input name='option' type='radio' value='A'>Add Book<br/>
<input name='option' type='radio' value='B'>Delete Book<br/>
<input type="submit" value="DONE">
</form>
</body>
</html>
