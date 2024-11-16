<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Questions</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
            /* Light background */
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
            max-width: 600px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .question-box {
            display: none;
            /* Initially hide all questions */
        }

        .question-box.active {
            display: block;
            /* Show only the active question */
        }

        .btn-primary,
        .btn-secondary {
            width: 48%;
            margin: 5px 1%;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Quiz Questions</h1>

        <div id="quiz-container">
            @foreach ($questions as $index => $question)
            <div class="question-box {{ $index === 0 ? 'active' : '' }}" data-question-id="{{ $question->id }}">
                <p class="fw-bold">{{ $question->question_text }}</p>
                @foreach ($question->answers as $answer)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answer_{{ $question->id }}" id="answer_{{ $answer->id }}" value="{{ $answer->id }}">
                    <label class="form-check-label" for="answer_{{ $answer->id }}">
                        {{ $answer->answer_text }}
                    </label>
                </div>
                @endforeach

                <!-- Navigation Buttons -->
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-secondary skip-btn">Skip</button>
                    <button class="btn btn-primary next-btn">Next</button>
                </div>
            </div>
            @endforeach
        </div>

        <div id="completion-message" class="text-center mt-4" style="display: none;">
            <h3>Quiz Completed!</h3>
            <p>Thank you for participating in the quiz.</p>
        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Axios CDN -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- SweetAlert for Alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- AJAX and Navigation Script -->
    <script>
       document.addEventListener('DOMContentLoaded', () => {
        const questions = document.querySelectorAll('.question-box');
        let currentQuestionIndex = 0;

    function showQuestion(index) {
        // Show only the current question and hide others
        questions.forEach((question, i) => {
            question.classList.toggle('active', i === index);
        });
    }

    function submitAnswer(actionType) {
        const currentQuestion = questions[currentQuestionIndex];
        const questionId = currentQuestion.dataset.questionId;
        let answerId = null;

        // Handle answer selection or skipping
        if (actionType === 'answer') {
            const selectedAnswer = currentQuestion.querySelector('input[type="radio"]:checked');
            if (!selectedAnswer) {
                Swal.fire('Error', 'Please select an answer or skip the question.', 'error');
                return false;
            }
            answerId = selectedAnswer.value;
        }

        // Save the response via AJAX
        return axios.post('/save-answer', {
            question_id: questionId,
            answer_id: answerId, // Null if skipped
        });
    }

    function moveToNextQuestion() {
    currentQuestionIndex++;
    if (currentQuestionIndex < questions.length) {
        showQuestion(currentQuestionIndex);
    } else {
        // Fetch and display results when quiz is completed
        axios.get('/quiz-results')
            .then(response => {
                if (response.data.success) {
                    const results = response.data;

                    document.getElementById('quiz-container').style.display = 'none';

                    const completionMessage = document.getElementById('completion-message');
                    completionMessage.style.display = 'block';
                    completionMessage.innerHTML = `
                        <h3>Quiz Completed!</h3>
                        <p>Total Questions: ${results.total_questions}</p>
                        <p>Answered Questions: ${results.answered_questions}</p>
                        <p>Correct Answers: ${results.correct_answers}</p>
                        <p>Skipped Questions: ${results.skipped_questions}</p>
                    `;
                }
            })
            .catch(error => {
                Swal.fire('Error', 'Unable to fetch results. Please try again.', 'error');
            });
        }
    }


    // Attach event listeners for buttons
    document.querySelectorAll('.next-btn').forEach(btn => {
        btn.addEventListener('click', async (event) => {
            event.preventDefault(); // Prevent default behavior
            try {
                await submitAnswer('answer'); // Ensure the answer is submitted
                moveToNextQuestion();
            } catch (error) {
                Swal.fire('Error', 'Unable to save the answer. Please try again.', 'error');
            }
        });
    });

    document.querySelectorAll('.skip-btn').forEach(btn => {
        btn.addEventListener('click', async (event) => {
            event.preventDefault(); // Prevent default behavior
            try {
                await submitAnswer('skip'); // Mark the question as skipped
                moveToNextQuestion();
            } catch (error) {
                Swal.fire('Error', 'Unable to save the skipped question. Please try again.', 'error');
            }
        });
    });
});

</script>
</body>
</html>

