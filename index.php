<?php

include ('./includes/init.php');

$query = "SELECT * FROM just";
$statement = $connection->prepare($query);
$statement->execute();

$users = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-CRUD</title>
</head>

<body>
    <form>
        <input type="text" id="name" placeholder="Enter Name: " autofocus><br><br>
        <input type="password" id="password" placeholder="Enter Password: "><br><br>
        <input type="button" value="Submit" onclick="sendData()"><br><br>
    </form>

       <table border="2">
        <thead>
            <tr>
                <th>name</th>
                <th>Password</th>
            </tr>  
        </thead>
         <tbody>
            <?php foreach ($users as $user) : ?>
               <tr>

               <td><?= $user['name'] ?></td>
               <td><?= $user['password'] ?></td>
                    
            </tr>
            <?php endforeach; ?>
        </tbody>

    <script src="./js/jquery.min.js"></script>
    <script>
        function sendData() {
            $.ajax({
                url: './api/insert.php',
                type: 'POST',
                data: {
                    name: $('#name').val(),
                    password: $('#password').val(),
                },
                success: function(response) {
                    if (response == 0)
                        return window.location = './index.php';
                    else {
                        alert("Data Inserted Successfully !");
                        window.location.href = './index.php';
                    }
                }
            });
        }
    </script>
</body>

</html>