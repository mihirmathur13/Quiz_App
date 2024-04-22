document.addEventListener("DOMContentLoaded", function() {
    // Get the quizCount span element
    const quizCountSpan = document.getElementById("quizCount");

    // Initially set the quiz count to 0
    let quizCount = 0;

    // Function to update the quiz count
    function updateQuizCount() {
        quizCountSpan.textContent = quizCount;
    }

    // Function to add a finished quiz to the list
    function addFinishedQuiz(quizName) {
        const quizListDiv = document.getElementById("quizList");
        const newQuizItem = document.createElement("div");
        newQuizItem.textContent = quizName;
        quizListDiv.appendChild(newQuizItem);
    }

    // Example of adding a finished quiz (you can call this function when a quiz is finished)
    addFinishedQuiz("Example Quiz");

    // Update the quiz count initially
    updateQuizCount();

    // Redirect to create quiz page when "Create Quiz" button is clicked
    const createQuizBtn = document.getElementById("createQuizBtn");
    createQuizBtn.addEventListener("click", function() {
        window.location.href = "AdminPage.html";
    });
});

