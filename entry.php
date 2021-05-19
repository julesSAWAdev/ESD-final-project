<?php
session_start();
include("connection.php");

if(isset($_POST["submit"])){

    $courseid = mysqli_real_escape_string ($conn, $_POST["courseid"]);
    $dayid = $_POST["days"];
    $starts = $_POST["starts"];
    $ends = $_POST["ends"];
    $roomid = $_POST["room"];

    $query = "INSERT INTO schedules(CourseID,DayID,Starts,Ends,termID,roomid) VALUES ('$courseid','$dayid','$starts','$ends','1','$roomid')";
    $result = mysqli_query($conn,$query);
    if($result){
        $msg = "
    <div class='alert alert-success'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <b>Course added successfuly</b>
    </div>
    ";
    }else{
    $msg = "
    <div class='alert alert-warning'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <b>Invalid Email or password</b>
    </div>
    ";
    }
}
?>
<html>


 <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>SSMIS | Dashboard</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
        <?php include("navigation.php"); ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li style="padding: 20px">
                    <span class="m-r-sm text-muted welcome-message">Welcome to SSMIS</span>
                </li> 


                <li>
                    <a href="logout">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
                
            </ul>

        </nav>
        </div>
                <div class="row  border-bottom white-bg dashboard-header">

                    <div class="col-md-6">
                        <h2>Courses <?php 
                        $persnal = "SELECT * FROM semesters WHERE status='1'";
                        $exec = mysqli_query($conn,$persnal); 
                        while($row = mysqli_fetch_array($exec)){
                              $row["name"]."  ".$row["year"];
                            $term = $row["SemID"];
                            $_SESSION["term"] = $term;
                        }
                        
                        ?></h2> 
                        
                    </div> 

            </div>
            <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Add New schedule</h5> 
                    </div>
                    
                    <div class="ibox-content">
                    <div class="row">
            <div class="col-lg-7">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Fill this form below</h5>
                         
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12"> 
                                    <div class='message-info'>
                                    <?php if ($msg != "") echo $msg . "<br>" ?>
                                    </div>
                                <form role="form" action="entry" method="POST">
                                <div class="form-group"><label>Course Name</label>
                                <select class="form-control m-b" name="courseid">
                                        <?php
                                         $query = "SELECT * FROM courses";
                                         $result = mysqli_query($conn,$query);
                                         while ($rows = mysqli_fetch_array($result)) {?>
                                        <option value="<?php echo $rows[0];?>"><?php echo $rows[1]?></option>
                                        <?php } ?>
                                        ?>
                                    </select>
                                    </div>
                                    <div class="form-group"><label>Day</label>  
                                    <select class="form-control m-b" name="days">
                                        <?php
                                         $query = "SELECT * FROM dailytime";
                                         $result = mysqli_query($conn,$query);
                                         while ($rows = mysqli_fetch_array($result)) {?>
                                        <option value="<?php echo $rows[0];?>"><?php echo $rows[1]?></option>
                                        <?php } ?>
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group"><label>Starts</label> <input type="time" name="starts" placeholder="start time" class="form-control"></div>
                                    <div class="form-group"><label>Ends</label> <input type="time" name="ends" placeholder="end time" class="form-control"></div>
                                    <div class="form-group"><label>Room</label>  
                                    <select class="form-control m-b" name="room">
                                        <?php
                                         $query = "SELECT * FROM rooms";
                                         $result = mysqli_query($conn,$query);
                                         while ($rows = mysqli_fetch_array($result)) {?>
                                        <option value="<?php echo $rows[0];?>"><?php echo $rows[1]?></option>
                                        <?php } ?>
                                        ?>
                                        </select>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" name="submit"><strong>Add course</strong></button>
                                     </div>
                                </form>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <!--
                <div class="col-lg-5">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Horizontal form</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#" class="dropdown-item">Config option 1</a>
                                    </li>
                                    <li><a href="#" class="dropdown-item">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form>
                                <p>Sign in today for more expirience.</p>
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Email</label>

                                    <div class="col-lg-10"><input type="email" placeholder="Email" class="form-control"> <span class="form-text m-b-none">Example block-level help text here.</span>
                                    </div>
                                </div>
                                <div class="form-group row"><label class="col-lg-2 col-form-label">Password</label>

                                    <div class="col-lg-10"><input type="password" placeholder="Password" class="form-control"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="i-checks"><label> <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Remember me </label></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-sm btn-white" type="submit">Sign in</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                    -->
            </div>

                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="float-right">
                <?php 

                // Prints the day, date, month, year, time, AM or PM
                echo date("l jS \of F Y h:i:s A");
                ?>
                </div>
                <div>
                    <strong>Copyright</strong> All Rights reserved &copy; 2021
                </div>
            </div>
        </div>
        <div class="small-chat-box fadeInRight animated">

            <div class="heading" draggable="true">
                <small class="chat-date float-right">
                <?php
                ?>
                </small>
                
            </div>
 
    </div>

     

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/plugins/dataTables/datatables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <script src="js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>


    <script>
        $(document).ready(function() {

            let toast = $('.toast');

            setTimeout(function() {
                toast.toast({
                    delay: 5000,
                    animation: true
                });
                toast.toast('show');

            }, 2200);

            var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
            ];
            var data2 = [
                [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
            ];
            $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: "#d5d5d5",
                            borderWidth: 1,
                            color: '#d5d5d5'
                        },
                        colors: ["#1ab394", "#1C84C6"],
                        xaxis:{
                        },
                        yaxis: {
                            ticks: 4
                        },
                        tooltip: false
                    }
            );

            var doughnutData = {
                labels: ["App","Software","Laptop" ],
                datasets: [{
                    data: [300,50,100],
                    backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
                }]
            } ;


            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: false
                }
            };


            var ctx4 = document.getElementById("doughnutChart").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

            var doughnutData = {
                labels: ["App","Software","Laptop" ],
                datasets: [{
                    data: [70,27,85],
                    backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
                }]
            } ;


            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: false
                }
            };


            var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

        });

        $(window).bind("scroll", function () {
            let toast = $('.toast');
            toast.css("top", window.pageYOffset + 20);

        });
    </script>
                <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-4625583-2', 'webapplayers.com');
        ga('send', 'pageview');

    </script>
    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

        });

    </script>
</body>

 </html>
