<?php
session_start();
?>

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

    /* Add your additional CSS styles here */
  </style>
</head>
<body>
  <nav class="navbar">
    <div class="logo">Quiz App</div>
  </nav>

  <div class="container">
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
        <!-- Add other options as needed -->
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
  </div>

  <script>
    window.onload = function() {
      <?php
      $success = $_SESSION['success'];
      if ($success) {
      ?>
        console.log('before quiz');
        function startQuiz() {
          const num = document.getElementById('num-questions').value;
          const category = document.getElementById('category').value;
          const difficulty = document.getElementById('difficulty').value;
          const time = document.getElementById('time').value;

          // Call API or perform quiz setup based on selected options
          console.log('Starting quiz with settings:', num, category, difficulty, time);
          const url = `https://opentdb.com/api.php?amount=${num}&category=${category}&difficulty=${difficulty}&type=multiple`;
          fetch(url)
            .then((res) => res.json())
            .then((data) => {
              questions = data.results;
              console.log(questions);
              var length = questions.length;
              var i = 0;
              setTimeout(() => {
                while(length > 0) {
                  const quiz = document.getElementById("quiz");
                  const question = document.createElement('p');
                  question.innerHTML = questions[i].question;
                  const Wop1 = document.createElement('p');
                  const Wop2 = document.createElement('p');
                  const Wop3 = document.createElement('p');
                  const Cop = document.createElement('p');
                  quiz.innerHTML = "";
                  quiz.appendChild(question);
                  i++;
                  length--;
                }
              }, 5000);
          });
        }

        startQuiz();
        <?php
        $_SESSION['success'] = false;
      }
      ?>
    };
  </script>

</body>
</html>
