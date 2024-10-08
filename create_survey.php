<?php
// Database connection
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $form_url = $_POST['form_url'];
    $spreadsheet_id = $_POST['spreadsheet_id'];

    $stmt = $conn->prepare("INSERT INTO surveys (title, form_url, spreadsheet_id) VALUES (?, ?, ?)");
    $stmt->execute([$title, $form_url, $spreadsheet_id]);

    // Redirect to admin dashboard
    header('Location: admin_dashboard.php');
    exit();
}
