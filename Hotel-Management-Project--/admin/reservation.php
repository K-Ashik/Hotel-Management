<?php
// starting sessions 
session_start();
include('db.php')
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RESERVATION ASHIK'S HOTEL</title>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a  href="../index.php"><i class="fa fa-home"></i> Homepage</a>
                    </li>
                </ul>
            </div>
        </nav>
       
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">
                        RESERVATION <small></small>
                    </h1>
                </div>
            </div> 
            <div class="row">
            <?php
                if(isset($_SESSION["success"])){
                    echo $_SESSION["success"];
                    session_destroy();
                }
            ?>
            </div>
            <div class="rom">
                    <div class="col-md-10">
            <table class="table">
                <thead>
                    <tr>
                        <th>PERSONAL INFORMATION</th>
                        <th>RESERVATION INFORMATION</th>
                    </tr>
                </thead>
                <form action="" method="post">
                <tbody>
                    <tr>
                        <td>
                            <label>Full Name</label>
                            <input name="fname" class="form-control" required>
                        </td>
                        <td>
                            <label>Type Of Room</label>
                            <select name="troom"  class="form-control" required>
                                <option value selected ></option>
                                <option value="Superior Room">SUPERIOR ROOM</option>
                                <option value="Deluxe Room">DELUXE ROOM</option>
                                <option value="Guest House">GUEST HOUSE</option>
                                <option value="Single Room">SINGLE ROOM</option>
								<option value="Party Room">PARTY ROOM</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                            <input name="email" type="email" class="form-control" required>
                        </td>
                        <td>
                            <label>Person's Quantity</label>
                            <select name="bed" class="form-control" required>
                                <option value selected ></option>
                                <option value="Single">Single</option>
                                <option value="Double">Double</option>
                                <option value="Triple">Triple</option>
                                <option value="Quad">Quad</option>
								<option value="Hall">Hall</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Phone Number</label>
                            <input name="phone" type ="text" class="form-control" required>
                        </td>
                        <td>
                            <label>No.of Rooms</label>
                            <select name="nroom" class="form-control" required>
                                <option value selected ></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- <label>Country</label>
                            <select name="country" class="form-control" required>
                                <option value selected ></option>
                                <?php
                                foreach($countries as $key => $value):
                                echo '<option value="'.$value.'">'.$value.'</option>'; //close your tags!!
                                endforeach;
                                ?>
                            </select> -->
                        </td>
                        <td>
                            <label>Meal Plan</label>
                            <select name="meal" class="form-control"required>
                                <option value selected ></option>
                                <option value="Room only">Room only</option>
                                <option value="Breakfast">Breakfast</option>
                                <option value="Half Board">Half Board</option>
                                <option value="Full Board">Full Board</option>
								<option value="Party Package">Party Package</option>
                            </select>
                        </td>    
                    </tr>
                    <tr>
                        <td>
                            <label>Check-In</label>
                            <input name="cin" type ="date" class="form-control">      
                        </td>
                        <td>
                            <label>Check-Out</label>
                            <input name="cout" type ="date" class="form-control">
                        </td>
                    </tr>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" class="btn btn-primary btn-block">
                        </td>
                    </tr>
                </tfoot>
                </form>
        </table>
        </div>
    </div>

						<?php
							if(isset($_POST['submit']))
							{
									$con=mysqli_connect("localhost","root","","hotel");
									$check="SELECT * FROM roombook WHERE email = '$_POST[email]'";
									$rs = mysqli_query($con,$check);
									$data = mysqli_fetch_array($rs, MYSQLI_NUM);
									if($data[0] > 1) {
										$success = "<div style='width: 100%;' class='flash alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Info!</strong> You are already <strong>submitted the request!</strong></div>";
                                        $_SESSION["success"] = $success;
									}

									else
									{
										$new ="Not Conform";
										$newUser="INSERT INTO `roombook`(`FName`, `Email`, `Phone`, `TRoom`, `Bed`, `NRoom`, `Meal`, `cin`, `cout`,`stat`,`nodays`) VALUES ('$_POST[fname]','$_POST[email]','$_POST[phone]','$_POST[troom]','$_POST[bed]','$_POST[nroom]','$_POST[meal]','$_POST[cin]','$_POST[cout]','$new',datediff('$_POST[cout]','$_POST[cin]'))";
										if (mysqli_query($con,$newUser))
										{
											$success = "<div style='width: 100%;' class='flash alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Success!</strong> Your request is <strong>successfully submitted!</strong></div>";
                                            $_SESSION["success"] = $success;
										}
										else
										{
											echo "<script type='text/javascript'> alert('Error adding user in database')</script>";
										}
									}
							}
							?>
						</form>
							
                    </div>
                </div>
            </div>
           
                
                </div>
                    
            
				
					</div>
			 <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    
    <script>
        $(function() {
                setTimeout(function() {
                    $(".flash").hide('blind', {}, 500)
                }, 3000);
            });
    </script>
</body>
</html>
