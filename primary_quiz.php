<?php

//Storing of questions in a multi-dimension array.
//$qns_array[x][0] is the question.
//$qns_array[x][5] is the correct answer.
//$qns_array[x][1-4] are the options.
//They are in the following format. 
// $qns_array = [
//     ["question01", "option01", "option02", "option03", "option04", 1],
//     ["question02", "option01", "option02", "option03", "option04", 2],
//     ["question03", "option01", "option02", "option03", "option04", 3],
//     ["question04", "option01", "option02", "option03", "option04", 4],
//     ["question05", "option01", "option02", "option03", "option04", 1],
// ];

$qns_array =
    [
        ["What does BMI stands for?", "Big Mac Index", "Best Machine Idea", "Body Mass Index", "Boring Measurement Indicator", 3],
        ["How do you calculate BMI?", "E=mc2", "Weight(in Kg) / Height2(in m)", "Length x Breath", "&pi;r2", 2],
        ["Which one is not a categories of BMI?", "featherweight", "Overweight", "Underweight", "Obese", 1],
        ["I have a BMI of 27.0, I am _________?", "Healthy weight", "Overweight", "Underweight", "Obese", 1],
        ["I have a BMI of 35.0, I am _________?", "Healthy weight", "Overweight", "Underweight", "Obese", 4]
    ];


// section 1 :: startpage
if (empty($_POST)) {
    $display = "startpage";
} else {

    $display = $_POST['display'];


    // Section 2 :: display_question
    if ($display == "display_question") {


        //Note 2.1 :: $qns_seq is to store the sequence of the questions. 
        $qns_seq_array = [];
        $qns_seq = "";
        for ($x = 0; $x < count($qns_array); $x++) {
            array_push($qns_seq_array, $x);
        }
        shuffle($qns_seq_array);
        foreach ($qns_seq_array as $value) {
            $qns_seq = $qns_seq . $value;
        }
    }
    // Section 3 :: tabulation of results
    elseif ($display == "results") {

        $answer0 = $_POST['answer0'];
        $answer1 = $_POST['answer1'];
        $answer2 = $_POST['answer2'];
        $answer3 = $_POST['answer3'];
        $answer4 = $_POST['answer4'];
        $qns_seq = $_POST['qns_seq'];
        //putting the answer in array for checking the result. 
        $ans_array = [$answer0, $answer1, $answer2, $answer3, $answer4];
    }
}


?>

<htmL>

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
                <div class="col-xl-12">
                    <form action="" method="POST">

                        <?php
                        if ($display == "startpage") {
                        ?>
                            <!-- Section 1 :: startpage -->
                            <!-- When the page first loaded, an introduction is display    -->
                            <p class="Display-4 text dark">Do you know what is BMI?</p>
                            <p class="h3 text-dark">How about taking a quiz on BMI?</p>
                            <p class="text-dark">You will be given 5 questions. The questions will be randomly assigned. <br>The questions will be display in a single page.<br>Click the Start Quiz button when you are ready.</p>

                            <input type="hidden" name="display" value="display_question">
                            <input type="submit" value="Start Quiz">

                        <?php
                        } elseif ($display == "display_question") {
                        ?>
                            <!-- Section 2 :: display_question -->
                            <!-- When the start quiz is pressed, It will display the questions.  -->
                            <!-- The shuffled questions are stored as qns_seq -->
                            <div class="container">
                                <?php
                                for ($x = 0; $x < 5; $x++) {
                                    $curr_question = substr($qns_seq, $x, 1);
                                ?>

                                    <div class="qnsBox">
                                        <p class="text-primary mb-0">Question #<?php echo $x + 1; ?></p>
                                        <p class="h3"><?php echo $qns_array[$curr_question][0]; ?></p>

                                        <!-- display the MCQ options in a inner for loop  -->
                                        <?php
                                        for ($y = 1; $y < 5; $y++) {
                                        ?>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="<?php echo "answer" . $x; ?>" value="<?php echo $y; ?>" required>
                                                <label class="form-check-label" for="exampleRadios1">
                                                    <?php echo $qns_array[$curr_question][$y]; ?>
                                                </label>
                                            </div>

                                        <?php
                                        }
                                        ?>
                                        <!-- End of inner for loop  -->
                                    </div>

                                <?php
                                }
                                ?>

                                <input type="hidden" name="qns_seq" value="<?php echo $qns_seq; ?>">
                                <input type="hidden" name="display" value="results">
                                <input type="submit" value="Submit">
                            </div>


                        <?php
                        } else {
                        ?>
                            <!-- Section 3 :: results  -->
                            <!-- When the user submitted their answers -->
                            <h1>Results</h1>
                            <div class="container">

                                <div class="row">
                                    <div class="col-12 col-md-8">
                                        <?php
                                        $correct = 0;
                                        for ($x = 0; $x < 5; $x++) {
                                            $curr_question = substr($qns_seq, $x, 1);
                                            $temp = $x + 1;

                                            echo "<p class=\"text-Primary mb-0\">Question {$temp}</p>";
                                            echo "<p class=\"h3 text-dark \"> {$qns_array[$curr_question][0]}</p>";

                                            if ($ans_array[$x] == $qns_array[$curr_question][5]) {
                                                echo "<p class=\"text-success mt-0\"><span class=\"h3\"> &#10004</span>{$qns_array[$curr_question][$ans_array[$x]]}</p><br>";
                                                $correct++;
                                            } else {
                                                $temp = $qns_array[$curr_question][5];
                                                echo "<p class=\"text-danger mt-0\"><span class=\"h3\"> &#10006;</span> <del>{$qns_array[$curr_question][$ans_array[$x]]}</del> <span class=\"text-success mt-0\">{$qns_array[$curr_question][$temp]} </span></p><br>";
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="scorecard">
                                            <h1>Scorecard</h1>
                                            <p>Your score is <?php echo $correct . "."; ?><br></p>
                                            <a href="primary_quiz.php">Retake the quiz</a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                            ?>
                    </form>
                </div>
            </div>
        </div>
        <br><br>
    </main>

    <!-- Footer bar  -->
    <?php include 'footer.php'; ?>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>