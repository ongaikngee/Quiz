<?php
$weight = $height = $result = $error = "";

if (!empty($_GET)) {
    // echo "We received results!\n";
    // echo "Here they are: ". json_encode($_GET);

    $weight = $_GET["weight_field"];
    $height = $_GET["height_field"];

    if (empty($height) && empty($weight)) {
        $error =  "We didn't get a weight or a height!";
    } elseif (!empty($height) && empty($weight)) {
        $error =  "We didn't get a weight!";
    } elseif (empty($height) && !empty($weight)) {
        $error = "We didn't ger a height!";
    } else {
        $result = round($weight / ($height * $height), 1);
        // echo "Your BMI is $result";
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

                    <h1>BMI - Body Mass Index</h1>

                    <form action="" method="GET">
                        <label for="weight">Weight (kg)</label><br>
                        <input type="text" name="weight_field" id="weight" placeholder="Enter your weight" value="<?php if (!empty($weight)) {
                                                                                                                        echo $weight;
                                                                                                                    } ?>" require><br>
                        <label for="height">Height (m)</label><br>
                        <input type="text" name="height_field" id="height" placeholder="Enter your height" value="<?php if (!empty($height)) {
                                                                                                                        echo $height;
                                                                                                                    } ?>" require><br><br>
                        <!-- <input type="Submit" value="Calculate" class="btn-primary"> for later in PHP -->
                        <input onlick="calubmi()" type="Submit" value="Calculate" class="btn-primary">
                        <!--For Javascript-->
                    </form>

                    <div class="result">
                        <br>

                        <?php
                        if (!empty($error)) {
                            echo "<strong class=\"text-danger\">Error</strong>";
                            echo "<p class=\"text-danger\">$error</p>";
                        }

                        if (!empty($result)) {
                            echo "<strong class=\"text-primary\">Result</strong>";
                            echo "<p class=\"text-primary\">Your BMI is $result.</p>";
                            if ($result < 18.5) {
                                echo "<p class=\"text-danger\">You are underweight.</p>";
                            } elseif ($result > 30) {
                                echo "<p class=\"text-danger\">You are obese.</p>";
                            } elseif ($result > 25) {
                                echo "<p class=\"text-danger\">You are overweight.</p>";
                            } else {
                                echo "<p class=\"text-primary\">Your weight is okay.</p>";
                            }
                        }

                        ?>

                    </div>
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