<?php
    include ('dbcon.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Field Service Report</title>
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
    <body>
        <!-- Modal content -->
    <div class="modal-contents">
                <!-- Close Button -->


                <h3 class="title">Field Service Report</h3>

                <div class="containers">
                <?php   
                    if(isset(($_POST['submit']))) {
                        $date=date("Y-m-d",strtotime($con, $_POST["date"]));
                        $timeIn = mysqli_real_escape_string($con, $_POST["time_in"]);
                        $timeOut = mysqli_real_escape_string($con, $_POST["time_out"]);

                        $customerName = mysqli_real_escape_string($con, $_POST["customer_name"]);
                        $address = mysqli_real_escape_string($con, $_POST["address"]);
                        $telNo = mysqli_real_escape_string($con, $_POST["tel_no"]);
                    
                        $modelNo = mysqli_real_escape_string($con, $_POST["model_no"]);
                        $serailNo = mysqli_real_escape_string($con, $_POST["serial_no"]);
                        $meterReading = mysqli_real_escape_string($con, $_POST["meter_reading"]);
                        
                        $detailRepair = mysqli_real_escape_string($con, $_POST["detail_repair"]);
                        $customerComment = mysqli_real_escape_string($con, $_POST["customer_comment"]);
                        $recommendation = mysqli_real_escape_string($con, $_POST["recommendation"]);

                        $firstStatement = $con->prepare(" INSERT INTO fsr_tbl (date, time_in, time_out, customer_name, address, tel_no, model_no, serial_no, meter_reading, detail_repair, customer_comment, recommendation) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                        if($firstStatement->execute()) {
                            echo "<div class='alert alert-success'>FSR Added Successfully. <a href='fpdf.php?id={$infoKey}' target='_BLANK'>Click </a> here to Print Invoice </div> ";
                        }else {
                            echo "<div class='alert alert-danger'>Error Inserting, Info :" . $firstStatement->error . " </div> ";
                        }

                        $firstStatement->close();
                    }
                ?>

                    <form action="fpdf.php" method="post" autocomplete="off">
                        
                        <div class="technician">
                            <label class="tech_label">Technician: </label>
                            <p class="tech_name">JOHN DAVID S. CABAL</p>
                        </div>

                        <div class="display-flex">
                            <div class="left-side">
                                
                                <label for="sidate">Date</label><br>
                                <input type="date" id="date" name="date" value="<?php echo date("Y-m-d");?>" require>

                                <label for="time_in">Time In: </label>
                                <input type="time" id="time_in" name="time_in" require>

                                <label for="time_out">Time Out: </label>
                                <input type="time" id="time_out" name="time_out" require>
                                
                            </div>

                            <div class="right-side">
                                <label for="customer_name">Customer Name:</label>
                                <input type="text" id="customer_name" name="customer_name" require>
                                
                                <label for="address">Address: </label>
                                <input type="text" id="address" name="address" require>

                                <label for="tel_no">Tel. No.: </label>
                                <input type="number" id="tel_no" name="tel_no" min="0" max="11">
                            </div>

                            <div class="next">
                                <label for="model_no">Model No.:</label>
                                <input type="text" id="model_no" name="model_no" require>
                                
                                <label for="serial_no">Serial No.: </label>
                                <input type="text" id="serial_no" name="serial_no" require>

                                <label for="meter_reading">Meter Reading: </label>
                                <input type="number" id="meter_reading" name="meter_reading" require>
                            </div>
                        </div>
                        
                        <div class="detail_report">
                            <label for="detail_repair">Details of Repair: </label>
                            <input type="text" id="detail_repair" name="detail_repair" require>

                            <label for="customer_comment">Customer's Comments: </label>
                            <input type="text" id="customer_comment" name="customer_comment" require>
                            
                            <label for="recommendation">Technician's Recommendations: </label>
                            <input type="text" id="recommendation" name="recommendation" require>
                        </div>

                       
                        <div class="inputContainer">
                            <button class="submit" type="submit" name="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </body>
</html>