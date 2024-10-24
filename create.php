<?php



require('./Database.php');



if(isset($_POST['create'])){

    $Fname = $_POST['Fname'];

    $Mname = $_POST['Mname'];

    $Lname = $_POST['Lname'];



    $querryCreate = "INSERT INTO user VALUES (null, '$Fname', '$Mname', '$Lname')";

    $sqlCreate = mysqli_query($connection, $querryCreate);



    echo '<script>alert("Successfully Created")</script>';

    echo '<script>window.location.href = "/TRICIA3B/Index.php"</script>';

}



?>