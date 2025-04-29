<?php
$entry_done = False;

if (isset($_POST["name"])) {
    $server = "localhost";
    $user = "root";
    $password = "";

    $connection = mysqli_connect($server, $user, $password);

    if ($connection) {
        // echo "Successful connection with database"; // For debugging the database connection

        $name = $_POST["name"];
        $email = $_POST["email"];
        $age = $_POST["age"];
        $phone = $_POST["phone"];
        $details = $_POST["details"];


        $sql = "INSERT INTO `data-entry-form`.`entries` (`name`, `age`, `email`, `phone`, `details`, `date`) VALUES ('$name', '$age', '$email', '$phone', '$details', current_timestamp());";
        // echo $sql; // For debugging the query

        if ($connection->query($sql) === TRUE) {
            // echo "Successfully inserted"; // For debugging the data insertion
            $entry_done = True;
        } else {
            echo "ERROR: $sql <br> $connection->error";
        }

        $connection->close();
    } else {
        die("Connection failed due to " . mysqli_connect_error());
    }
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="style.css" />
        <!-- <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Staatliches&display=swap"
            rel="stylesheet" /> -->
        <title>Document</title>
    </head>

    <body>
        <img class="bg-img" src="bg.jpg" alt="background image" />
        <div class="container">
            <div class="form-container">
                <h2 class="heading">Data Entry Form</h2>
                <p>Submit your details via filling the below form</p>
                <?php
                if ($entry_done == True) {
                    echo '<p class="success-msg">Thanks for submitting your data.</p>';
                }
                ?>
                <form action="index.php" method="post">
                    <input type="text" name="name" id="name" placeholder="Enter your name" />
                    <input type="email" name="email" id="email" placeholder="Enter your email address" />
                    <input type="number" name="age" id="age" placeholder="Enter your age" />
                    <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" />
                    <textarea name="details" id="details" rows="5" placeholder="Any other details..."></textarea>
                    <input id="button" type="submit" value="Submit" />
                </form>
            </div>
        </div>
    </body>

</html>