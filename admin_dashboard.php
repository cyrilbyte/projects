<?php
// Fetch survey responses from the database
require 'config.php';

$stmt = $conn->prepare("SELECT s.title, sr.name, sr.email, sr.response, sr.submitted_at FROM survey_responses sr JOIN surveys s ON sr.survey_id = s.id ORDER BY sr.submitted_at DESC");
$stmt->execute();
$responses = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Survey Responses</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Survey Responses</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Survey Title</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Response</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($responses as $response): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($response['title']); ?></td>
                        <td><?php echo htmlspecialchars($response['name']); ?></td>
                        <td><?php echo htmlspecialchars($response['email']); ?></td>
                        <td><?php echo htmlspecialchars($response['response']); ?></td>
                        <td><?php echo htmlspecialchars($response['submitted_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
