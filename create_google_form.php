<?php
require 'vendor/autoload.php'; // Include Google API client libraries

use Google\Client;
use Google\Service\Sheets;

function createGoogleSheet($formTitle, $questions) {
    $client = new Client();
    $client->setApplicationName('Survey Form');
    $client->setScopes([Sheets::SPREADSHEETS]);
    $client->setAuthConfig('credentials.json'); // Path to your service account credentials

    $service = new Sheets($client);

    // Create a new Google Sheet
    $spreadsheet = new Sheets\Spreadsheet([
        'properties' => ['title' => $formTitle]
    ]);

    $response = $service->spreadsheets->create($spreadsheet, [
        'fields' => 'spreadsheetId'
    ]);

    $spreadsheetId = $response->spreadsheetId;

    // Prepare data for the sheet (Form title and questions)
    $sheetData = [];
    $headerRow = ["Question", "Type", "Options"];
    array_push($sheetData, $headerRow);

    foreach ($questions as $question) {
        $options = implode(", ", $question['options']); // Convert options array to a string
        $sheetData[] = [$question['text'], $question['type'], $options];
    }

    $range = 'Sheet1!A1'; // Start at the first cell
    $body = new Sheets\ValueRange(['values' => $sheetData]);
    $service->spreadsheets_values->update($spreadsheetId, $range, $body, ['valueInputOption' => 'RAW']);

    // Return the Google Sheet URL
    return "https://docs.google.com/spreadsheets/d/" . $spreadsheetId;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get JSON data from the form
    $data = json_decode(file_get_contents('php://input'), true);
    $formTitle = $data['formTitle'];
    $formDescription = $data['formDescription'];
    $questions = $data['questions'];

    try {
        $formUrl = createGoogleSheet($formTitle, $questions);
        echo json_encode(['formUrl' => $formUrl]);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Failed to create form: ' . $e->getMessage()]);
    }
}
