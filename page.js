document.addEventListener("DOMContentLoaded", function() {
    const createQuizForm = document.getElementById("createQuizForm");
    const quizQuestions = document.getElementById("quizQuestions");
    const questionsContainer = document.getElementById("questionsContainer");
    const addQuestionBtn = document.getElementById("addQuestionBtn");
    const finalizeQuizBtn = document.getElementById("finalizeQuizBtn");
    let questionCount = 0;
  
    createQuizForm.addEventListener("submit", function(event) {
      event.preventDefault();
      quizQuestions.style.display = "block";
      createQuizForm.style.display = "none";
      addQuestion(); // Add initial question field
    });
  
    addQuestionBtn.addEventListener("click", function() {
      if (questionCount < 10) {
        addQuestion();
        questionCount++;
      } else {
        alert("You can't add more than 10 questions!");
      }
    });
  
    finalizeQuizBtn.addEventListener("click", function() {
      // Code to finalize the quiz
      alert("Quiz finalized!");
    });
  
    function addQuestion() {
      const questionDiv = document.createElement("div");
      questionDiv.classList.add("question");
  
      const questionInput = document.createElement("input");
      questionInput.type = "text";
      questionInput.placeholder = "Enter question";
      questionInput.required = true;
  
      const removeBtn = document.createElement("button");
      removeBtn.textContent = "Remove";
      removeBtn.addEventListener("click", function() {
        questionDiv.remove();
        questionCount--;
      });
  
      questionDiv.appendChild(questionInput);
      questionDiv.appendChild(removeBtn);
      questionsContainer.appendChild(questionDiv);
    }
  });
  