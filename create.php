<?php
include "conn.php";

$errors = [];
if (isset($_POST['submit']))
{

    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $dob = $_POST['dob'];
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $address = trim($_POST['address']);
    $gender = $_POST['gender'];
    $hobbies = isset($_POST['hobbies']) ? $_POST['hobbies'] : [];
    $education = $_POST['education'];
    $password = $_POST['password'];
    $privacy_policy = isset($_POST['privacy_policy']) ? 1 : 0;

    if (!preg_match("/^[a-zA-Z]+$/", $first_name)) {
        $errors[] = "First name should contain only letters.";
    }
    if (!preg_match("/^[a-zA-Z]+$/", $last_name)) {
        $errors[] = "Last name should contain only letters.";
    }
    $dob_date = new DateTime($dob);
    $today = new DateTime();
    $age = $dob_date->diff($today)->y;

    if ($age < 18) {
        $errors[] = "User must be at least 18 years old.";
    }
    if (!preg_match("/^[6-9][0-9]{9}$/", $mobile)) 
    {
        $errors[] = "Mobile number must start with 6, 7, 8, or 9 and be exactly 10 digits.";
    }
    if (count($hobbies) > 2) {
        $errors[] = "You can select a maximum of 2 hobbies.";
    }

    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }
    if (strlen($address) < 20) {
        $errors[] = "Address must be at least 20 characters long.";
    }

    if (!$privacy_policy) {
        $errors[] = "You must agree to the privacy policy.";
    }

    if (empty($errors)) 
    {
        $hobbies_str = implode(",", $hobbies);
        $pass_hashed = md5($password);

        $sql = "INSERT INTO users (first_name, last_name, dob, email, password, mobile, address, gender, hobbies, education, privacy_policy)
                VALUES ('$first_name', '$last_name', '$dob', '$email', '$pass_hashed', '$mobile', '$address', '$gender', '$hobbies_str', '$education', $privacy_policy)";

        if (mysqli_query($conn, $sql)) 
        {
            echo '<script>alert("Data Inserted Successfully"); window.location.href="show.php";</script>';
            exit();
        }
        else
        {
            $errors[] = "Database error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container pt-5 mt-5 border border-2 border-success rounded-4">
    <h2 style="border-bottom: 2px solid;">Create New User</h2>
    <form action="" class="p-3" method="POST">
        <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" value="<?php echo isset($first_name) ? htmlspecialchars($first_name) : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" value="<?php echo isset($last_name) ? htmlspecialchars($last_name) : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label>Date of Birth</label>
            <input type="date" name="dob" class="form-control" value="<?php echo isset($dob) ? htmlspecialchars($dob) : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label>Mobile</label>
            <input type="tel" name="mobile" class="form-control" maxlength="10" value="<?php echo isset($mobile) ? htmlspecialchars($mobile) : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control" required><?php echo isset($address) ? htmlspecialchars($address) : ''; ?></textarea>
        </div>
        <div class="mb-3">
            <label>Gender</label><br>
            <input type="radio" name="gender" value="Male" checked <?php if (isset($gender) && $gender == 'Male') echo 'checked'; ?> required> Male
            <input type="radio" name="gender" value="Female" <?php if (isset($gender) && $gender == 'Female') echo 'checked'; ?>> Female
        </div>
        <div class="mb-3">
            <label>Hobbies</label><br>
            <input type="checkbox" name="hobbies[]" checked value="Reading" <?php if (isset($hobbies) && in_array('Reading', $hobbies)) echo 'checked'; ?>> Reading
            <input type="checkbox" name="hobbies[]" value="Music" <?php if (isset($hobbies) && in_array('Music', $hobbies)) echo 'checked'; ?>> Music
            <input type="checkbox" name="hobbies[]" value="Sports" <?php if (isset($hobbies) && in_array('Sports', $hobbies)) echo 'checked'; ?>> Sports
        </div>
        <div class="mb-3">
            <label>Education</label>
            <select name="education" class="form-select" required>
                <?php 
                $edu_options = ['BCA', 'B TECH', 'MCA', 'BSC', 'MSC', 'M TECH'];
                foreach ($edu_options as $option) 
                {
                    $selected = (isset($education) && $education == $option) ? 'selected' : '';
                    echo "<option value=\"$option\" $selected>$option</option>";
                }
                ?>
            </select>
        </div>
         <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="checkbox" name="privacy_policy" value="1" <?php if (isset($privacy_policy) && $privacy_policy) echo 'checked'; ?> > I agree to the privacy policy
        </div>
        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
        <a href="show.php" class="btn btn-secondary">Back</a>
    </form>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</body>
</html>
