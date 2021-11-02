<?php

require_once "config.php";
require_once "session.php";

$host="localhost";
$user="root";
$password="";
$db="demo";
console.log("Message here");

if ($_SERVER["REQUEST_METHOD] == "POST" && isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST["confirm_password"]);
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    
    if($query = $db->prepare("SELECT * FROM users WHERE email = ?")){
        $error = '';
        $query->bind_param('s', $email);
        $query->execute();
        $query->store_result();
        if ($querly->num_rows>0){
            $error.='<p class=error"error">The email address is already registered!</p>';
                    }else{
                        if (strlen($password) <6){
                            $error.='<p class="error">Password must have atleast 6 characters.</p>';
                        }
                        if (empty($confirm_password)){
                        $error .= '<p class="error">Please enter confirm password.</p>';
                        } else {
                            if (empty($error) && ($password != &confirm_password)) {
                                $error .= '<p class="error">Password did not match.</p>';
                            }
                        }
                        if(empty($error)){
                            $insertQuery = $db->prepare("INSERT INTO users (name, email, password) VALUES (?,?,?);");
                            $insertQuery->bind_param("sss",$fullname,$email,$password_hash);
                            $result = $insertQuery->execute();
                            if ($result) {
                                $error .= '<p class="success">Your registration was successful!</p>';
                            } else {
                                $error .= '<p class="error">Somnething went wrong!</p>';
                            }
                        }
                    }
                    
    }
    $query->close();
    $insertQuery->close();
    mysqli_close($db);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shesh.se</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css(bootstrap.min.css">
</head>
<body>
    <div class="main-menu">
        <ul>
            <a href="/.." style="color:black"><li class="menu-item"><i class="fa fa-home "></i> Hem</li></a>
            <a href="/klienttekniker" style="color:black"><li class="menu-item"><i class="fa fa-code "></i> Klienttekniker</li></a>
            <a href="/projektmetodik" style="color:black"><li class="menu-item"><i class="fa fa-tasks "></i> Projektmetodik</li></a>
            <a href="/internet" style="color:black"><li class="menu-item"><i class="fa fa-wifi "></i> Internet</li></a>
            <a href="/tillganglighet" style="color:black;"><li class="menu-item"><i class="fa fa-calendar-check-o "></i> Tillgänglighet</li></a>
            <a href="" style="color:black"><li class="menu-item"><i class="fa fa-check "></i> Analys</li></a>
            <a href="/kontakt" style="color:black"><li class="menu-item"><i class="fa fa-user-circle-o "></i> Kontakt</li></a>
            <li onclick="document.getElementById('id01').style.display='block'" class="menu-item"><i class="fa fa-key"></i> Signup</li>
        </ul>
    </div>
    <!-- The Modal -->
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'"
class="close" title="Close Modal">&times;</span>

    <!--Modal Content -->
  <form class="modal-content animate" action="">
    <div class="imgcontainer">
      <img src="img_avatar2.png" alt="Avatar" class="avatar" style="width:20%;">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Register</h2>
                <p>Please fill this form to create an account.</p>
                <form action="" method="post">
                                <p>Already have an account? <a href="login.php">Login here</a></p>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control" requried>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Confirm Passowrd</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>
                <div class="form-group">
                <button class="submit" name="submit" class="btn btn-primary" value="Submit">
            </div>
            </form>
        </div>

</div>    
</div>
</body> 
</html>
