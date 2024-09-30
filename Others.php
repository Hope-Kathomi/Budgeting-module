<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions'); 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Others budget</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body >
    <div class="nav_panel">
        <div class="page_title_div">Others budget</div>
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
        <div>
        <div id="input_form">
            <form method="post" action="process_others_budget.php" class="form-container">
                <div class="form-column">
                    <div class="form-group">
                        <label for="Type">Type:</label>
                        <select name="Type" id="Type">
                            <option value="Training">Training</option>
                            <option value="Communication">Communication</option>
                            <option value="Community engagement">Community engagement</option>
                            <option value="Dissemination">Dissemination</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Fuel">Description:</label>
                        <input type="text" name="Description" id="Description" required>
                    </div>
                    
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="Communication">Quantity:</label>
                        <input type="number" name="Quantity" id="Quantity">
                    </div>
                    <div class="form-group">
                        <label for="Training" >Quarter:</label>
                        <input type="number" id = 'Quarter'name="Quarter" required>
                    </div>
                    <!--<div class="form-group">
                        <label for="Community engagement">Cost per unit:</label>
                        <input type="number" name="Cost per unit" id="Cost_per_unit">
                    </div>-->
                    
                </div>
                    
            </form>
        </div>
        <div class="form-group">
                    <button type="button" id="displayDataBtn">Add</button>
                </div>
        <div class="view_table">
            <table class="dataTable">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Description</th>
                        <th>Cost per unit</th>
                        <th>Quarter</th>
                        <th>Amount (ksh)</th>
                        <th id="amount-header">Amount (USD)</th>
                    </tr>
                </thead>
                <tbody id='tableBody'>
                <!-- Table rows will be dynamically added -->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">Total</td>
                     
                        <td id="sum">sum</td>
                        <td id="sum_other">sum other</td>
                    </tr>
                </tfoot>
            </table>
            <div class = 'bottom_buttons'>
                <div><button id="submitBtn"type = 'button'>Submit</button></div>
                <div class="next_button"><a href="Indirect_cost.php">Next</a></div>
            </div>
        </div>
        </div>
        
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $("#displayDataBtn").click(function() {
                // Get form values
                var Type = $("#Type").val();
                var Description = $("#Description").val();
                var Quarter = $("#Quarter").val();
                var Quantity = $("#Quantity").val();
                var Cost_per_unit = $("#Cost_per_unit").val();
                var funders_exchange_rate = $('#funders_exchange_rate').val();
                
                if(!Quantity || !Description || !Quarter){
                    alert("Fill in all fields");
                    return;
                }
                // Send form data to PHP script using AJAX
                $.ajax({
                    type: "POST",
                    url: "process_others_budget.php", // Your PHP script that processes the form data
                    data: { Type: Type, Description: Description, Quarter: Quarter, Quantity: Quantity, Cost_per_unit: Cost_per_unit,
                        funders_exchange_rate: funders_exchange_rate},

                    success: function(response) {
                        // Append the received data to the table body
                        $("#tableBody").append(response);
                        updateTotalAmount();
                        updateTotalConvertedAmount();
                      
                        console.log("Final Total:", finalTotal);
                        
                        //clear form inputs
                        //$('#Type').val("");
                        $("#Description").val("");
                        $("#Quarter").val("");
                        $("#Quantity").val("");
                        $("#Cost_per_unit").val("");
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX error
                        console.error('AJAX Error:', error);
                    }
                });
            });
            var finalTotal = 0;
            //var table_id = 'personnel';
            function updateTotalAmount() {
                var total = 0;
                // Loop through each row in the table body
                $('.dataTable tbody tr').each(function() {
                    // Get the value of the "amount" column for the current row
                    var amountstr = $(this).find('td:eq(5)').text();
                    // Remove commas from the string
                    var amountCleaned = amountstr.replace(/,/g, '');
                    // Parse the cleaned string as a float
                    var amount = parseFloat(amountCleaned);

                    // Add the amount to the total
                    if (!isNaN(amount)) { // Ensure the value is a valid number
                        total += amount;
                    }
                });
                // Format the total with comma separators and two decimal places
                var formattedTotal = total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                // Update the total amount in the footer
                $('#sum').text(formattedTotal); // Display total with 2 decimal places
                finalTotal = formattedTotal;
            }

            var finalConvertedTotal = 0;
            //var table_id = 'personnel';
            function updateTotalConvertedAmount() {
                var total = 0;

                // Loop through each row in the table body
                $('.dataTable tbody tr').each(function() {
                    // Get the value of the "amount" column for the current row
                    var amountStr = $(this).find('td:eq(6)').text();
                    // Remove commas from the string
                    var amountCleaned = amountStr.replace(/,/g, '');
                    // Parse the cleaned string as a float
                    var amount = parseFloat(amountCleaned);

                    // Add the amount to the total
                    if (!isNaN(amount)) { // Ensure the value is a valid number
                        total += amount;
                    }
                });

                // Format the total with comma separators and two decimal places
                var formattedTotal = total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');

                // Update the total amount in the footer
                $('#sum_other').text(formattedTotal); // Display formatted total

                finalConvertedTotal = formattedTotal;
            }

            function storeTableContentInSession() {
                var tableContent = $('.view_table').html(); // Get HTML content of tbody
                $.ajax({
                    type: "POST",
                    url: "store_others_table.php", // Path to your PHP script
                    data: { tableContent: tableContent },
                    success: function(response) {
                        console.log(response); // Log server response
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                    }
                });
            }

            //insert total in database
            $("#submitBtn").click(function() {
                storeTableContentInSession()
                // Calculate total amount
                var total = finalTotal;
                
                // Send total amount to PHP script using AJAX
                $.ajax({
                    type: "POST",
                    url: "process_others_total.php", // Path to your PHP script
                    data: { finalTotal: finalTotal, finalConvertedTotal: finalConvertedTotal },
                    success: function(response) {
                        console.log(response); // Log server response
                        alert("Others budgets saved.");
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        alert("Error: Unable to insert total.");
                    }
                });
            });
            
            function updateTableHeader() {        
                var fundersCurrency = "<?php echo $_SESSION['funders_currency'];?>";
                
                // Update the table header text with the selected option's value
                $('#amount-header').text('Amount (' + fundersCurrency + ')');            
            }
            updateTableHeader(); 
            
        });
            
    </script>  
</body>
</html>