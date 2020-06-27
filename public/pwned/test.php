<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sage Link - Hacked DB</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body >

<div class="container">
    <h1 align="center">Hacked DB</h1>
    <h2 align="center">Provided as a free service by Sage Link Computing.</h2>
    <h3 align="center">Uses the HaveIBeenPwned API</h3>

    <div style="display: flex; justify-content: center;">
        <img src=Haveibeenpwned.png height="210" alt="Have I been Pwned" >
        <br>
    </div>
    <br>


    <p align="center">Enter your name and email here to check if you appear in any data breach.</p>
    <div style="display: flex; justify-content: center;">
        <br />
        <form action="check.php" method="POST" >
            <div class="form-group">
                <label for="Name">Name:</label>
                <input type="text" class="form-control" id="Name" name="Name">
            </div>
            <div>
                <label for="Email">Email address:</label>
<!--                <input type="email" class="form-control" id="Email" name="Email">-->
                <textarea class="form-control" rows="8" cols="50" name="Email">Emails, one per row</textarea>
            </div>
            <button type="submit" class="btn btn-danger">Have I been Pwned</button>

        </form>
    </div>
</body>
</html>
