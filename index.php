<?php 
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="log_in_style.css">
</head>
<body>
    <div class="containerl">
        <div class = form-box>
            <?php
            class LoginHandler {
                private $conn;
            
                public function __construct($conn) {
                    $this->conn = $conn;
                    $this->processLogin();
                }
            
                public function processLogin() {
                    if(isset($_POST['submit'])) {
                        $pno = mysqli_real_escape_string($this->conn, $_POST['pno']);
                        $password = mysqli_real_escape_string($this->conn, $_POST['password']);
            
                        $results = mysqli_query($this->conn, "SELECT * FROM log_in_details WHERE pno = '$pno' AND passowrd = '$password'") or die("Select Error");
                        $row = mysqli_fetch_assoc($results);
            
                        if(is_array($row) && !empty($row)) {
                            $_SESSION['valid'] = $pno;
                            echo "<script>
                                    sessionStorage.setItem('user_pno', '{$_SESSION['valid']}');
                                </script>";
                        } else {
                            echo "<div class='message'> <p>Wrong personnel number or password</p></div>";
                            echo "<a href='index.php'><button class='btn'>Go Back</button>";
                        }
                    }  
                }
                public function redirectToPage() {
                    if(isset($_SESSION['valid'])&& isset($_POST['submit'])) {
                        header('location: currency.php');
                    }
                }
            }
            
            include('database_connection.php');
            $loginHandler = new LoginHandler($conn);
            //$loginHandler->processLogin();
            $loginHandler->redirectToPage();
            ?>
            
            <form id = 'log_in_form' action="" method="post">
                <header>Log in</header>
                <div class="input-div">
                    <label for="pno"> Personnel number:</label>
                    <input type="text" name="pno" autocomplete= "off" required>
                </div>
                <div class="input-div">
                    <label for="password"> Password:</label>
                    <input type="password" name="password" required>
                </div>
                <div class="submit_button-div">    
                    <input type="submit" id="submit_button" name="submit" value="Log in">
                </div>
            </form>
        </div>
    </div>
</body>
</html>