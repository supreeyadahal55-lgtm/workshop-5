<?php
require 'header.php';
require 'functions.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $name = formatName($_POST['name']);
        $email = $_POST['email'];
        $skillsString = $_POST['skills'];

        if (!$name || !validateEmail($email) || empty($skillsString)) {
            throw new Exception("Invalid input data.");
        }

        $skillsArray = cleanSkills($skillsString);
        saveStudent($name, $email, $skillsArray);

        $message = "Student saved successfully!";
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}
?>

<h2>Add Student Info</h2>

<form method="post">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Skills (comma-separated): <input type="text" name="skills" required><br><br>
    <button type="submit">Save Student</button>
</form>

<p><?= $message ?></p>

<?php require 'footer.php'; ?>
