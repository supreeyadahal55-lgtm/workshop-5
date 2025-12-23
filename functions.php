<?php

function formatName($name) {
    return ucwords(strtolower(trim($name)));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    $skills = explode(',', $string);
    return array_map('trim', $skills);
}

function saveStudent($name, $email, $skillsArray) {
    $line = $name . "|" . $email . "|" . implode(',', $skillsArray) . PHP_EOL;

    if (!file_put_contents("students.txt", $line, FILE_APPEND)) {
        throw new Exception("Failed to save student data.");
    }
}

function uploadPortfolioFile($file) {
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if ($file['error'] !== 0) {
        throw new Exception("File upload error.");
    }

    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception("Invalid file type.");
    }

    if ($file['size'] > $maxSize) {
        throw new Exception("File exceeds 2MB size limit.");
    }

    if (!is_dir("uploads")) {
        throw new Exception("Uploads directory not found.");
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = uniqid("portfolio_") . "." . $ext;
    $destination = "uploads/" . $newName;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        throw new Exception("Failed to move uploaded file.");
    }

    return $newName;
}
