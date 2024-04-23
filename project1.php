<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz App</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <link rel="stylesheet" href="project.css">
  <style>
    /* Add your CSS styles here */
    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background-color: transparent;
      color: #fff;
      padding: 10px 0;
      text-align: center;
    }

    .navbar .logo {
      font-size: 24px;
      font-weight: bold;
    }

    .container {
      margin-top: 80px;
      text-align: center;
    }

    select {
      margin-right: 10px;
    }

    .btn {
      margin-top: 20px;
      padding: 10px 20px;
      font-size: 16px;
      background-color: #007bff;
      color: #fff;
      border: none;
      cursor: pointer;
    }

    /* CSS styles for questions and options */
    .question {
      margin-bottom: 20px;
      font-size: 18px;
      font-weight: bold;
    }

    .option {
      font-size: 16px;
      padding: 10px;
      margin-bottom: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .option:hover {
      background-color: #f0f0f0;
    }

    /* CSS styles for correct answer */
    .correctstyle {
      border: 2px solid green;
      transition: border-color 0.3s ease;
    }

    /* CSS styles for incorrect answer */
    .incorrect {
      border: 2px solid red;
      transition: border-color 0.3s ease;
    }
  </style>
</head>
<body>
  <nav class="navbar">
    <div class="logo">Quiz App</div>
  </nav>

  <div class="container">
    <div id="form" display="initial">
    <form id="quizSettingsForm" action="quizinfo.php" method="POST">
      <label for="num-questions">Number of Questions:</label>
      <select id="num-questions" name="num-questions">
        <option value="5">5</option>
        <option value="10">10</option>
      </select>

      <label for="category">Category:</label>
      <select id="category" name="category">
        <option value="">Any Category</option>
        <option value="9">General Knowledge</option>
        <option value="10">books</option>
        <option value="11">films</option>
        <option value="12">music</option>
        <option value="14">television</option>
        <option value="15">video games</option>
        <option value="16">board games</option>
        <option value="17">science and nature</option>
        <option value="18">computers</option>
        <option value="19">mathematics</option>
        <option value="20">mythology</option>
        <option value="21">sports</option>
        <option value="22">geography</option>
        <option value="23">history</option>
        <option value="24">politics</option>
        <option value="25">art</option>
        <option value="28">vehicles</option>

      </select>

      <label for="difficulty">Difficulty:</label>
      <select id="difficulty" name="difficulty">
        <option value="">Any Difficulty</option>
        <option value="easy">Easy</option>
        <option value="medium">Medium</option>
        <option value="hard">Hard</option>
      </select>

      <label for="time">Time per Question:</label>
      <select id="time" name="time">
        <option value="10">10 seconds</option>
        <option value="15">15 seconds</option>
      </select>

      <button type="submit" id="startQuiz" class="btn">Start Quiz</button>
    </form>
    </div>
    <div id="quiz">
      <!-- Container for questions and options -->
    </div>
  </div>

  <script>
    window.onload = function() {
      <?php
      session_start();
      $success = $_SESSION['success'];
      if ($success) {
      ?>
        console.log('before quiz');
        function startQuiz() {
        const num = document.getElementById('num-questions').value;
        const category = document.getElementById('category').value;
        const difficulty = document.getElementById('difficulty').value;
        const time = document.getElementById('time').value;

        document.getElementById("form").style.display = "none"; // Hide the form

      // Call API or perform quiz setup based on selected options
      console.log('Starting quiz with settings:', num, category, difficulty, time);
      const url = `https://opentdb.com/api.php?amount=${num}&category=${category}&difficulty=${difficulty}&type=multiple`;
      fetch(url)
        .then((res) => res.json())
        .then((data) => {
          questions = data.results;
          console.log(questions);
          let i = 0;
          const delay = time * 1000; // Convert time to milliseconds
          displayQuestion(i, delay);        
        });
    }

    function displayQuestion(index, delay) {
      const quiz = document.getElementById("quiz");
      quiz.innerHTML = ""; // Clear the quiz container
            
      const ques = document.createElement("div");
      const options = document.createElement("div");

      const question = document.createElement('p');
      question.classList.add('question'); // Add a class to apply CSS styles

      const Wop1 = document.createElement('p');
      const Wop2 = document.createElement('p');
      const Wop3 = document.createElement('p');
      const Cop = document.createElement('p');
      Wop1.classList.add('option');
      Wop2.classList.add('option');
      Wop3.classList.add('option');
      Cop.classList.add('option', 'correct'); 

      question.innerHTML = questions[index].question;
      Wop1.innerHTML = questions[index].incorrect_answers[0];
      Wop2.innerHTML = questions[index].incorrect_answers[1];
      Wop3.innerHTML = questions[index].incorrect_answers[2];
      Cop.innerHTML = questions[index].correct_answer;

      ques.appendChild(question);
      options.appendChild(Wop1);
      options.appendChild(Wop2);
      options.appendChild(Wop3);
      options.appendChild(Cop);

      quiz.appendChild(ques);
      quiz.appendChild(options);

      if (index + 1 < questions.length) {
        setTimeout(() => {
          displayQuestion(index + 1, delay); // Display next question after a delay
        }, delay); // Adjust the delay as needed
      }
    }

        startQuiz();
        <?php
        $_SESSION['success'] = false;
      }
      ?>
    };

    document.addEventListener('DOMContentLoaded', function() {
      const quizContainer = document.getElementById('quiz');

      // Event listener for clicks on options
      quizContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('option')) {
          const selectedOption = event.target;
          const correctOption = selectedOption.parentElement.querySelector('.correct');

          // Remove previous correct and incorrect answer styles
          const options = quizContainer.querySelectorAll('.option');
          options.forEach(option => {
            option.classList.remove('correct', 'incorrect');
          });

          // Highlight the selected option
          selectedOption.classList.add('selected');

          // Highlight the correct option
          correctOption.classList.add('correct');

          // Highlight incorrect options
          if (selectedOption !== correctOption) {
            selectedOption.classList.add('incorrect');
          }else{
            selectedOption.classList.add('correctstyle');
          }
        }
      });
    });
  </script>

</body>
</html>
