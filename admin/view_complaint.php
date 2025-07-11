<?php session_start();
error_reporting(0);
include('../include/db.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:adminlogin.php');
    exit();
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Complaint Details | GrivenceDesk</title>

    <!-- Bootstrap Core CSS -->
    <link href="assests/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--External CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assests/css/stu_style.css">

    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

</head>

<body>

    <?php include('include/header.php'); ?>

    <section id="breadcrumb">
        <div class="container" style="margin-top: 2% ; width: 97%;">
            <ol class="breadcrumb">
                <li><input type="button" value="Back" onclick="history.go(-1)"></li>
                <li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
                <li class="active">Complaint Details</li>
            </ol>
        </div>
    </section>

    <!--navigation bar-->
    <section id="main">
       <div class="container" style="width: 97%;">
            <div class="row">
                <div class="col-md-2">
                    <div class="list-group">
                        <a href="index.php" class="list-group-item"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Dashboard</a>
                        <a href="reviewGrievanceSection.php" class="list-group-item  "><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> In-Progress Grievance <span class="badge"></span></a>
                        <a href="unsolvedGrievanceSection.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Un-Solved Grievance <span class="badge"></span></a>
                        <a href="solvedGrievanceSection.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Solved Grievance <span class="badge"></span></a>
                        <a href="pushF.php" class="list-group-item "><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Pushed Grievance <span class="badge"></span></a>
                        <a href="petitions.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> View Petitions <span class="badge"></span></a>
                        <a href="addUniv.php" class="list-group-item"><span class="glyphicon glyphicon-th" aria-hidden="true"></span> Add University</a>
                        <a href="stats.php" class="list-group-item"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Statistics</a>
                        <a href="statsfeedback.php" class="list-group-item"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Feedback</a>
						<a href="profile.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Profile</a>
                    </div>
                </div>
                <div class="col-md-10" style="min-height: 400px;">
                    <div class="panel panel-default">
                        <div class="panel-heading main-color-bg">
                            <h3 class="panel-title">Complaint Details</h3>
                        </div>
                        <div class="panel-body">
                            <form action="" method="post">
                                <section id="main-content" style="padding-left:5%; color:#000">

                                    <section class="wrapper site-min-height">
                                        <?php
                                        $query = "select complain.*,category.categoryName as catname from complain join category on category.id=complain.grievanceId where complaintNumber='" . $_GET['id'] . "'";

                                        $res = mysqli_query($db, $query);
                                        while ($row = $res->fetch_assoc()) {
                                        ?>
                                            <div class="row mt">
                                                <label class="col-sm-2 col-sm-2 control-label"><b>Complaint Number : </b></label>
                                                <div class="col-sm-4">
                                                    <p><?php echo htmlentities($row['complaintNumber']); ?></p>
                                                </div>
                                                <label class="col-sm-2 col-sm-2 control-label"><b>Reg. Date :</b></label>
                                                <div class="col-sm-4">
                                                    <p><?php echo htmlentities($row['regDate']); ?></p>
                                                </div>
                                            </div>


                                            <div class="row mt">
                                                <label class="col-sm-2 col-sm-2 control-label"><b>Category :</b></label>
                                                <div class="col-sm-4">
                                                    <p><?php echo htmlentities($row['catname']); ?></p>
                                                </div>

                                            </div>

                                            <div class="row mt">

                                                <label class="col-sm-2 col-sm-2 control-label"><b>File :</b></label>
                                                <div class="col-sm-4">
                                                    <p><?php $cfile = $row['proof'];
                                                        if ($cfile == "" || $cfile == "NULL") {
                                                            echo htmlentities("N/A");
                                                        } else { ?>
                                                            <a href="assests/images/<?php echo htmlentities($row['proof']); ?>" target='_blank'> View File</a>
                                                        <?php } ?>

                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row mt">
                                                <label class="col-sm-2 col-sm-2 control-label"><b>Complaint Details </label>
                                                <div class="col-sm-10">
                                                    <p style="font-weight: normal;"><?php echo htmlentities($row['complain']); ?></p>
                                                </div>

                                            </div>



                                            <?php
                                            $ret = mysqli_query($db, "select complaintremark.remark as remark,complaintremark.status as sstatus,complaintremark.remarkDate as rdate from complaintremark join complain on complain.complaintNumber=complaintremark.complaintNumber where complaintremark.complaintNumber='" . $_GET['cid'] . "'");
                                            while ($rw = mysqli_fetch_array($ret)) {
                                            ?>


                                                <div class="row mt">

                                                    <label class="col-sm-2 col-sm-2 control-label"><b>Remark:</b></label>
                                                    <div class="col-sm-10">
                                                        <?php echo  htmlentities($rw['remark']); ?>&nbsp;&nbsp; <br /><b>Remark Date: <?php echo  htmlentities($rw['rdate']); ?></b>
                                                    </div>
                                                </div>
                                                <div class="row mt">

                                                    <label class="col-sm-2 col-sm-2 control-label"><b>Status:</b></label>
                                                    <div class="col-sm-10">
                                                        <?php echo  htmlentities($rw['sstatus']); ?>
                                                    </div>
                                                </div>

                                            <?php } ?>

                                            <div class="row mt">

                                                <label class="col-sm-2 col-sm-2 control-label"><b>Final Status :</b></label>
                                                <div class="col-sm-4">
                                                    <p style="color:red"><?php

                                                                            if ($row['status'] == "NULL" || $row['status'] == "") {
                                                                                echo "Not Processed yet";
                                                                            } else {
                                                                                echo htmlentities($row['status']);
                                                                            }
                                                                            ?></p>
                                                </div>
                                            </div>

                                        <?php }
                                        $userId = $_SESSION['id'];
                                        $complaintId = $_GET['id'];
                                        $query = "SELECT * FROM supporters WHERE userId=" . $userId . " AND complaintId=" . $complaintId;
                                        $res = mysqli_query($db, $query);
                                        $count = mysqli_num_rows($res);
                                        ?>
                                    </section>
                                    <div class="row mt" style="margin-top: 2em;">
                                        <?php
                                        if ($count > 200) {
                                            echo '<button class="btn btn-primary" name="submit" id="submit" type="submit"> <i class="fa fa-thumbs-o-up"></i> Take action </button>';
                                        } else {
                                            echo '<button class="btn btn-primary" name="del" id="del" type="del" disabled> Need more votes to start taking action  </button>';
                                        }
                                        ?>
                                    </div>
                                    <div class="row mt" style="margin-top: 2em;">
                                        <i>
                                            <?php
                                            $query = "SELECT * FROM supporters WHERE complaintId=" . $_GET['id'] . ";";
                                            $res = mysqli_query($db, $query);
                                            $count = mysqli_num_rows($res);
                                            if ($count == 1) {
                                                echo "<strong>" . $count . "</strong> student voted for this petition.";
                                            } else {
                                                echo "<strong>" . $count . "</strong> students voted for this petition.";
                                            }
                                            ?>
                                        </i>
                                    </div>
                            </form>

    </section>

    </div>

    </div>
    </div>
    </div>
    </div>

    </section>
  
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->

    <script>
        //custom select box

        $(function() {
            $('select.styled').customSelect();
        });
    </script>

</body>

</html>