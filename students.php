<?php
require 'header.php';

if (!file_exists("students.txt")) {
    echo "<p>No students found.</p>";
    require 'footer.php';
    exit;
}

$lines = file("students.txt", FILE_IGNORE_NEW_LINES);
?>

<h2>Student List</h2>

<?php foreach ($lines as $line): ?>
    <?php
        list($name, $email, $skills) = explode("|", $line);
        $skillsArray = explode(",", $skills);
    ?>
    <p>
        <strong>Name:</strong> <?= htmlspecialchars($name) ?><br>
        <strong>Email:</strong> <?= htmlspecialchars($email) ?><br>
        <strong>Skills:</strong>
        <pre><?php print_r($skillsArray); ?></pre>
    </p>
    <hr>
<?php endforeach; ?>

<?php require 'footer.php'; ?>
