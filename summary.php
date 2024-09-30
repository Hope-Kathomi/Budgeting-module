<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summary</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="nav_panel">
        <div class="page_title_div">Summary budget</div>
        <div class="log_out_div">
            <!--<p><?php echo $_SESSION['valid'];?></p>-->
            <a href="log_out.php">Logout</a>
        </div>
    </div>
    
    <div class="containers"> 
        <div class="left_nav_panel">
            <p>Budget module</p>
            <a href="Personnel.php" class="left_nav_href"> 
                <img src="Images/person_blue.png" alt="Description of image" class="icons">
                Personnel
            </a>
            <a href="equipments.php" class="left_nav_href">
                <img src="Images/equipments_blue.png" alt="Description of image" class="icons">
                Equipments
            </a>
            <a href="Supplies.php" class="left_nav_href">
                <img src="Images/supplies_blue.png" alt="Description of image" class="icons">
                Supplies
            </a>
            <a href="Travels.php" class="left_nav_href">
                <img src="Images/travels_blue.png" alt="Description of image" class="icons">
                Travels
            </a>
            <a href="Contractuals.php" class="left_nav_href">
                <img src="Images/contractuals_blue.png" alt="Description of image" class="icons">
                Contractuals
            </a>
            <a href="Others.php" class="left_nav_href">
                <img src="Images/others_blue.png" alt="Description of image" class="icons">
                Others
            </a>
            <a href="Indirect_cost.php" class="left_nav_href">
                <img src="Images/Indirect cost.png" alt="Description of image" class="icons">
                Indirect cost
            </a>
            <a href="summary.php" class="left_nav_href">
                <img src="Images/Summary.png" alt="Description of image" class="icons">
                Summary
            </a>
            <a href="procurement_plan.php" class="left_nav_href">
                <img src="Images/Summary.png" alt="Description of image" class="icons">
                Procurement plan
            </a>
        </div>
    
        <div class="view_table">
            <table class="dataTable">
                <thead>
                    <tr>
                        <td>NO</td>
                        <td>ITEM</td>
                        <td>AMOUNT (ksh)</td>
                        <td id="amount-header">AMOUNT (other)</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><a href="personnel_table.php">Personnel</a></td>
                        <td>
                            <?php
                            if(isset($_SESSION['personnels_total'])){
                                echo $_SESSION['personnels_total'];
                            }else{
                                echo 'Personnel total not computed';
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                                if(isset($_SESSION['personnels_converted_total'])){
                                    echo $_SESSION['personnels_converted_total'];
                                }else{
                                    echo 'Converted personnel total not computed';
                                } 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><a href="equipments_table.php">Equipments</a></td>
                        <td>
                            <?php
                            if(isset($_SESSION['equipments_total'])){
                                echo $_SESSION['equipments_total'];
                            }else{
                                echo 'equipments_total not computed';
                            } 
                            ?>
                        </td>
                        <td>
                            <?php 
                            if(isset($_SESSION['equipments_total_converted_total'])){
                                echo $_SESSION['equipments_total_converted_total'];
                            }else{
                                echo 'equipments total is not computed';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><a href="supplies_table.php">Supplies</a></td>
                        <td>
                            <?php
                            if(isset($_SESSION['supplies_total'])){
                                echo $_SESSION['supplies_total'];
                            }else{
                                echo 'supplies_total not computed';
                            } 
                            ?>
                        </td>
                        <td>
                            <?php 
                            if(isset($_SESSION['supplies_total_converted_total'])){
                                echo $_SESSION['supplies_total_converted_total'];
                            }else{
                                echo 'supplies total is not computed';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><a href="travels_table.php">Travels</a></td>
                        <td>
                            <?php 
                            if(isset($_SESSION['travels_total'])){
                                echo $_SESSION['travels_total'];
                            }else{
                                echo 'travels total not computed';
                            }
                            ?>
                        </td>
                        <td>
                            <?php 
                            if(isset($_SESSION['travels_total_converted_total'])){
                                echo $_SESSION['travels_total_converted_total'];
                            }else{
                                echo 'travels total is not computed';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><a href="contractuals_table.php">Contractuals</a></td>
                        <td>
                            <?php 
                            if(isset($_SESSION['contractuals_total'])){
                                echo $_SESSION['contractuals_total'];
                            }else{
                                echo 'contractuals total is not computed';
                            }
                            
                            
                            ?>
                        </td>
                        <td>
                            <?php
                            if(isset($_SESSION['contractual_converted_total'])){
                                echo $_SESSION['contractual_converted_total'];
                            }else{
                                echo 'Converted Contractual total not computed';
                            } 
                            
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td><a href="others_table.php">Other costs</a></td>
                        <td>
                            <?php 
                            if(isset($_SESSION['others_total'])){
                                echo $_SESSION['others_total'];
                            }else{
                                echo 'other total is not computed';
                            }
                            
                            ?>
                        </td>
                        <td>
                            <?php 
                            if(isset($_SESSION['other_total_converted_total'])){
                                echo $_SESSION['other_total_converted_total'];
                            }else{
                                echo 'Converted other total is not computed';
                            }
                            
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Over heads</td>
                        <td>
                            <?php 
                            if(isset($_SESSION['inputValue'])){
                                echo $_SESSION['inputValue'];
                            }else{
                                echo 'Indirect total is not computed';
                            }
                            
                            ?>
                        </td>
                        <td>
                            <?php 
                            if(isset($_SESSION['indirect_converted_total'])){
                                echo $_SESSION['indirect_converted_total'];
                            }else{
                                echo 'Converted indirect total is not computed';
                            }
                            
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Grand Total</td>
                        <td>
                            <?php require_once 'process_summary_total.php'?>
                            <?php 
                            if(isset($_SESSION['totals'])){
                                echo $_SESSION['totals'];
                            }else{
                                echo 'Total is not computed';
                            }
                            
                            ?>
                        </td>
                        <td>
                            <?php 
                            if(isset($_SESSION['total_converted_totals'])){
                                echo $_SESSION['total_converted_totals'];
                            }else{
                                echo 'Converted total is not computed';
                            }
                    
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class = 'bottom_buttons'>
        <!--<div><button id="saveBtn"type = 'button'>Download</button></div>-->
        <div><a id="saveBtn" href="save_to_excel.php" style="background-color: #17a2b8; color:black; padding: 15px; border-radius: 10px; text-decoration:none;">Download</a></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function updateTableHeader() {        
            var fundersCurrency = "<?php echo $_SESSION['funders_currency'];?>";
            // Update the table header text with the selected option's value
            $('#amount-header').text('AMOUNT (' + fundersCurrency + ')');     
        }
        updateTableHeader();
        $('#saveBtn').click(function(event){
            event.preventDefault();
            var summary = $('.dataTable').html();
            var url = $(this).attr('href');

            $.ajax({
                type: "POST",
                url: "save_to_excel.php", // Path to your PHP script
                data: { summary: summary},
                success: function(response) {
                    console.log(response); // Log server response
                    //alert("Budget saved successfully.");
                    window.location.href = url;
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    alert("Error: Unable to save budget.");
                }
                });
        });
    </script>
</body>
</html>