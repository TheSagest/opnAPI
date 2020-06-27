<!DOCTYPE html>
<html lang="en">
<title>Sage Link - Hacked DB</title>
<head>
    <title>Sage Have I Been Pwned</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body >

<?php

$Name = $Email ="";
$api = "0eef96ce909a466881b38da3f312f100";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name = test_input($_POST["Name"]);
    $Email = test_input($_POST["Email"]);
}
else
{
//    Shouldn't go directly here
    echo "done!!";
    die();
}

$ch = curl_init();

foreach (explode(PHP_EOL, $Email) as $myMail ){

    if (filter_var($myMail, FILTER_VALIDATE_EMAIL)) {

    // set url
$URL = "breachedaccount/"  . urlencode($myMail)  ;
curl_setopt($ch, CURLOPT_URL, "https://haveibeenpwned.com/api/v3/" . $URL );
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
"hibp-api-key:" . $api,
"user-agent:SageLink "
));

//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
$json = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// close curl resource to free up system resources
curl_close($ch);

$array = json_decode($json, true);

echo '<div class="container">';
echo '<h1>You have been Pwned! ' . $myMail . ' </h1> </br></br>';


// Need to loop through  each response and display the results.
    foreach ($array as $name){



    $breach = $name['Name'];

    // Set up and get details of this breach
    $ch = curl_init();
    $URL = "breach/"  . $breach  ;
    curl_setopt($ch, CURLOPT_URL, "https://haveibeenpwned.com/api/v3/" . $URL );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $json = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Decode the JSON response
    $breach_detail =  json_decode($json, true);



    ?>
    <div class="row" class="bg-primary" style="margin-top: 10px;" >

        <div class="col-sm-2" >
            <?php echo "<img src=" . $breach_detail['LogoPath'] . " alt='Breach Logo' style='width:120px;'>" ; ?>
        </div>

        <div class="col-sm-3" style="background-color:darkgrey; border-radius: 15px;">
            <?php echo "<h1>" . $breach_detail['Name'] . "</h1>" ; ?>
        </div>

        <div class="col-sm-2" style="background-color:darkgrey; border-radius: 15px;">
            <?php echo "<h3>Domain</h3>" .  $breach_detail['Domain']; ?>
        </div>
        <div class="col-sm-2" style="background-color:darkgrey; border-radius: 15px;">
            <?php echo "<h3>Date</h3>" . $breach_detail['BreachDate']; ?>
        </div>
        <div class="col-sm-3 " style="background-color:darkgrey; border-radius: 15px;">
            <?php echo "<h3>Total Number.</h3>" . $breach_detail['PwnCount']; ?>
        </div>
    </div>

        <div class="p-5">
            <div class="row " style="margin-top: 10px;  ">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10  " style="background-color:darkgrey; border-radius: 15px;" class="text-success">
                    <?php echo  $breach_detail['Description'] ; ?>
                </div>
            </div>
        </div>
        <hr style ='height: 0pt; border: none; border-top: 2pt solid black;'/>
    <?php
}
    }
}

?>

</body>
</html>
