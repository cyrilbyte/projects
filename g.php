<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylish Form Builder</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Custom CSS -->
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center">Form Builder</h1>
        <form id="formBuilder">
            <div class="mb-4">
                <label for="formTitle" class="form-label">Form Title</label>
                <input type="text" class="form-control" id="formTitle" placeholder="Enter form title" required>
            </div>
            <div class="mb-4">
                <label for="formDescription" class="form-label">Form Description</label>
                <textarea class="form-control" id="formDescription" rows="3" placeholder="Enter form description"></textarea>
            </div>
            <div id="questionsContainer"></div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" id="addQuestion">Add Question</button>
                <button type="submit" class="btn btn-success">Create Form</button>
            </div>
        </form>
    </div>

    <script src="script.js"></script> <!-- Custom JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
