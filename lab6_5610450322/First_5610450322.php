<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!--5610450322-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $cusErr = $citiErr = $nameErr = $lastnameErr = "";
        $customID = $citiID = $name = $lastname = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["customerID"])) {
                $cusErr = "CustomerID is required";
            } else {
                $customID = test_input($_POST["customerID"]);
            }

            if (empty($_POST["citizenID"])) {
                $citiErr = "CitizenID is required";
            } else {
                $citiID = test_input($_POST["citizenID"]);
            }

            if (empty($_POST["name"])) {
                $nameErr = "Name is required";
            } else {
                $name = test_input($_POST["name"]);
            }

            if (empty($_POST["lastname"])) {
                $lastnameErr = "Lastname is required";
            } else {
                $lastname = test_input($_POST["lastname"]);
            }

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "webtech";

           
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO customers (customerID, citizenID, fname, lname)"
                        . "VALUES ('$customID', '$citiID', '$name', '$lastname')";
                // use exec() because no results are returned
                $conn->exec($sql);
                echo "New record created successfully";
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }

            $conn = null;
        }

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                CustomerID: <input type="text" name="customerID"> 
                <span class="error">* <?php echo $cusErr; ?></span>
                <br><br>
                CitizenID: <input type="text" name="citizenID">
                <span class="error">* <?php echo $citiErr; ?></span>
                <br><br>
                Name: <input type="text" name="name">  
                <span class="error">* <?php echo $nameErr; ?></span>
                <br><br>
                Lastname: <input type="text" name="lastname"> 
                <span class="error">* <?php echo $lastnameErr; ?></span>
            <br><br>
            <input type="submit" name="submit" value="Submit"> 
        </form>

    </body>
</html>