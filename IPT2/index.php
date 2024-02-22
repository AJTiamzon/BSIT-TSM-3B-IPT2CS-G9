<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Guns R Us</title>
</head>
<body>
    <div class="container">
        <h2>List of Firearms in Inventory</h2>
        <a href="/IPT2/Input.php" class="adding_firearm" role="button">Inputting New Firearm</a>
        <br>
        <table class="Firearm_Table">
            <th>
                <tr>
                    <th>ID</th>
                    <th>Firearm Name</th>
                    <th>Serial Number</th>
                    <th>Firearm Type</th>
                    <th>Firearm Color</th>
                    <th>Inventory Date</th>
                    <th>Action</th>
                </tr>
            </th>

            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $databse = "guns_r_us";

                //Connecting to the Database
                $connection = new mysqli($servername, $username, $password, $databse);

                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                $sql = "SELECT * FROM firearms";
                $result = $connection->query($sql);

                if(!$result) {
                    die("Invalid query: " . $connection->error);
                }

                while($row = $result->fetch_assoc()){
                    echo "
                    <tr>
                    <td>$row[id]</td>
                    <td>$row[FireArm_Name]</td>
                    <td>$row[Serial_Number]</td>
                    <td>$row[FireArm_Type]</td>
                    <td>$row[FireArm_Color]</td>
                    <td>$row[Inventoried_At]</td>
                    <td>
                        <a class='Edit_Button' href='/IPT2 Case Study/edit.php?id=$row[id]'>Edit</a>
                        <a class='Delete_Button' href='/IPT2 Case Study/delete.php?id=$row[id]'>Delete</a>
                    </td>
                </tr>
                ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>