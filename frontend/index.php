<?php include('./header.php') ?>
<?php
$errors = array('client_email' => '',  'pwd1' => '', 'pwd2' => '', 'pwd22' => '');

if (isset($_POST['submit'])) {
    $valid = true;

    if (empty($_POST['client_email'])) {
        $valid = false;
        $errors['client_email'] = 'Required Field!';
    } else {
        $client_email = htmlspecialchars($_POST['client_email']);

        if (!filter_var($client_email, FILTER_VALIDATE_EMAIL)) {
            $valid = false;
            $errors['client_email'] = 'Email format is not valid!';
        }
    }

    if (empty($_POST['pwd1'])) {
        $valid = false;
        $errors['pwd1'] = 'Required Field!';
    } else {
        $pwd1 = hash('sha512', htmlspecialchars($_POST['pwd1']));
    }

    if (empty($_POST['pwd2'])) {
        $valid = false;
        $errors['pwd2'] = 'Required Field!';
    } else {
        $pwd2 = hash('sha512', htmlspecialchars($_POST['pwd2']));
    }

    //Database Connection

    include('./dbconnect.php');

    //Create Sql
    if ($valid) {

        if ($pwd1 != $pwd2) {
            $errors['pwd22'] = 'Passwords Do Not Match!!';
        } else {

            $sql = "INSERT INTO tbl_registration(db_email,db_password, db_passwordconf) VALUES (?,?,?)";

            if ($stmt = mysqli_prepare($conn, $sql)) {

                mysqli_stmt_bind_param($stmt, "sss", $client_email, $pwd1, $pwd2);

                $client_email = $_REQUEST['client_email'];
                $pwd1 = $_REQUEST['pwd1'];
                $pwd2 = $_REQUEST['pwd2'];

                if (mysqli_stmt_execute($stmt)) {
                    header('Location: success.php');
                    exit();
                } else {
                    echo "ERROR - Query Error: $sql. " . mysqli_error($conn);
                }
            } else {
                echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);

            mysqli_close($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">



<div class="container d-flex justify-content-center align-items-center" style="min-height:85vh">

    <form method="POST" action="index.php" class="w-75">

        <div class="align-items-center flex-column row">

            <div class="col-6 mb-4 text-center">
                <h3 class="text-dark fw-bold">I2T Registration Form</h3>
            </div>
            <div class="col-md-6 col-sm-8 mb-3">
                <label class="form-label text-dark fw-bold" for="name">Email Address</label>

                <input class="form-control border-secondary" name="client_email" type="text">
                <p class="fw-bold text-danger"><?php echo $errors['client_email']; ?></p>

            </div>

            <div class="col-md-6 col-sm-8 mb-3">
                <label class="form-label text-dark fw-bold" for="password1">Password</label>

                <input class="form-control border-secondary" name="pwd1" required type="password">
                <p class="fw-bold text-danger"><?php echo $errors['pwd1']; ?></p>
            </div>

            <div class="col-md-6 col-sm-8 mb-3">
                <label class="form-label text-dark fw-bold" for="password2">Confirm Password</label>

                <input class="form-control border-secondary" name="pwd2" required type="password">
                <p class="fw-bold text-danger"><?php echo $errors['pwd2']; ?></p>
                <p class="fw-bold text-danger"><?php echo $errors['pwd22']; ?></p>
            </div>


            <div class="col-md-6 col-sm-8 d-flex justify-content-center mb-3">
                <input class="btn btn-success fw-bold" name="submit" type="submit" value="Submit">
            </div>

        </div>
    </form>
</div>

</html>
<?php include('./footer.php') ?>