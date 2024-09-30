<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();
include('process_indirect_cost.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indirect cost</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.view_table').hide();
            
            function updateCalculations() {
                // Iterate over each radio button
                $('input[name="calculation"]').each(function() {
                    // Get the parent <td> element of the current radio button
                    var td = $(this).closest('td');
        
                    // Check if the current radio button is checked
                    if ($(this).is(':checked')) {
                        // Find the input field in the same row and get its value
                        var cellValue = $(this).closest('td').prev('td').text();
                        var cleaned_cellValue = cellValue.replace(/,/g,'')
                        var float_cellValue = parseFloat(cleaned_cellValue);
                        console.log('we',float_cellValue);

                        // Define selectedCalculation here or retrieve it from where it's defined
                        var selectedCalculation = $(this).val();

                        if (!isNaN(float_cellValue)) {
                            var result;
                            if (selectedCalculation === 'None') {
                                result = float_cellValue.toLocaleString();
                            } else if (selectedCalculation === 'Standard') {
                                var plus_indirect = float_cellValue + (0.18 * float_cellValue);
                                result = plus_indirect.toLocaleString();
                                console.log(result);
                            } 
                            // Update the next <td> element in the same row with the result
                            td.next('td').text(result);
                        } else {
                            // If the cellValue is not a valid number, clear the next <td> element
                            td.next('td').text('');
                        }
                    }
                });
            }
        
            // Listen for change event on radio buttons
            //$('input[type="radio"]').change(function() {
            
                // Clear any existing input fields
                //$('input[type="number"]').remove();
                
                // Get the selected value of the radio button
                //var selectedValue = $(this).val();
                // If the selected value is not "None", create an input field in the cell
                //if (selectedValue !== "None" && selectedValue !== "Standard") {
                   // var inputField = $('<input type="number">');
                    //$(this).closest('td').append(inputField);
               // }
            //});
    

        });
        // Attach event listener to input fields
        $(document).on('input keyup', 'input[type="number"]', function(event) {
            // Check if the Enter key is pressed (key code 13) or the event is input
            if (event.which === 13 || event.type === 'input') {
                
                // Get the value entered in the input field
                var inputValue = parseFloat($(this).val());
                // Ensure inputValue is a valid number
                if (isNaN(inputValue)) return;
                console.log('input',inputValue);

                // Get the value in the cell to the left
                var cellValue = $(this).closest('td').prev('td').text();
                var cleaned_cellValue = cellValue.replace(/,/g,'');
                var float_cellValue = parseFloat(cleaned_cellValue);
                // Ensure cellValue is a valid number
                if (isNaN(float_cellValue)) return;
                console.log('left',float_cellValue);

                // Calculate the product
                var product = float_cellValue * (inputValue/100);
                var Converted_product = product / <?php echo $_SESSION['exchange_rate'];?>;
                var result =product.toLocaleString();
                var converted_result = Converted_product.toLocaleString();
                // Update the content of the cell to the right with the product
                var fundersCurrency = "<?php echo $_SESSION['funders_currency'];?>";
                var resultText = result+' (KSH)' + " <br> " + " <br> " + converted_result + ' (' + fundersCurrency + ')';
                $(this).closest('td').next('td').html(resultText);

                console.log('Product: ',product);
                // Send the inputValue to a PHP script to set a session variable
                $.ajax({
                    type: "POST",
                    url: "set_session_variable.php", // Path to your PHP script
                    data: { product: product, Converted_product: Converted_product },
                    success: function(response) {
                        console.log(response); // Log server response
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                    }
                });
            }
        
        });
       
    </script>
</head>
<body>
    <div class="nav_panel">
        <div class="page_title_div">Over head</div>
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
        </div>
        
        <!--<div class="indirect_cost_div">
            <p>Indirect cost</p>
            <div  class="indirect_options">
                <div>
                    <label for="total">Total</label>
                    <input type="radio" name="indirect_option" id="total" value="total" checked>
                </div>
                <div>
                    <label for="Line item">Line item</label>
                    <input type="radio" name="indirect_option" id="line_item" value="line_item">
                </div>  
            </div>    
        </div>--> 
        <div class="indirect_cost_div">
            <!--<div><p>Enter indirect cost percentage</p></div>-->
            <div class="total_input">
                <table class="indirect_table">
                    <thead>
                        <tr>
                            <th>Total budget</th>
                            <th>Overhead %</th>
                            <th>Total overhead</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php
                                if(isset($_SESSION['total_before_indirect'])){
                                    echo $_SESSION['total_before_indirect'] . ' (KSH)' . '<br>' . '<br>';
                                    ;
                                    echo $_SESSION['total_before_indirect_converted'] . " (" . $_SESSION['funders_currency'] . ")";
                                }else{
                                    echo 'Total before indirect not computed';
                                }
                                ?>
                            </td>
                            <td>
                                <input type="number" name="indirect_percentage" id="indirect_percentage" placeholder="Enter indirect %">
                            </td>
                            <td>
                                <?php
                                if(isset($_SESSION['inputValue'])){
                                    //echo $_SESSION['inputValue'] . ' KSH' . '<br>' . '<br>';
                                    //echo $_SESSION['converted_indirect_cost'] . ' Yen';
                                }else{
                                    echo 'Indirect cost not computed';
                                }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                              
                <!--<div >
                    <label for="total_budget_before_indirect">Total budget</label>
                    <input type="text" name="total_budget_before_indirect" id="total_budget_before_indirect" placeholder="Total before indirect cost">
                </div> 
                <div>
                    <form action="process_indirect_cost.php" method="post" id="indirect_form">
                        <label for="indirect_percentage">Indirect cost percentage</label>
                        <input type="number" name="indirect_percentage" id="indirect_percentage">
                        <div><button type = 'submit' id="submit_button">Submit</button></div>
                    </form>
                </div>
                <div>
                    <label for="indirect_cost">Indirect cost</label>
                    <input type="text" name="indirect_cost" id="indirect_cost" placeholder="Indirect cost">
                </div>-->
            </div>
        </div>
        <div class = 'bottom_buttons'>
            <!--<div><button id="submitBtn"type = 'button'>Submit</button></div>-->
            <div class="next_button"><a href="summary.php">Next</a></div>
        </div>

        <div class="view_table">
            <table class="dataTable">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>ITEM</th>
                        <th>AMOUNT</th>
                        <th>INDIRECT COST %</th>
                        <th>AMOUNT AFTER INDIRECT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Personnel</td>
                        <td>
                            <?php
                            if(isset($_SESSION['personnels_total'])){
                                echo $_SESSION['personnels_total'];
                                //echo $_SESSION['personnel_total_converted_'];
                            }else{
                                echo 'Personnel total not computed';
                            }
                            ?>
                        </td>
                        <td>
                            <label><input type="radio" name="calculation" value="None" checked> None</label>
                            <label><input type="radio" name="calculation" value="Standard"> Standard (18%)</label>
                            <label><input type="radio" name="calculation" value="Negotiated"> Negotiated</label>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Equipments</td>
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
                            <label><input type="radio" name="calculation" value="None" checked> None</label>
                            <label><input type="radio" name="calculation" value="Standard"> Standard (18%)</label>
                            <label><input type="radio" name="calculation" value="Negotiated"> Negotiated</label>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Supplies</td>
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
                            <label><input type="radio" name="calculation" value="None" checked> None</label>
                            <label><input type="radio" name="calculation" value="Standard"> Standard (18%)</label>
                            <label><input type="radio" name="calculation" value="Negotiated"> Negotiated</label>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Travels</td>
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
                            <label><input type="radio" name="calculation" value="None" checked> None</label>
                            <label><input type="radio" name="calculation" value="Standard"> Standard (18%)</label>
                            <label><input type="radio" name="calculation" value="Negotiated"> Negotiated</label>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Contractuals</td>
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
                            <label><input type="radio" name="calculation" value="None" checked> None</label>
                            <label><input type="radio" name="calculation" value="Standard"> Standard (18%)</label>
                            <label><input type="radio" name="calculation" value="Negotiated"> Negotiated</label>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Others</td>
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
                            <label><input type="radio" name="calculation" value="None" checked> None </label>
                            <label><input type="radio" name="calculation" value="Standard"> Standard (18%)</label>
                            <label><input type="radio" name="calculation" value="Negotiated"> Negotiated</label>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table> 
        </div>  
    </div>
    <script>
        $(document).ready(function(){
            //$('.view_table').hide();

            //$('input[name="indirect_option"]').change(function(){
                //$selected_option = $(this).val();
                //if($selected_option === 'total'){
                    //$('.total_input').show();
                   // $('.view_table').hide();
                //}else{
                    //$('.total_input').hide();
                    //$('.view_table').show();
                //}
            //});
            $('#indirect_Form').on('submit', function(event){
                event.preventDefault();
                var indirect_percentage = $('#indirect_percentage').val();
                console.log(indirect_percentage);
                $.ajax({
                    url:'process_indirect_cost.php',
                    type:'POST',
                    data:{indirect_percentage: indirect_percentage},
                    success: function (response) {
                        // This function is called if the request is successful
                        console.log('Success:', response);
                    },
                    error: function(xhr, status, error) {
                        // This function is called if the request fails
                        console.error('Error:', status, error);
                    },
                    complete: function(xhr, status) {
                        // This function is called when the request finishes (after success and error callbacks are executed)
                        console.log('Request complete');
                    }
                });
           });
           var formmated_total = <?php echo $_SESSION['total_before_indirect']; ?>;
           //var string_formatted_total = toLocaleString(formmated_total);

           $('#total_budget_before_indirect').attr('placeholder', formmated_total);
           //$('#indirect_cost').attr('placeholder', indirect_cost);  
           
           $('#submit_button').click (function(){
                var indirect_amount =  $('#indirect_cost').attr('placeholder');
                console.log('i_c: ',indirect_amount)
                $.ajax({
                    url: 'set_session_variable.php',
                    type: 'POST',
                    data: {indirect_amount: indirect_amount},
                    success: function (response) {
                        // This function is called if the request is successful
                        console.log('Success:', response);
                    },
                    error: function(xhr, status, error) {
                        // This function is called if the request fails
                        console.error('Error:', status, error);
                    },
                    complete: function(xhr, status) {
                        // This function is called when the request finishes (after success and error callbacks are executed)
                        console.log('Request complete');
                    }
                });
           });
        });
    </script>
</body>
</html>