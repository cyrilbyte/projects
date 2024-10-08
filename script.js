document.getElementById('addQuestion').addEventListener('click', function () {
    const questionContainer = document.createElement('div');
    questionContainer.classList.add('question-container');

    questionContainer.innerHTML = `
        <label for="questionText" class="form-label">Question</label>
        <input type="text" class="form-control questionText" placeholder="Enter question" required>
        <label for="questionType" class="form-label">Question Type</label>
        <select class="form-select questionType">
            <option value="short-answer">Short Answer</option>
            <option value="paragraph">Paragraph</option>
            <option value="multiple-choice">Multiple Choice</option>
            <option value="checkbox">Checkbox</option>
        </select>
        <div class="options-container mt-3"></div>
        <button type="button" class="btn btn-outline-primary addOption mt-2">Add Option</button>
        <span class="remove-question" onclick="removeQuestion(this)">Remove Question</span>
    `;

    document.getElementById('questionsContainer').appendChild(questionContainer);

    // Add event listener to the new "Add Option" button
    questionContainer.querySelector('.addOption').addEventListener('click', function () {
        const optionsContainer = questionContainer.querySelector('.options-container');
        const optionInput = document.createElement('input');
        optionInput.type = 'text';
        optionInput.classList.add('form-control', 'optionInput', 'mt-2');
        optionInput.placeholder = 'Enter option';
        optionsContainer.appendChild(optionInput);
    });

    // Handle changing question types
    questionContainer.querySelector('.questionType').addEventListener('change', function () {
        const selectedType = this.value;
        const optionsContainer = questionContainer.querySelector('.options-container');
        const addOptionButton = questionContainer.querySelector('.addOption');

        // Clear previous options
        optionsContainer.innerHTML = '';

        // Show/hide input fields based on selected type
        if (selectedType === 'paragraph') {
            optionsContainer.innerHTML = '<textarea class="form-control mt-2" rows="3" placeholder="Enter paragraph answer"></textarea>';
            addOptionButton.style.display = 'none'; // Hide add option button
        } else if (selectedType === 'short-answer') {
            optionsContainer.innerHTML = '<input type="text" class="form-control mt-2" placeholder="Enter short answer" />';
            addOptionButton.style.display = 'none'; // Hide add option button
        } else if (selectedType === 'multiple-choice' || selectedType === 'checkbox') {
            optionsContainer.innerHTML += '<p class="mt-2">Options:</p>';
            addOptionButton.style.display = 'block'; // Show add option button
        }
    });
});

document.getElementById('formBuilder').addEventListener('submit', function (e) {
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

        questions.push({
            text: questionText,
            type: questionType,
            options: options
        });
    });

    // You can now send the formTitle, formDescription, and questions to your server
    console.log('Form Title:', formTitle);
    console.log('Form Description:', formDescription);
    console.log('Questions:', questions);
});

function removeQuestion(element) {
    element.parentElement.remove();
}
