<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Create Survey</title>
    <style>
        .question-container { margin-bottom: 20px; }
        .optionInput { margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Create a Google Form Survey</h1>
        <form id="formBuilder">
            <div class="mb-3">
                <label for="formTitle" class="form-label">Form Title</label>
                <input type="text" class="form-control" id="formTitle" required>
            </div>
            <div class="mb-3">
                <label for="formDescription" class="form-label">Form Description</label>
                <textarea class="form-control" id="formDescription" rows="3" required></textarea>
            </div>
            <div id="questions"></div>
            <button type="button" class="btn btn-primary" id="addQuestion">Add Question</button>
            <button type="submit" class="btn btn-success mt-3">Create Survey</button>
        </form>
    </div>

    <script>
        document.getElementById('addQuestion').addEventListener('click', function() {
            const questionContainer = document.createElement('div');
            questionContainer.classList.add('question-container');
            questionContainer.innerHTML = `
                <label class="form-label">Question</label>
                <input type="text" class="form-control questionText" required>
                <select class="form-select questionType">
                    <option value="short-answer">Short Answer</option>
                    <option value="paragraph">Paragraph</option>
                    <option value="multiple-choice">Multiple Choice</option>
                    <option value="checkbox">Checkbox</option>
                </select>
                <div class="options-container">
                    <label class="form-label">Options (for Multiple Choice / Checkbox)</label>
                    <input type="text" class="form-control optionInput" placeholder="Option 1">
                    <input type="text" class="form-control optionInput" placeholder="Option 2">
                </div>
            `;
            questionContainer.querySelector('.questionType').addEventListener('change', function() {
                const selectedType = this.value;
                const optionsContainer = questionContainer.querySelector('.options-container');
                if (selectedType === 'short-answer' || selectedType === 'paragraph') {
                    optionsContainer.style.display = 'none';
                } else {
                    optionsContainer.style.display = 'block';
                }
            });
            document.getElementById('questions').appendChild(questionContainer);
        });

      document.getElementById('formBuilder').addEventListener('submit', function(e) {
    e.preventDefault();
    const formTitle = document.getElementById('formTitle').value;
    const formDescription = document.getElementById('formDescription').value;
    const questions = [];

    document.querySelectorAll('.question-container').forEach(container => {
        const questionText = container.querySelector('.questionText').value;
        const questionType = container.querySelector('.questionType').value;
        const options = [];
        container.querySelectorAll('.optionInput').forEach(option => {
            options.push(option.value);
        });

        questions.push({ text: questionText, type: questionType, options: options });
    });

    // Send data to PHP backend to create Google Form and store in Google Sheets
    fetch('create_google_form.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ formTitle, formDescription, questions })
    })
    .then(response => response.json())
    .then(data => {
        if (data.formUrl) {
            alert('Form created successfully! Access it here: ' + data.formUrl);
            window.location.href = 'user_dashboard.php';
        } else {
            alert('Error creating form. Please try again.');
        }
    })
    .catch(error => console.error('Error:', error));
});

    </script>
</body>
</html>
