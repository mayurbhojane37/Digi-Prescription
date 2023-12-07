<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/style.css">

    <title>Prescription</title>
    <style>
        .dashbord-tables,
        .doctor-heade {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table,
        #anim {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .doctor-heade {
            animation: transitionIn-Y-over 0.5s;
        }
    </style>


</head>

<body>
    <?php

    //learn from w3schools.com
    
    session_start();

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'd') {
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }

    } else {
        header("location: ../login.php");
    }


    //import database
    include("../connection.php");
    $userrow = $database->query("select * from doctor where docemail='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["docid"];
    $username = $userfetch["docname"];


    //echo $userid;
    //echo $username;
    
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title">
                                        <?php echo substr($username, 0, 13) ?>..
                                    </p>
                                    <p class="profile-subtitle">
                                        <?php echo substr($useremail, 0, 22) ?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Log out"
                                            class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-dashbord ">
                        <a href="index.php" class="non-style-link-menu ">
                            <div>
                                <p class="menu-text">Dashboard</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-appoinment">
                <a href="appointment.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">My Appointments</p>
                </a>
    </div>
    </td>
    </tr>

    <tr class="menu-row">
        <td class="menu-btn menu-icon-session">
            <a href="schedule.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">My Sessions</p>
                </div>
            </a>
        </td>
    </tr>

    <tr class="menu-row">
        <td class="menu-btn menu-active menu-icon-appoinment menu-icon-appoinment-active">
            <a href="prescription.php" class="non-style-link-menu non-style-link-menu-active">
                <div>
                    <p class="menu-text">Prescription</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-patient">
            <a href="patient.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">My Patients</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-settings">
            <a href="settings.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Settings</p>
            </a></div>
        </td>
    </tr>

    </table>
    </div>
    <div class="dash-body" style="margin-top: 15px">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">

            <tr>

                <td colspan="1" class="nav-bar">
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;"> Digi Prescription
                    </p>

                </td>
                <td width="25%">

                </td>
                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                        Today's Date
                    </p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        <?php
                        date_default_timezone_set('Asia/Kolkata');

                        $today = date('Y-m-d');
                        echo $today;


                        $patientrow = $database->query("select  * from  patient;");
                        $doctorrow = $database->query("select  * from  doctor;");
                        $appointmentrow = $database->query("select  * from  appointment where appodate>='$today';");
                        $schedulerow = $database->query("select  * from  schedule where scheduledate='$today';");


                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img
                            src="../img/calendar.svg" width="100%"></button>
                </td>


            </tr>
            <tr>
                <td colspan="4">

                    <center>
                        <table class="filter-container doctor-header" style="border: none;width:95%" border="0">
                            <tr>
                                <td>
                                    <h3>Welcome!</h3>
                                    <h1>
                                        <?php echo $username ?>.
                                    </h1>
                                    <p>Thanks for joinnig with us. We are always trying to get you a complete
                                        service<br>
                                        You can create a prescription of patient digitally !<br><br>
                                    </p>
                                    <a href="#create_prescription" class="non-style-link scrollto"><button
                                            class="btn-primary btn" style="width:30%">Prescription</button></a>
                                    <br>
                                    <br>
                                </td>
                            </tr>
                        </table>
                    </center>

                </td>
            </tr>
        </table>
        <center>
            <div class="containera">
                <form method="post" action="pdf.php" name="f1">
                    <h2>Create Digital Prescription here...</h2>
                    <div class="content">
                        <div class="input-box">
                            <label for="name">Patient Name :</label>
                            <input type="text" id="patientname" placeholder="Enter Patient Name..." name="patientname" required onclick="recordname()">
                        </div>
                        <div class="input-box">
                            <label for="name">Complaint :</label>
                            <input type="text" id="complaint"  placeholder="Complaint..." name="complaint" required onclick="recordcomplaint()">
                        </div>
                        <div class="input-box">
                            <label for="name">Observation :</label>
                            <input type="text" id="observation" placeholder="Observation..." name="observation" required onclick="recordobservation()">
                        </div>
                        <div class="input-box">
                            <label for="name">Diagnosis :</label>
                            <input type="text" id="diagnosis" placeholder="Diagnosis..." name="diagnosis" required onclick="recorddiagnosis()">
                        </div>
                        <div class="input-box">
                            <label for="name">Medicine :</label>
                            <input type="text" id="medicine" placeholder="Medicine..." name="medicine" required onclick="recordmedicine()">
                        </div>
                        <span class="gender-title">Gender :</span>
                        <div class="gender-category">
                            <input type="radio" name="gender" id="male" value="male" required>
                            <label for="gender">Male</label>
                            <input type="radio" name="gender" id="female" value="female" required>
                            <label for="gender">Female</label>
                            <input type="radio" name="gender" id="other" value="other" required>
                            <label for="gender">Other</label>
                        </div>
                    </div>
                    <div class="button-container">
                        <button type="submit" name="createprescription" value="pdf.php" onclick="this.form.target='_blank';">Create Prescription</button>
                       <!--<button type="submit" name="createpdf" value="pdf.php" onclick="f1.action='pdf.php';f1.target='_blank';">Create PDF</button>-->
                    </div>
                </form>
            </div>
            <div class="create_prescription" id="create_prescription"></div>
    </center>
    <script>
        function recordname(){
            var recognition= new webkitSpeechRecognition();
                recognition.lang="en-GB";
                recognition.onresult=function(event){
                    document.getElementById('patientname').value=event.results[0][0].transcript;
                }
                recognition.start();
                //alert('Now create a prescription using voice command');
        }
        function recordcomplaint(){
            var recognition= new webkitSpeechRecognition();
                recognition.lang="en-GB";
                recognition.onresult=function(event){
                    document.getElementById('complaint').value=event.results[0][0].transcript;
                }
                recognition.start();
        }
        function recordobservation(){
            var recognition= new webkitSpeechRecognition();
                recognition.lang="en-GB";
                recognition.onresult=function(event){
                    document.getElementById('observation').value=event.results[0][0].transcript;
                }
                recognition.start();
        }
        function recorddiagnosis(){
            var recognition= new webkitSpeechRecognition();
                recognition.lang="en-GB";
                recognition.onresult=function(event){
                    document.getElementById('diagnosis').value=event.results[0][0].transcript;
                }
                recognition.start();
        }
        function recordmedicine(){
            var recognition= new webkitSpeechRecognition();
                recognition.lang="en-GB";
                recognition.onresult=function(event){
                    document.getElementById('medicine').value=event.results[0][0].transcript;
                }
                recognition.start();
        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
