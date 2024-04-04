<?php
include("connection.php");
?>

<?php
if (isset($_POST['searchdata'])) {
    $search = $_POST['Search'];
    $query = "SELECT * FROM FORM WHERE id = $search";
    $data = mysqli_query($conn, $query);

    $result = mysqli_fetch_assoc($data);

    // $gender = $result['emp_gender'];
    // echo $gender;
}


?>

<!doctype html>
<html lang="en">

<head>
    <title>EMP Management</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body style="background-color: rgb(120, 120, 241);">
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <div class="center" style="margin: 35px;">
            <div class="child" style="background-color: antiquewhite; border-radius: 10px;">
                <form action="#" method="POST">
                    <h1 style=" color:darkcyan; padding-top: 10px">Employee Data Entry Automation Software</h1>

                    <div class="form">
                        <input type="text" name="Search" class="textfield" placeholder="Search Id" value="<?php if (isset($_POST['searchdata'])) {
                                                                                                                echo $result['id'];
                                                                                                            } ?>">

                        <input type="text" name="name" class="textfield" placeholder="Employee Name" value="<?php if (isset($_POST['searchdata'])) {
                                                                                                                echo $result['emp_name'];
                                                                                                            } ?>">



                        <select class="textfield" name="gender">
                            <option value="Not Selected">Select Gender</option>
                            <option value="Male" <?php if ($result['emp_gender'] == 'Male') {
                                                        echo "selected";
                                                    } ?>>Male</option>
                            <option value="Female" <?php if ($result['emp_gender'] == 'Female') {
                                                        echo "selected";
                                                    } ?>>Female</option>
                            <option value="Others" <?php if ($result['emp_gender'] == 'Others') {
                                                        echo "selected";
                                                    } ?>>Others</option>
                        </select>

                        <label name="gender" class="textfield"><?php if (isset($_POST['searchdata'])) {
                                                                    echo $result['emp_gender'];
                                                                } ?></label>

                        <input type="text" name="email" class="textfield" placeholder="Email Address" value="<?php if (isset($_POST['searchdata'])) {
                                                                                                                    echo $result['emp_email'];
                                                                                                                } ?>">


                        <select name="department" class="textfield">
                            <option value="Not Selected">Select Department</option>

                            <option value="IT" <?php if ($result['emp_department'] == 'IT') {
                                                    echo "Selected";
                                                } ?>>IT</option>

                            <option value="HR" <?php if ($result['emp_department'] == 'HR') {
                                                    echo "Selected";
                                                } ?>>HR</option>

                            <option value="Accounts" <?php if ($result['emp_department'] == 'Accounts') {
                                                            echo "Selected";
                                                        } ?>>Accounts</option>

                            <option value="Marketing" <?php if ($result['emp_department'] == 'Marketing') {
                                                            echo "Selected";
                                                        } ?>>Marketing</option>

                            <option value="Business Development" <?php if ($result['emp_department'] == 'Business Development') {
                                                                        echo "Selected";
                                                                    } ?>>Business Development</option>
                        </select>
                        <label name="department" class="textfield"><?php if (isset($_POST['searchdata'])) {
                                                                        echo $result['emp_department'];
                                                                    } ?></label>
                        <textarea type="text" name="address" class="textfield" placeholder="Address"><?php if (isset($_POST['searchdata'])) {
                                                                                                            echo $result['emp_address'];
                                                                                                        } ?></textarea>

                        <input type="submit" name="searchdata" value="Search" class="btn btn-outline-primary" style="font-weight: bold; font-size:large">

                        <input type="submit" name="save" value="Save" class="btn btn-outline-success" style="font-weight: bold; font-size:large">

                        <input type="submit" value="Update" name="update" class="btn btn-outline-warning" style="font-weight: bold; font-size:large">

                        <input type="submit" value="Delete" name="delete" class="btn btn-outline-danger" style="font-weight: bold; font-size:large" onclick=" return checkdelete()">

                        <input type="reset" value="Clear" class="btn btn-outline-info" style="font-weight: bold; font-size:large">
                    </div>
                </form>
            </div>

        </div>


    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>

<script>
    function checkdelete() {
        return confirm('Are you sure to delete this data?');
    }
</script>


<?php
if (isset($_POST['save'])) {
    $name       = $_POST['name'];
    $gender     = $_POST['gender'];
    $email      = $_POST['email'];
    $department = $_POST['department'];
    $address    = $_POST['address'];

    $query = "INSERT INTO FORM (emp_name,emp_gender,emp_email,emp_department,emp_address) 
    VALUES ('$name',' $gender',' $email',' $department',' $address')";
    $data = mysqli_query($conn, $query);

    if ($data) {
        echo "<script> alert ('Data saved into Database') </script>";
    } else {
        echo "<script> alert ('Failed to insert Data') </script>";
    }
}
?>

<?php
if (isset($_POST['delete'])) {
    $id = $_POST['Search'];
    $query = "DELETE FROM FORM WHERE id='$id' ";
    $data = mysqli_query($conn, $query);

    if ($data) {
        // echo "Record Deleted";
    } else {
        echo "Error in deleting Record : ";
    }
}
?>

<?php
if (isset($_POST['update'])) {
    $id         = $_POST['Search'];
    $name       = $_POST['name'];
    $gender     = $_POST['gender'];
    $email      = $_POST['email'];
    $department = $_POST['department'];
    $address    = $_POST['address'];


    $query = "UPDATE FORM SET emp_name = '$name' ,emp_gender = '$gender',emp_email = ' $email',emp_department = '$department',emp_address = ' $address' WHERE id = '$id'";

    $data = mysqli_query($conn, $query);

    if ($data) {
        echo "<script> alert ('Record Updated') </script>";
    } else {
        echo "<script> alert ('Failed to Update Data') </script>";
    }
}


?>