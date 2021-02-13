<html>
    <head>
    <title>Edit Page</title>
    </head>
<body>
<?php
echo "<a href='signout.php'>Signout</a>"."<br/>";
if(isset($_COOKIE["signedin"]) && $_COOKIE["signedin"]=='1'){
    if($_COOKIE["acclevel"] == "2")
        header('Location: modir.php');
}
else{
    header('Location: view.php');
}
if(isset($_POST["searchbook"]) && isset($_POST["searchwriter"]) && $_POST["searchbook"] && $_POST["searchwriter"]){
    if(isset($_POST["editbook"]) && isset($_POST["editwriter"]) && $_POST["editbook"] && $_POST["editwriter"]){
        $bname = $_POST["searchbook"];
        $wname = $_POST["searchwriter"];
        $nbname = $_POST["editbook"];
        $nwname = $_POST["editwriter"];
        $con = mysqli_connect("localhost", "root", "", "my_db");
        if (!$con){
            die("Could not connect.");
        }
        $q1 = mysqli_query($con, "SELECT * from books WHERE bookName='$bname' and writer='$wname'");
        if(mysqli_num_rows($q1) == 0){
            echo "Could not find."."<br/>";
        }
        else{
            $oldbname="";
            $oldwname="";
            $newbname="";
            $newwname="";
            while($row1 = mysqli_fetch_array($q1)){
                $oldbname = $row1['bookName'];
                $oldwname = $row1['writer'];
            }
            $q2 = mysqli_query($con, "UPDATE books SET bookName='$nbname',writer='$nwname' where bookName='$bname' and writer='$wname'");
            $q3 = mysqli_query($con, "SELECT * from books WHERE bookName='$nbname' and writer='$nwname'");
            while($row2 = mysqli_fetch_array($q3)){
                $newbname = $row2['bookName'];
                $newwname = $row2['writer'];
            }
            echo $oldbname." from ".$oldwname." changed to ".$newbname." from ".$newwname."<br/>";
        }
        mysqli_close($con);
    }
    else{
        echo "Enter new book name and new writer name."."<br/>";
    }
}
else if(isset($_POST["searchbook"]) && $_POST["searchbook"]){
    if(isset($_POST["editbook"]) && $_POST["editbook"]){
        $bname = $_POST["searchbook"];
        $nbname = $_POST["editbook"];
        $con = mysqli_connect("localhost", "root", "", "my_db");
        if (!$con){
            die("Could not connect.");
        }
        $q1 = mysqli_query($con, "SELECT * from books WHERE bookName='$bname' ");
        if(mysqli_num_rows($q1) == 0){
            echo "Could not find."."<br/>";
        }
        $oldbname="";
        $newbname="";
        while($row1 = mysqli_fetch_array($q1)){
            $oldbname = $row1['bookName'];
        }
        $q2 = mysqli_query($con, "UPDATE books SET bookName='$nbname' where bookName='$bname'");
        $q3 = mysqli_query($con, "SELECT * from books WHERE bookName='$nbname'");
        while($row2 = mysqli_fetch_array($q3)){
            $newbname = $row2['bookName'];
        }
        echo $oldbname." changed to ".$newbname."<br/>";
        mysqli_close($con);
    }
    else{
        echo "Enter new book name."."<br/>";
    }

}
else if(isset($_POST["searchwriter"]) && $_POST["searchwriter"]){
    if(isset($_POST["editwriter"]) && $_POST["editwriter"]){
        $wname = $_POST["searchwriter"];
        $nwname = $_POST["editwriter"];
        $con = mysqli_connect("localhost", "root", "", "my_db");
        if (!$con){
            die("Could not connect.");
        }
        $q1 = mysqli_query($con, "SELECT * from books WHERE writer='$wname'");
        if(mysqli_num_rows($q1) == 0){
            echo "Could not find."."<br/>";
        }
        $oldwname="";
        $newwname="";
        while($row1 = mysqli_fetch_array($q1)){
            $oldwname = $row1['writer'];
        }
        $q2 = mysqli_query($con, "UPDATE books SET writer='$nwname' where writer='$wname'");
        $q3 = mysqli_query($con, "SELECT * from books WHERE writer='$nwname'");
        while($row2 = mysqli_fetch_array($q3)){
            $newwname = $row2['writer'];
        }
        echo $oldwname." changed to ".$newwname."<br/>";
    }
    else{
        echo "Enter new writer name."."<br/>";
    }

}
else{
    echo "Enter book name or writer name to edit."."<br/>";
}
?>
<body>
<form action="karshenas.php" method="POST">
<input type="text" name="searchbook" placeholder="Enter book name..."><br/>
<input type="text" name="editbook" placeholder="Enter NEW book name..."><br/>
<input type="text" name="searchwriter" placeholder="Enter writer name..."><br/>
<input type="text" name="editwriter" placeholder="Enter NEW writer name..."><br/>
<input type="submit" value="Edit">
</form>
</body>
</html>