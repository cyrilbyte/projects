<form method="POST" action="create_survey.php">
    <div class="form-group">
        <label for="title">Survey Title:</label>
        <input type="text" class="form-control" name="title" required>
    </div>
    <div class="form-group">
        <label for="form_url">Google Form URL:</label>
        <input type="url" class="form-control" name="form_url" required>
    </div>
    <div class="form-group">
        <label for="spreadsheet_id">Google Spreadsheet ID:</label>
        <input type="text" class="form-control" name="spreadsheet_id" required>
    </div>
    <button type="submit" class="btn btn-primary">Create Survey</button>
</form>
