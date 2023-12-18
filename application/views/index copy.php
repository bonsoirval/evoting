<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="< ?php echo base_url(); ?>static/js/validation.js" type="text/javascript"></script>

    < ! -- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags - - >
    <title>Online Voting System</title>

    < ! -- Bootstrap - - >
    <link href="< ?php base_url(); ?>static/css/bootstrap.min.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>

    <style>
        .headerFont {
            font-family: 'Ubuntu', sans-serif;
            font-size: 24px;
        }

        .subFont {
            font-family: 'Raleway', sans-serif;
            font-size: 14px;

        }

        .specialHead {
            font-family: 'Oswald', sans-serif;
        }

        .normalFont {
            font-family: 'Roboto Condensed', sans-serif;
        }
    </style>

</head>

<body>
    <div class="container">
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse
    " role="navigation">
            <div class="container">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-header">
                    <a href="/" class="navbar-brand headerFont text-lg">Online Voting System</a>
                </div>

                <div class="collapse navbar-collapse" id="example-nav-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="< ?php base_url(); ?>index.php/register"><span class="subFont"><strong>Register</strong></span></a></li>
                        <li><a href="< ?php base_url(); ?>index.php/login"><span class="subFont"><strong>Login</strong></span></a></li>
                    </ul>
                </div>

            </div>

    </div>
    </nav> -->

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
    <!--
    <?php
    session_start();
    if (isset($_SESSION['SESS_NAME']) != "") {
        header("Location: voter.php");
    }
    ?>
    <?php global $msg;
    echo $msg; ?>
    -->
    <main>
        <div class="container">
            <div class="container" style="padding:100px;">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="conatiner" id="featuresTab">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <div class="page-header" style="padding-top:50px;padding-bottom:50px">
                                    <img src="<?php base_url(); ?>static/images/now.png" width="440px" alt="Icon">
                                        <h1 class="specialHead" style="font-size:44px;">Online Voting System</h1>
                                        <p class="normalFont" style="font-size:24px;">Welcome!</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="conatiner" id="featuresTab">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <div class="page-header" style="padding-top:50px;padding-bottom:50px">
                                        <h1 class="normalFont" style="font-size:44px;">WHAT IS IT?</h1>
                                        <p class="subFont" style="font-size:24px;">An Interactive Way of Election</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="conatiner" style="padding:50px;" id="aboutTab">
                            <div class="row">
                                <div class="col-sm-4 text-center">
                                    <h2 class="normalFont" style="font-size:28px;"><a href="<?php base_url(); ?>register">Register</a></h2>
                                    <p>You Just Need Basic Details of Yours and We Will Let You Vote</p>
                                </div>
                                <div class="col-sm-4 text-center">
                  
                        <h2 class="normalFont" style="font-size:28px;"><a href="/profile" >Profile</a></h2>
                                    <p>Shows You Details about Your Votes. </p>

                                </div>
                                <div class="col-sm-4 text-center">

                                    <h2 class="normalFont" style="font-size:28px;"><a href="/statistic">Statitics</a></h2>
                                    <p>Shows You the Vote Results of the Election.</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            