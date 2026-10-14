<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Forms</title>
        <style>
            .error {color: #FF0000}
        </style>
    </head>
    <body>
        <?php
        $name = $email = $website = $comment = $gender = "";
        $nameErr = $emailErr = $genderErr = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $nameErr = "Name is required";
            } else {
                $name = validate_input($_POST["name"]);
                if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                    $nameErr = "Only letter and white space allowed!";
                }
            }

            if (empty($_POST["email"])) {
                $emailErr = "E-mail is required";
            } else {
                $email = validate_input($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid e-mail format";
                }
            }
            
            if (empty($_POST["website"])) {
                $website = "";
            } else {
                $website = validate_input($_POST["website"]);
                if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
                    $websiteErr = "Invalid URL";
                }
            }

            if (empty($_POST["comment"])) {
                $comment = "";
            } else {
                $comment = validate_input($_POST["comment"]);
            }

            if (empty($_POST["gender"])) {
                $genderErr = "Gender is required";
            } else {
                $gender = validate_input($_POST["gender"]);
            }
        }

        function validate_input($input) {
            $new_input = trim($input);
            $new_input = stripslashes($new_input);
            $new_input = htmlspecialchars($new_input);
            return $new_input;
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <br>
            Name: <input type="text" name="name">
            <span class="error">* <?php echo $nameErr; ?></span> 
            <br><br>
            E-mail: <input type="text" name="email">
            <span class="error">* <?php echo $emailErr; ?></span> 
            <br><br>
            Website: <input type="text" name="website"><br><br>
            Comment: <textarea type="text" name="comment" cols="35" rows="3"></textarea><br><br>
            Gender:
            <input type="radio" name="gender" value="male">Male
            <input type="radio" name="gender" value="female">Female
            <span class="error">* <?php echo $genderErr; ?></span> 
            <br><br>
            <input type="submit">
            <br><br>
        </form>

        <?php
        echo "$name // $email // $website // $comment // $gender";
        ?>
    </body>
</html>