<?php
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions'); 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment budget</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body >
    <div class="nav_panel">
        <div class="page_title_div">Equipment budget</div>
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
            <form method="post" action="process_personel_budget.php" class="form-container">
                <div class="form-column">
                    <div class="form-group">
                        <label for="type of equipment">Equipment:</label>
                        <select name="type_of_equipment" id="type_of_equipment">
                            <option value="Modern sequencing machine">Modern sequencing machine</option>
                            <option value="Sphygmomanometers">Sphygmomanometers</option>
                            <option value="Other">Other</option>
                            <!--<option value="Ophthalmoscopes">Ophthalmoscopes</option>-->
                        </select>
                    
                    </div>
                    <div class="form-group">
                        <label for="type of equipment">Model:</label>
                        <select id="sub_equipments" name="sub_equipments">
                           <!-- Options dynamically populated based on selection in mainDropdown -->
                        </select>
                        <input type="text" id="other_sub_equipments" name="other_sub_equipments" placeholder="please specify" style="display: none;">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" required>
                    </div>
                
                    <!--<div class="form-group">
                        <label for="period" >Quarter needed:</label>
                        <input type="number" id = 'quarter'name="quarter" required>
                    </div>-->
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="status">Unit:</label>
                        <select name="unit" id="unit">
                            <option value="Boxes">Box</option>
                            <option value="Pack">Pack</option>
                            <option value="Piece">Piece</option>
                            <option value="Bottle">Bottle</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Step">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" min="0" required>
                    </div>
                
                    <div class="form-group" id = 'other_unit_cost'style="display: none;">
                        <label for="status">Unit cost:</label>
                        <input type="text" name="unit_cost" id="unit_cost">
                    </div>
                    
                </div>          
            </form>
        </div>
        <div class="form-group">
            <button type="button" id="displayDataBtn">Save</button>
        </div>
        <div class="view_table">
            <table class="dataTable">
                <thead>
                    <tr>
                        <th>Catalogue No:</th>
                        <th>Item</th>
                        <th>Description</th>
                        <!--<th>Quarter needed</th>-->
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Unit cost (ksh)</th>
                        <th>Amount (ksh)</th>
                        <th id="amount-header">Amount (USD)</th>
                    </tr>
                </thead>
                <tbody id='tableBody'>
                <!-- Table rows will be dynamically added -->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">Total</td>
                     
                        <td id="sum" name= 'sum'>sum</td>
                        <td id="sum_other">sum other</td>
                    </tr>
                </tfoot>
            </table>
        </div>
            <div class = 'bottom_buttons'>
                <div><button id="submitBtn">Submit</button></div>
                <div class="next_button"><a href="supplies.php">Next</a></div>
            </div>
        </div>
        
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            displayModernSequencingMachineOptions();
            $('#type_of_equipment').change(function(){
                var selected_option = $(this).val();
                $('#sub_equipments').empty();

                if(selected_option ==='Modern sequencing machine'){
                    $('#sub_equipments').append('<option value = "Modern sequencing machine type a"> Modern sequencing machine type A </option>');
                    $('#sub_equipments').append('<option value = "Modern sequencing machine type b"> Modern sequencing machine type B </option>');
                    $('#sub_equipments').append('<option value = "Modern sequencing machine type c"> Modern sequencing machine type C </option>');
                    $('#sub_equipments').append('<option value = "Modern sequencing machine type d"> Modern sequencing machine type D </option>');
                }else if(selected_option ==='Sphygmomanometers'){
                    $('#sub_equipments').append('<option value = "Sphygmomanometers type a"> Sphygmomanometers type A </option>');
                    $('#sub_equipments').append('<option value = "Sphygmomanometers type b"> Sphygmomanometers type B </option>');
                    $('#sub_equipments').append('<option value = "Sphygmomanometers type c"> Sphygmomanometers type C </option>');
                    $('#sub_equipments').append('<option value = "Sphygmomanometers type d"> Sphygmomanometers type D </option>');
                }else if(selected_option ==='Ophthalmoscopes'){
                    $('#sub_equipments').append('<option value = "Ophthalmoscopes type a"> Ophthalmoscopes type A </option>');
                    $('#sub_equipments').append('<option value = "Ophthalmoscopes type b"> Ophthalmoscopes type B </option>');
                    $('#sub_equipments').append('<option value = "Ophthalmoscopes type c"> Ophthalmoscopes type C </option>');
                    $('#sub_equipments').append('<option value = "Ophthalmoscopes type d"> Ophthalmoscopes type D </option>');
                }
                
                if(selected_option ==='Other'){
                    $('#sub_equipments').hide();
                    $('#other_sub_equipments').show();
                    $('#other_unit_cost').show();   
                } else{
                    $('#sub_equipments').show();
                    $('#other_sub_equipments').hide(); 
                    $('#other_unit_cost').hide();       
                }
            });

            function displayModernSequencingMachineOptions() {
                $('#sub_equipments').append('<option value="Modern sequencing machine type a">Modern sequencing machine type A</option>');
                $('#sub_equipments').append('<option value="Modern sequencing machine type b">Modern sequencing machine type B</option>');
                $('#sub_equipments').append('<option value="Modern sequencing machine type c">Modern sequencing machine type C</option>');
                $('#sub_equipments').append('<option value="Modern sequencing machine type d">Modern sequencing machine type D</option>');
            }

            $("#displayDataBtn").click(function() {
                // Get form values
                var type_of_equipment = $("#type_of_equipment").val();
                var sub_equipments = $("#sub_equipments").val();
                var description = $("#description").val();
                var quarter = $("#quarter").val();
                var unit = $("#unit").val();
                var quantity = $("#quantity").val();
                var Unit_cost = $("#Unit_cost").val();
                var funders_exchange_rate = $('#funders_exchange_rate').val();
                var other_sub_equipment = $('#other_sub_equipments').val();
                var other_unit_cost = $('#unit_cost').val();
                console.log("Other: ",quantity);
                
                if(!unit || !quantity || !description){
                    alert("Please fill all fields");
                    return;
                }
                // Send form data to PHP script using AJAX
                $.ajax({
                    type: "POST",
                    url: "process_equipment_budget.php", // Your PHP script that processes the form data
                    data: {type_of_equipment: type_of_equipment, sub_equipments: sub_equipments, description: description, quarter: quarter,
                        unit: unit, quantity: quantity, Unit_cost: Unit_cost, funders_exchange_rate: funders_exchange_rate, 
                        other_sub_equipment: other_sub_equipment, other_unit_cost: other_unit_cost},
                    success: function(response) {
                        // Append the received data to the table body
                        $("#tableBody").append(response);
                        updateTotalAmount();
                        updateTotalConvertedAmount();

                        console.log("Final Total:", finalTotal);
                        
                        var tableData = [];
                        $('#tableBody tr').each(function(){
                            var rowData = {};
                            $(this).find('td').each(function(index,cell){
                                var headerText = $('#dataTable thead tr th:eq('+index+')').text();
                                rowData[headerText] = $(cell).text();
                            });
                            tableData.push(rowData); 
                        }); 
                        console.log(tableData);
                        //clear form inputs
                        //$("#type_of_equipment").val('');
                        //$("#sub_equipments").val("");
                        $("#description").val("");
                        $("#quarter").val("");
                        $("#unit").val("");
                        $("#quantity").val("");
                        $("#Unit_cost").val("");
                        $('#other_sub_equipments').val("");
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX error
                        console.error('AJAX Error:', error);
                    }
                });
                // Serialize and send table content to PHP script

            });
            var finalTotal = 0;
            //var table_id = 'personnel';
            function updateTotalAmount() {
                var total = 0;
                // Loop through each row in the table body
                $('.dataTable tbody tr').each(function() {
                    // Get the value of the "amount" column for the current row
                    var amountstr = $(this).find('td:eq(6)').text();
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

            function storeTableContentInSession() {
                var tableContent = $('.view_table').html(); // Get HTML content of tbody
                console.log(tableContent);
                $.ajax({
                    type: "POST",
                    url: "store_equipments_table.php", // Path to your PHP script
                    data: { tableContent: tableContent },
                    success: function(response) {
                        console.log(response); // Log server response
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                    }
                });
            }

            var finalConvertedTotal = 0;
            //var table_id = 'personnel';
            function updateTotalConvertedAmount() {
                var total = 0;

                // Loop through each row in the table body
                $('.dataTable tbody tr').each(function() {
                    // Get the value of the "amount" column for the current row
                    var amountStr = $(this).find('td:eq(7)').text();
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
                //console.log('datatype:',typeof finalConvertedTotal);
            }

            
            //insert total in database
            $("#submitBtn").click(function() {
                storeTableContentInSession();
                // Calculate total amount
                //var total = finalTotal;   
                
                // Send total amount to PHP script using AJAX
                //$.ajax({
                    //type: "POST",
                    //url: "insert_into_equipments.php", // Path to your PHP script
                    //data: { total: total },
                    //success: function(response) {
                        //console.log(response); // Log server response
                        //alert("Total inserted successfully.");
                    //},
                    //error: function(xhr, status, error) {
                        //console.error('AJAX Error:', error);
                        //alert("Error: Unable to insert total.");
                    //}
               // });
               $.ajax({
                    type: "POST",
                    url: "process_equipment_budget.php", // Path to your PHP script
                    data: { total: finalTotal, finalConvertedTotal: finalConvertedTotal },
                    success: function(response) {
                        console.log(response); // Log server response
                        alert("Equipments budget saved.");
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        alert("Error: Unable to set session variable.");
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