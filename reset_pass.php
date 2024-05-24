
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
        }

        h1 {
            color: #4caf50; /* Change title color */
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            color: #333;
            margin-bottom: 10px;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4caf50; /* Change button background color */
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 12px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #388e3c; /* Change button hover background color */
        }

        .message {
            color: red;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Reset Your Password</h1>
        <?php
        include "connect.php";
        if ($_GET['key'] && $_GET['reset']) {
            $email = $_GET['key'];
            $pass = $_GET['reset'];
            $query = "SELECT email,pass FROM user WHERE email='$email' AND pass='$pass'";
            $data = mysqli_query($conn, $query);
            if ($data && mysqli_num_rows($data) > 0) {
        ?>
                <form method="post" action="submit_new.php">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <label for="password">Enter New Password</label>
                    <input type="password" name="password" id="password" required>
                    <input type="submit" name="submit_password" value="Reset Password">
                </form>
        <?php
            } else {
                echo "<p class='message'>Invalid email or password reset key.</p>";
            }
        } else {
            echo "<p class='message'>Invalid email or password reset key.</p>";
        }
        ?>
    </div>
</body>

</html>


    <?php

?>