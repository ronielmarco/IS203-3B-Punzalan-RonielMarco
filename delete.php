<?php



require('./Database.php');



if(isset($_POST['delete'])) {

    $deleteId = $_POST['deleteID'];



    $querrydelete ="DELETE FROM studenttbl1 WHERE ID = $deleteId";

    $sqldelete = mysqli_query($connection,$querrydelete);



    echo'<script>alert("successfully Deleted")</script>';

    echo '<script>window.location.href = "/TRICIA3B/Index.php"</script>';

}



?>