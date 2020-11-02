<?php
if (empty($_POST)) {
    echo "We did not received anything!";

    $display = "startpage";

// $array = [1,2,3,4,5];

// $array = [0.1,0.2,0.3,0.4,0.5];

// $array = array('<foo>',"'bar'",'"baz"','&blong&', "\xc3\xa9");

// $array = array('foo' => 'bar', 'baz' => 'long');

// $array = ["apple","banana","carrot"];

// $array = ["question01", "option01", "option02", "option03", "option04", 1];

$array = [
        ["question01", "option01", "option02", "option03", "option04", 1],
        ["question02", "option01", "option02", "option03", "option04", 2],
        ["question03", "option01", "option02", "option03", "option04", 3],
        ["question04", "option01", "option02", "option03", "option04", 4],
        ["question05", "option01", "option02", "option03", "option04", 1],
    ];


//Method of encoding


$postvalue = serialize($array);

// $postvalue = json_encode($array);

// $postvalue = implode(',',$array);


} else {


    print "hello!<br>";

    $display = $_POST['display'];
    $newArray = $_POST['array'];

    echo $display;

    //Method of decoding
    $newArray = unserialize($newArray);

    // $newArray = json_decode($newArray);

    // $newArray = explode(',',$newArray);

    print_r($newArray);

for ($x = 0; $x<5; $x++){

    for ($y =0 ;$y<6; $y++){
        echo $newArray[$x][$y];
    }
    echo "<br>";

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
            <h1>Welcome to Experiment</h1>
            <form action="" method="POST">
                <?php
                if ($display == "startpage") {
                ?>


                    <input type="hidden" name="display" value="page01">
                    <input type="hidden" name="array" value=<?php echo $postvalue; ?>>
                    <input type="submit" value="Click me!">



                <?php
                }
                if ($display == "page01") {
                ?>
                    <!-- echo "<h1>Welcome to page 1"; -->
                    <h1> welcome to page 1</h1>

                    <input type="hidden" name="display" value="page02">
                    <input type="submit" value="Click me!">

                <?php
                }
                ?>
            </form>
        </div>
    </main>

    <!-- Footer bar  -->
    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>