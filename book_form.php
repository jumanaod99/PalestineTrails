<?php
 $connection=mysqli_connect('localhost','root','','book_db');

 if(isset($_POST['send']))
 {
    $name= $_POST['name'];
    $number=$_POST['number'];
    $date= $_POST['date'];
    $place= $_POST['place'];

    $request="insert into book_form(name,	number,date,place	) values
     ('$name' ,'$number','$date','$place')";

     mysqli_query($connection,$request);

     header('location:index.php');
 }

 else{
    echo'something went wrong, please try again';
 }


?>