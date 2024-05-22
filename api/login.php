<?php
session_start();
include("connect.php");
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$role = $_POST['role'];

$check = mysqli_query($connect, "SELECT * FROM user WHERE mobile='$mobile' AND password='$password' AND role='$role'");
if (!$check) {
    die("Query failed: " . mysqli_error($connect));
}

if (mysqli_num_rows($check) > 0) {
    $userdata = mysqli_fetch_array($check);
    
    // Verify the password (assuming it's stored securely in the database)
    if ($userdata['password'] === $password) {
        $groups = mysqli_query($connect, "SELECT * FROM user WHERE role=2");
        $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
        
        $_SESSION['userdata'] = $userdata;
        $_SESSION['groupsdata'] = $groupsdata;
        
        // Redirect the user to the dashboard
        header("Location: ../routes/dashboard.php");
        exit;
    } else {
        // Password doesn't match
        echo '
            <script>
                alert("Invalid credentials or User not found!");
                window.location = "../";
            </script>
        ';
    }
} else {
    // User not found
    echo '
        <script>
            alert("Invalid credentials or User not found!");
            window.location = "../";
        </script>
    ';
}

?>