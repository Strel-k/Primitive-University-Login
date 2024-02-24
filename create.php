<script>
        function invalidInput() {
        alert("Invalid Email or Password.");
        }

        function validInput(email) {
            window.location.href = 'view.php?email=' + email;
        }
        function register() {
    window.location.href = 'register.php';
}
        </script>
        
        <?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM login WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['isAdmin'] = $row['isAdmin'];
        $_SESSION['userId'] = $row['id']; 
        $_SESSION['email'] = $row['email'];
    
        header("Location: view.php");
        exit();
    } else {
        echo "<script>invalidInput();</script>";
    }
}

$conn->close();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/create_style.css">

    <title>Login Form | Login Activity</title>
</head>
<body>
    
    <div class="background">
        <br>
        <form method="POST" action="">
        <h1>Login Form</h1>
        <br><br>
        <div class="input-container">
            <h3>Username:</h3>
        <input type="email" name="email" placeholder="Email" required>
        </div>
        <br>
        <div class="input-container">
            <h3>Password:</h3>
        <input type="password" name="password" placeholder="******" required>
        </div>
        <hr style="color:black;">
        <div class="button-container">
        <input type="submit" name="submit">
        <input type="button" value="Register" onclick="register()" style="      background-color:gray;
        font-weight:800;
        color:white;">

        </div>
    </div>
    </form>
   

</body>
</html>
