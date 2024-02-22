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

$FireArm_Name = "";
$Serial_Number = "";
$FireArm_Type = "";
$FireArm_Color = "";

$errorMessage = "";
$successMessage = "";

if( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $FireArm_Name = $_POST["FireArm_Name"];
    $Serial_Number = $_POST["Serial_Number"];
    $FireArm_Type = $_POST["FireArm_Type"];
    $FireArm_Color = $_POST["FireArm_Color"];

    do {
        if( empty($FireArm_Name) || empty($FireArm_Color) || empty($FireArm_Type) || empty($FireArm_Color) ){
            $errorMessage = "Pls fill out all the required information before sumbitting the firearm into inventory";
            break;
        }

        $sql = "INSERT INTO firearms (FireArm_Name, Serial_Number, FireArm_Type, FireArm_Color) " .
                "VALUES ('$FireArm_Name', '$Serial_Number', '$FireArm_Type', '$FireArm_Color')";
        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $FireArm_Name = "";
        $Serial_Number = "";
        $FireArm_Type = "";
        $FireArm_Color = "";

        $successMessage = "Firearm Added Correctly";

        header("location: /IPT2/index.php");
        exit;
        
        } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firearm Inventory System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container1">
        <h2>Input New Firearm</h2>

        <?php
        if( !empty($errorMessage)){
            echo"
            <div class='alert' role='Alert_Warning' >
                <strong>$errorMessage</strong>
                <button type='button' class='Close-Button' data-bs-dismiss='alert' aria-label='Close'>
            </div>
            ";
        }
        ?>

        <form method="post">
            <div class="row">
                <label class="col_form_label">Firearm Name</label>
                <div class="col">
                    <input type="text" class="Form_control" name="FireArm_Name" value="<?php echo $FireArm_Name; ?>">
                </div>

            </div>

            <div class="row">
                <label class="col_form_label">Serial Number</label>
                <div class="col">
                    <input type="text" class="Form_control" name="Serial_Number" value="<?php echo $Serial_Number; ?>">
                </div>

            </div>

            <div class="row">
                <label class="col_form_label">Firearm Type</label>
                <div class="col">
                    <input type="text" class="Form_control" name="FireArm_Type" value="<?php echo $FireArm_Type; ?>">
                </div>

            </div>

            <div class="row">
                <label class="col_form_label">Firearm Color</label>
                <div class="col">
                    <input type="text" class="Form_control" name="FireArm_Color" value="<?php echo $FireArm_Color; ?>">
                </div>

            </div>

            <?php
            if ( !empty($successMessage) ) {
                echo"
                <div class='row'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert' role='alert' >
                            <strong>$successMessage</strong>
                            <button type='button' class='Close-Button' data-bs-dismiss='alert' aria-label='Close'>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <div class="row">
                <div class="col">
                    <button type="submit" class="Submit_Button">Submit</button>
                </div>

                <div class="col">
                    <a class="Cancel_Button" href="/IPT2/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>