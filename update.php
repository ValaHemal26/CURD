<?php
include "conn.php";
$error = [];
$data = [];
$hobby_arr = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $hobbies = isset($_POST['hobbies']) ? $_POST['hobbies'] : [];
    $education = $_POST['education'];

    // Validations
    if (!preg_match("/^[a-zA-Z]+$/", $first_name)) {
        $error[] = "First Name should contain only letters.";
    }
    if (!preg_match("/^[a-zA-Z]+$/", $last_name)) {
        $error[] = "Last Name should contain only letters.";
    }

    $dob_date = new DateTime($dob);
    $today = new DateTime();
    $age = $dob_date->diff($today)->y;

    if ($age < 18) {
        $error[] = "User must be at least 18 years old.";
    }

    if (!preg_match("/^[6-9][0-9]{9}$/", $mobile)) {
        $error[] = "Mobile should be a 10-digit number starting with 6 to 9.";
    }

    if (strlen($address) < 20) {
        $error[] = "Address must be at least 20 characters long.";
    }

    // Hobbies validation
    if (count($hobbies) > 2) {
        $error[] = "You can select a maximum of 2 hobbies.";
    }

    $hobbies_str = implode(",", $hobbies);

    if (empty($error)) {
        $sql = "UPDATE users SET 
            first_name = '$first_name',
            last_name = '$last_name',
            dob = '$dob',
            email = '$email',
            mobile = '$mobile',
            address = '$address',
            gender = '$gender',
            hobbies = '$hobbies_str',
            education = '$education',
            updated_at = NOW()
            WHERE id = $id";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Your data is successfully updated.');window.location.href='show.php'</script>";
        } else {
            $error[] = "Error updating record: " . mysqli_error($conn);
        }
    }

    $data = $_POST;
    $hobby_arr = $hobbies;

} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $res = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
    if (mysqli_num_rows($res) == 0) {
        die("User not found");
    }
    $data = mysqli_fetch_assoc($res);
    $hobby_arr = explode(",", $data['hobbies']);
} else {
    header('Location: show.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5 border border-4 mb-4 rounded">
    <h2>Edit User</h2>

    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">

        <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($data['first_name'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($data['last_name'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label>Date of Birth</label>
            <input type="date" name="dob" class="form-control" value="<?= htmlspecialchars($data['dob'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label>Mobile</label>
            <input type="text" name="mobile" class="form-control" maxlength="10" value="<?= htmlspecialchars($data['mobile'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control" required><?= htmlspecialchars($data['address'] ?? '') ?></textarea>
        </div>

        <div class="mb-3">
            <label>Gender</label><br>
            <input type="radio" name="gender" value="Male" <?= ($data['gender'] ?? '') == 'Male' ? 'checked' : '' ?>> Male
            <input type="radio" name="gender" value="Female" <?= ($data['gender'] ?? '') == 'Female' ? 'checked' : '' ?>> Female
        </div>

        <div class="mb-3">
            <label>Hobbies</label><br>
            <input type="checkbox" name="hobbies[]" value="Reading" <?= in_array("Reading", $hobby_arr) ? 'checked' : '' ?>> Reading
            <input type="checkbox" name="hobbies[]" value="Music" <?= in_array("Music", $hobby_arr) ? 'checked' : '' ?>> Music
            <input type="checkbox" name="hobbies[]" value="Sports" <?= in_array("Sports", $hobby_arr) ? 'checked' : '' ?>> Sports
        </div>

        <div class="mb-3">
            <label>Education</label>
            <select name="education" class="form-select">
                <?php
                $options = ["BCA", "B TECH", "MCA", "BSC", "MSC", "M TECH"];
                foreach ($options as $opt) {
                    $selected = ($data['education'] ?? '') == $opt ? 'selected' : '';
                    echo "<option value=\"$opt\" $selected>$opt</option>";
                }
                ?>
            </select>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="show.php" class="btn btn-secondary m-2">Cancel</a>
    </form>

    <?php if (!empty($error)) { ?>
        <div class="alert alert-danger mt-3">
            <?= implode("<br>", $error); ?>
        </div>
    <?php } ?>
</body>
</html>
