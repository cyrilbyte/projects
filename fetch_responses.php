<?php
require 'google-api/vendor/autoload.php';
require 'config.php';

// Google Sheets API Setup
$client = new Google_Client();
$client->setAuthConfig('credentials.json');
$client->addScope(Google_Service_Sheets::SPREADSHEETS_READONLY);

// Fetch all surveys to get their responses
$stmt = $conn->prepare("SELECT * FROM surveys");
$stmt->execute();
$surveys = $stmt->fetchAll();

foreach ($surveys as $survey) {
    $service = new Google_Service_Sheets($client);
    $spreadsheetId = $survey['spreadsheet_id']; // Google Sheet ID
    $range = 'Sheet1!A1:D'; // Adjust range as needed

    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();

    if (!empty($values)) {
        // Skip the header row and process the responses
        for ($i = 1; $i < count($values); $i++) {
            $row = $values[$i];
            $name = $row[0]; // Assuming name is in the first column
            $email = $row[1]; // Email in the second column
            $responseText = $row[2]; // Response in the third column
            $submittedAt = $row[3]; // Submission time in the fourth column

            // Check if this response is already saved to avoid duplicates
            $checkStmt = $conn->prepare("SELECT * FROM survey_responses WHERE name = ? AND email = ? AND survey_id = ?");
            $checkStmt->execute([$name, $email, $survey['id']]);
            if ($checkStmt->rowCount() == 0) {
                // Insert new response into database
                $insertStmt = $conn->prepare("INSERT INTO survey_responses (survey_id, name, email, response, submitted_at) VALUES (?, ?, ?, ?, ?)");
                $insertStmt->execute([$survey['id'], $name, $email, $responseText, $submittedAt]);
            }
        }
    }
}
