<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$con = mysqli_connect("127.0.0.1","root","","test");

$post = $_POST;


if (!empty($post["del"])){

  $toDel = $post["del"];

  $sql5 = "delete FROM test where id=?";
  $stmt5 = $con->prepare($sql5);
  $stmt5 ->bind_param("i", $toDel);
  $stmt5->execute();

}

  if (!empty($post["search"])){

    
    $search = $post["search"];

    $sql2 = "SELECT * FROM test where nachname=?";
    $stmt2 = $con->prepare($sql2);
    $stmt2 ->bind_param("s", $search);
    $stmt2->execute();
    $result = $stmt2->get_result();

  }
   if (empty($post["search"])){

    $sql = "SELECT * FROM test";
    $result = $con->query($sql);
  }

 if (!empty($post["fname"])){
    echo "not empty";

    $vorname = $post["fname"];
    $nachname = $post["lname"];
    $age = $post["age"];

    $sql1 = "INSERT INTO test(name, nachname, age) VALUES (?,?, ? )";
    $stmt1 = $con->prepare($sql1);
    $stmt1 ->bind_param("ssi", $vorname, $nachname, $age, );
    $stmt1->execute();
}




/* Non-prepared statement */
//$mysqli->query("select name IF EXISTS test");
//$mysqli->query("CREATE TABLE test(id INT, label TEXT)");


while ($row = mysqli_fetch_assoc($result)) {

  echo  $row["name"] . " <br>";


}

?>

<form action="/addUser.php" method="post">
<input hidden type="text" id="fname" name="del" value="2">
<input type="submit" value="delete">'
</form>

<form action="/addUser.php" method="post">
<input hidden type="text" id="fname" name="del" value="1">
<input type="submit" value="delte">'
</form>

<form action="/addUser.php" method="post">
    <label for="fname">search</label><br>
    <input type="text" id="fname" name="search" value="John"><br>


    <input type="submit" value="Submit">
</form>
