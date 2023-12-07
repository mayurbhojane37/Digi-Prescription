<?php
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

date_default_timezone_set('Asia/Kolkata');
    $today = date('Y-m-d');
                        
if(!empty($_POST['createprescription'])){
    $patientname=$_POST['patientname'];
    $complaint=$_POST['complaint'];
    $observation=$_POST['observation'];
    $diagnosis=$_POST['diagnosis'];
    $medicine=$_POST['medicine'];
    $gender=$_POST['gender'];
    

    require("fpdf/fpdf.php");
    $pdf=new FPDF();
    $pdf->AddPage();
    $pdf->SetFont("Arial","B",14);
    $pdf->Cell(0,10,"      ",0,1,'C');
    $pdf->Cell(0,10,"Prescription Details",1,1,'C');
    $pdf->Cell(0,10,"      ",0,1,'C');
    $pdf->Cell(0,10,"      ",0,1,'C');
    $pdf->SetFont("Arial","",14);
    $pdf->Cell(0,10,"Doctor Name : $username",0,0,'L');
    $pdf->Cell(0,10,"Date : $today",0,1,'R');
    $pdf->Cell(0,10,"_______________________________________________________________________________________",0,1,'C');
    $pdf->Cell(0,10,"      ",0,1,'C');
    $pdf->Cell(0,10,"Patient Name : $patientname",0,1,'L');
    $pdf->Cell(0,10,"      ",0,1,'C');
    $pdf->Cell(0,10,"Complaint : $complaint",0,1,'L');
    $pdf->Cell(0,10,"      ",0,1,'C');
    $pdf->Cell(0,10,"      ",0,1,'C');
    $pdf->Cell(0,10,"      ",0,1,'C');
    $pdf->Cell(0,10,"Observation : $observation",0,1,'L');
    $pdf->Cell(0,10,"      ",0,1,'C');
    $pdf->Cell(0,10,"      ",0,1,'C');
    $pdf->Cell(0,10,"      ",0,1,'C');
    $pdf->Cell(0,10,"Diagnoss :  $diagnosis",0,1,'L');
    $pdf->Cell(0,10,"      ",0,1,'C');
    $pdf->Cell(0,10,"      ",0,1,'C');
    $pdf->Cell(0,10,"      ",0,1,'C');
    $pdf->Cell(0,10,"Medicine :  $medicine",0,1,'L');
    $pdf->Cell(0,10,"      ",0,1,'C');
    $pdf->Cell(0,10,"      ",0,1,'C');
    $pdf->Cell(0,10,"      ",0,1,'C');
    $pdf->Cell(0,10,"Gender : $gender",0,1,'L');
    $file=time().'_prescription.pdf';
    $pdf->output($file,'D');
    //$pdf->output();
}
if(isset($_POST['createprescription'])){
    $patientname=$_POST['patientname'];
    $complaint=$_POST['complaint'];
    $observation=$_POST['observation'];
    $diagnosis=$_POST['diagnosis'];
    $medicine=$_POST['medicine'];
    $gender=$_POST['gender'];
    $sql="insert into prescription(patientname,complaint,observation,diagnosis,medicine,gender) 
    values('$patientname','$complaint','$observation','$diagnosis','$medicine','$gender')";
    if(mysqli_query($database,$sql)){
        echo "<script> alert('new prescription added')</script>";
        echo "<script>window.open('prescription.php','_self')</script>";
    }
    else{
        echo "Error :".mysqli_error($database);
    }
    mysqli_close($database);
}
?>