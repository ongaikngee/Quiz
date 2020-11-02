<?php
// Setting the questions for the quiz in multi-dimension arrays.
// Array[0] being Questions
// Array[1-4] being options
// Array[5] being answer
$question =
    [
        ["What does BMI stands for?", "Big Mac Index", "Best Machine Idea", "Body Mass Index", "Boring Measurement Indicator", 3],
        ["How do you calculate BMI?", "E=mc2", "Weight(in Kg) / Height2(in m)", "Length x Breath", "&pi;r2", 2],
        ["Which one is not a categories of BMI?", "featherweight", "Overweight", "Underweight", "Obese", 1],
        ["I have a BMI of 27.0, I am _________?", "Healthy weight", "Overweight", "Underweight", "Obese", 1],
        ["I have a BMI of 35.0, I am _________?", "Healthy weight", "Overweight", "Underweight", "Obese", 4]
    ];

if (!empty($_GET)) {

    //Getting values from $_GET
    $start = $_GET["start"]; //Is this needed, Shall explore
    $qnsnumber = $_GET["qnsnumber"];
    $score = $_GET["score"];
    $answer = $_GET["answer"];
    $qns_seq = $_GET["qns_seq"];

    if ($start) {
        // echo "Dealer, Shuffle and deal!";
    } else {
        //check answer
        // This is to find out what was the previous question asked.
        // It is using the $qns_seq (Which store the question position), 
        // and by using substr to abstract the question with $qnsnumber.
        $prev_question = substr($qns_seq, $qnsnumber - 1, 1);

        if ($answer == $question[$prev_question][5]) {
            $score++;
            $correct = true;
        } else {
            $correct = false;
            $correctAnswer = $question[$prev_question][5];
            $correctAnswer = $question[$prev_question][$correctAnswer];
        }
    }
} else {

    //This is where the quiz is initialise. 
    $score = $qnsnumber = 0;

    //Setting the ramdom display of questions. 
    //The sequence of the questions is shuffled and stored as string ($qns_seq)
    //$qns_seq will output as "24103", but the number will be random. It will be store in hidden forms
    $qns_seq_array = [0, 1, 2, 3, 4];
    $qns_seq = "";
    shuffle($qns_seq_array);
    foreach ($qns_seq_array as $value) {
        $qns_seq = $qns_seq . $value;
    }
}

?>


<html>

<head>
    <title>Welcome to Dr JJ's Clinic</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Header link  -->
    <?php include 'header.php'; ?>

    <!-- navigation bar  -->
    <?php include 'navbar.php'; ?>

    <main>
        <div class="container">
            <div class="row">
                
                <div class="col-12 col-lg-8">



                    <form action="" method="GET">
                        <?php
                        //This is the flow of the page.

                        //Start of intro Page
                        if (empty($_GET)) {  //When User first came into the page. Intro to the Quiz.
                            echo "<p class=\"Display-4 text-dark \">Do you know what is BMI?</p>";
                            echo "<p class=\"h3 text-dark \">How about taking a quiz on BMI?</p>";
                            echo "<p class=\"text-dark \">You will be given 5 questions. The questions will be randomly assigned. <br>Click on submit after each question.<br>Click the Start Quiz button when you are ready.</p>";
                            echo "<input type=\"hidden\" id=\"start\" name=\"start\" value=\"1\">";
                            echo "<input type=\"hidden\" id=\"qnsnumber\" name=\"qnsnumber\" value=\"0\">";
                            echo "<input type=\"hidden\" id=\"score\" name=\"score\" value=\"0\">";
                            echo "<input type=\"hidden\" id=\"qns_seq\" name=\"qns_seq\" value=$qns_seq>";
                            echo "<input type=\"submit\" value=\"Start Quiz\">";
                        } elseif ($qnsnumber == 5) { //If 5 Questions are attempted
                            echo "<br><br><p>That's the end of the quiz. You have attempt all 5 questions.</p>";
                            echo "<h1>Your score is " . $score . ".</h1>";
                        } else {

                            //find out the right question to pull out.
                            // This is where I use the $qnsnumber to search the $qns_seq for the index number questions
                            $curr_question = substr($qns_seq, $qnsnumber, 1);

                            //Display of Question
                            echo "<br><br><p class=\"text-primary\">Question " . ($qnsnumber + 1) . " of " . count($question) . "</p>";
                            echo "<p class=\"h2 text-dark\">" . $question[$curr_question][0] . "</p><br>";
                        ?>

                            <!-- Displaying all the radio button  -->
                            <!-- attached the correct MCQ to the questions  -->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" id="exampleRadios1" value="1" required>
                                <label class="form-check-label" for="exampleRadios1">
                                    <?php echo $question[$curr_question][1]; ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" id="exampleRadios2" value="2">
                                <label class="form-check-label" for="exampleRadios2">
                                    <?php echo $question[$curr_question][2]; ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" id="exampleRadios3" value="3">
                                <label class="form-check-label" for="exampleRadios3">
                                    <?php echo $question[$curr_question][3]; ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" id="exampleRadios4" value="4">
                                <label class="form-check-label" for="exampleRadios4">
                                    <?php echo $question[$curr_question][4]; ?>
                                </label>
                            </div>
                            <br>


                        <?php
                            //ready to move to the next question.
                            $qnsnumber++;
                            echo "<input type=\"hidden\" id=\"qnsnumber\" name=\"qnsnumber\" value=$qnsnumber>";
                            echo "<input type=\"hidden\" id=\"score\" name=\"score\" value=$score>";
                            echo "<input type=\"hidden\" id=\"qns_seq\" name=\"qns_seq\" value=$qns_seq>";
                            echo "<input type=\"submit\" value=\"Submit\">";
                        }
                        ?>
                    </form>

                </div>
                <div class="col-12 col-lg-4">
                    <!-- This is where I will place the feedback of the last question  -->
                    <div class="container forFeedback"><br><br><br>
                        <?php
                        // Display of feedback 
                        if ($qnsnumber > 1 && $qnsnumber < 6) {
                            if ($correct) {
                                echo "<p class=\"bg-success\">Your Answer is Correct!<br>";
                            } else {
                                echo "<p class=\"bg-danger text-light\">Answer: $correctAnswer<br>";
                            }

                            echo "<span class=\"h3\">Your score is $score.</span></p>";
                            // echo "<a href=quiz.php>Reset Quiz</a>";
                        }

                        ?>
                    </div>
                    <!-- End of feedback  -->

                </div>
            </div>
        </div>

    </main>

    <!-- Footer bar  -->
    <?php include 'footer.php'; ?>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>