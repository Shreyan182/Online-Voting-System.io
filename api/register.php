<?php
include("connect.php");

$name = $_POST['name'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$address = $_POST['address'];
$image = $_FILES['photo']['name'];
$temp_name = $_FILES['photo']['tmp_name'];
$role = $_POST['role'];

if ($password == $cpassword) {
    move_uploaded_file($temp_name, "../uploads/$image");
    $insert = mysqli_query($connect, "INSERT INTO user(name, mobile, address, photo, password, role, status, votes) VALUES('$name', '$mobile', '$address', '$image', '$password', '$role', 0, 0)");
    
    if ($insert) {
        echo '
        <script>
            alert("Registration Successful!");
            window.location = "../";
        </script>
    ';
    } else {
        echo '
            <script>
                alert("Error occurred!");
                window.location = "../routes/register.html";
            </script>
    ';
    }
} else {
    echo '
        <script>
            alert("Password and Confirm Password do not match!");
            window.location = "../routes/register.html";
        </script>
    ';
}
?>