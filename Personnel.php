<?php 
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personnel budget</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body >
    <div class="nav_panel">
        <div class="page_title_div">Personnel Budgets</div>
        <div class="log_out_div">
            <!--<p><?php echo $_SESSION['valid'];?></p>-->
            <a href="log_out.php">Logout</a>
        </div>
    </div>
    
    <div class="containers">
        <div class="left_nav_panel">
            <p>Budget module</p>
            <a href="Personnel.php" class="left_nav_href"> 
                <img src="/Images/Person_blue.png" alt="Description of image" class="icons">
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
                <img src="/Images/Summary.png" alt="Description of image" class="icons">
                Summary
            </a>
        </div>
       
        <div id="input_form">
            <form method="post" action="process_personel_budget.php" id = "personnel_form" class="form-container">
                <div class="form-column">
                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <select name="designation" id="designation">
                            <option value="Senior Principal Clinical Research Scientist">(KMR 2) Senior Principal Clinical Research Scientist</option>
                            <option value="Principal Clinical Research Scientist">(KMR 3) Principal Clinical Research Scientist</option>
                            <option value="Assistant Principal Clinical Research Scientist">(KMR 4) Assistant Principal Clinical Research Scientist</option>
                            <option value="Clinical Research Scientist">(KMR 5) Clinical Research Scientist</option>
                            <option value="Senior Principal Research Scientist">(KMR 2) Senior Principal Research Scientist</option>
                            <option value="Principal Research Scientist">(KMR 2) Principal Research Scientist</option>
                            <option value="Assistant Principal Research Scientist">(KMR 4) Assistant Principal Research Scientist</option>
                            <option value="Senior Research Scientist">(KMR 5) Senior Research Scientist</option>
                            <option value="Research Scientist">(KMR 6) Research Scientist</option>
                            <option value="Manager Laboratory Services">(KMR 4) Manager Laboratory Services</option>
                            <option value="Principal Laboratory Analyst">(KMR 4) Principal Laboratory Analyst</option>
                            <option value="Senior Laboratory  Analyst">(KMR 5) Senior Laboratory  Analyst</option>
                            <option value="Laboratory Technologist">(KMR 8) Laboratory Technologist</option>
                            <option value="Senior Laboratory Technician">(KMR 8) Senior Laboratory Technician</option>
                            <option value="Laboratory Technician">(KMR 8) Laboratory Technician</option>
                            <option value="Principal Clinical Officer">(KMR 6) Principal Clinical Officer</option>
                            <option value="Senior Clinical Officer">(KMR 7) Senior Clinical Officer</option>
                            <option value="Clinical Officer">(KMR 8) Clinical Officer</option>
                            <option value="Principal Health Records & Information Technologist">(KMR 6) Principal Health Records & Information Technologist</option>
                            <option value="Senior Health Records & Information Technologist">(KMR 7) Senior Health Records & Information Technologist</option>
                            <option value="Health Records & Information Technologist">(KMR 8) Health Records & Information Technologist</option>
                            <option value="Principal Community Health Worker">(KMR 6) Principal Community Health Worker</option>
                            <option value="Senior Community Health Worker">(KMR 7) Senior Community Health Worker</option>
                            <option value="Community Health Worker">(KMR 8) Community Health Worker</option>
                            <option value="Principal Pharmaceutical Technologist">(KMR 6) Principal Pharmaceutical Technologist</option>
                            <option value="Senior Pharmaceutical Technologist">(KMR 7) Senior Pharmaceutical Technologist</option>
                            <option value="Pharmaceutical Technologist">(KMR 8) Pharmaceutical Technologist</option>
                            <option value="Principal Nursing Officer">(KMR 4) Principal Nursing Officer</option>
                            <option value="Senior Nursing Officer">(KMR 5) Senior Nursing Officer</option>
                            <option value="Nursing Officer">(KMR 6) Nursing Officer</option>
                            <option value="Senior Registered Nurse">(KMR 7) Senior Registered Nurse</option>
                            <option value="Registered Nurse">(KMR 8) Registered Nurse</option>
                            <option value="Senior Enrolled Nurse">(KMR 8) Senior Enrolled Nurse</option>
                            <option value="Enrolled Nurse">(KMR 9) Enrolled Nurse</option>
                            <option value="Deputy Director Administration">(KMR 3) Deputy Director Administration</option>
                            <option value="Principal Administrative Officer">(KMR 4) Principal Administrative Officer</option>
                            <option value="Senior Administrative Officer">(KMR 5) Senior Administrative Officer</option>
                            <option value="Administrative Officer">(KMR 6) Administrative Officer</option>
                            <option value="Senior Administrative Assistant">(KMR 7) Senior Administrative Assistant</option>
                            <option value="Administrative Assistant">(KMR 8) Administrative Assistant</option>
                            <option value="Senior Office Clerk">(KMR 9) Senior Office Clerk</option>
                            <option value="Office Clerk">(KMR 10) Office Clerk</option>
                            <option value="Deputy Director Finance">(KMR 3) Deputy Director Finance</option>
                            <option value="Principal Accountant">(KMR 4) Principal Accountant</option>
                            <option value="Senior Accountant">(KMR 5) Senior Accountant</option>
                            <option value="Accountant">(KMR 6) Accountant</option>
                            <option value="Senior Accounts Assistant">(KMR 7) Senior Accounts Assistant</option>
                            <option value="Accounts Assistant">(KMR 8) Accounts Assistant</option>
                            <option value="Senior Office Administrator">(KMR 5) Senior Office Administrator</option>
                            <option value="Office Administrator">(KMR 6) Office Administrator</option>
                            <option value="Senior Assistant Office Administrator">(KMR 7) Senior Assistant Office Administrator</option>
                            <option value="Assistant Office Administrator">(KMR 8) Assistant Office Administrator</option>
                            <option value="Deputy Director Supply Chain Management">(KMR 3) Deputy Director Supply Chain Management</option>
                            <option value="Principal Supply Chain Management Officer">(KMR 4) Principal Supply Chain Management Officer</option>
                            <option value="Senior Supply Chain Management Officer">(KMR 5) Senior Supply Chain Management Officer</option>
                            <option value="Supply Chain Management Officer">(KMR 6) Supply Chain Management Officer</option>
                            <option value="Senior Supply Chain Management Assistant">(KMR 8) Senior Supply Chain Management Assistant</option>
                            <option value="Supply Chain Management Assistant">(KMR 7) Supply Chain Management Assistant</option>
                            <option value="Deputy Director Legal">(KMR 3) Deputy Director Legal</option>
                            <option value="Principal Legal Officer">(KMR 4) Principal Legal Officer</option>
                            <option value="Senior Legal Officer">(KMR 5) Senior Legal Officer</option>
                            <option value="Legal Officer">(KMR 6) Legal Officer</option>
                            <option value="Senior Legal Assistant">(KMR 7) Senior Legal Assistant</option>
                            <option value="Legal  Assistant">(KMR 8) Legal  Assistant</option>
                            <option value="Deputy Director ICT">(KMR 3) Deputy Director ICT</option>
                            <option value="Principal ICT Officer">(KMR 4) Principal ICT Officer</option>
                            <option value="Senior ICT Officer">(KMR 5) Senior ICT Officer</option>
                            <option value="ICT Officer">(KMR 6) ICT Officer</option>
                            <option value="Senior ICT Assistant">(KMR 7) Senior ICT Assistant</option>
                            <option value="ICT Assistant">(KMR 8) ICT Assistant</option>
                            <option value="Senior Office Assistant /Attendant">(KMR 11) Senior Office Assistant /Attendant</option>
                            <option value="Office Assistant /Attendant">(KMR 12) Office Assistant /Attendant</option>
                            <option value="Deputy Director Human Resource">(KMR 3) Deputy Director Human Resource</option>
                            <option value="Principal Human Resource officer">(KMR 4) Principal Human Resource officer</option>
                            <option value="Senior HR Officer">(KMR 5) Senior HR Officer</option>
                            <option value="HR Officer">(KMR 6) HR Officer</option>
                            <option value="Senior HR Assistant">(KMR 7) Senior HR Assistant</option>
                            <option value="HR Assistant">(KMR 8) HR Assistant</option>
                            <option value="Principal Research Administrator">(KMR 4) Principal Research Administrator</option>
                            <option value="Senior Research Administrator">(KMR 5) Senior Research Administrator</option>
                            <option value="Research Administrator">(KMR 6) Research Administrator</option>
                            <option value="Principal Grants Management Officer">(KMR 4) Principal Grants Management Officer</option>
                            <option value="Senior Grants Management Officer">(KMR 5) Senior Grants Management Officer</option>
                            <option value="Grants Management Officer">(KMR 6)Grants Management Officer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="number">Number of staff</label>
                        <input type="number" name="number" id="number" required>
                    </div>
                    <div class="form-group">
                        <label for="role" >Role</label>
                        <input type="text" id="role" name="role" required>
                    </div>
                    <div class="form-group">
                        <label for="Step">Step</label>
                        <select name="step" id="step">
                            <option value="Step1">Step1</option>
                            <option value="Step2">Step2</option>
                            <option value="Step3">Step3</option>
                            <option value="Step4">Step4</option>
                            <option value="Step5">Step5</option>
                            <option value="Step6">Step6</option>
                            <option value="Step7">Step7</option>
                            <option value="Step8">Step8</option>
                        </select>
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status">
                            <option value="pnp">Permanent and pensionable</option>
                            <option value="contract">Contract</option>
                            <option value="other">Other (eg. Intern)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="period" >Period (in months)</label>
                        <input type="number" id = 'period'name="period" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="role">FTE %</label>
                        <input type="number" id = 'fte' name="fte" min="0" required>
                    </div>
                    <!--<div class="form-group">
                        <label for="Gross pay">Gross salary</label>
                        <input type="number" id = 'gross_pay' name="gross_pay" placeholder="Gross pay">
                    </div>-->
                    
                </div> 
                <div class="form-column-other-main" id="other_personnel" style="display: none;">
                    <div class="form-column-other">
                        <div class="form-group">
                            <label for="Description" >Description</label>
                            <input type="text" id = 'Description_other'name="Description_other" required>
                        </div>
                        <div class="form-group">
                            <label for="role" >Role</label>
                            <input type="text" id="role_other" name="role_other" required>
                        </div>
                        <div class="form-group">
                            <label for="number" >Number of staff</label>
                            <input type="number" id="number_other" name="number_other" min="0" required>
                        </div>
                    </div>
                    <div class="form-column-other">
                    <div class="form-group">
                            <label for="period" >Period(in months)</label>
                            <input type="number" id="period_other" name="period_other" min="0" required>
                        </div>    
                        <div class="form-group">
                            <label for="Allowance" >Allowance</label>
                            <input type="number" id = 'allowance_other'name="allowance_other" min="0" required>
                        </div>
                        <div class="form-group">
                            <label for="Fees and Subscriptions" >Fees and Subscriptions</label>
                            <input type="number" id ='Subscriptions_other' name="Subscriptions_other" min="0" required>
                        </div> 
                   </div>     
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
                        <th>Designation</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Number of staff</th>                       
                        <th>Gross pay/Allowance</th>
                        <th>FTE %</th>
                        <th>Fees and subscriptions</th>
                        <th>Period (in months)</th>
                        <th>Amount (ksh)</th>
                        <th id="amount-header">Amount (USD)</th>
                        
                    </tr>
                </thead>
                <tbody id='tableBody'>
                <!-- Table rows will be dynamically added -->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">Total</td>
                     
                        <td id="sum" name = 'sum'>sum ksh</td>
                        <td id="sum_other">sum other</td>
                    </tr>
                </tfoot>
            </table>
            <div class = 'bottom_buttons'>
                <div><button id="submitBtn">Submit</button></div>
                <div class="next_button"><a href="equipments.php">Next</a></div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var status = $("#status").val();

            // Select the dropdown element
            var $select = $('#designation');
            // Get the options as an array
            var options = $select.find('option').toArray();

            // Sort the options alphabetically
            options.sort(function(a, b) {
                return $(a).text().localeCompare($(b).text());
            });

            // Clear the original dropdown
            $select.empty();

            // Append the sorted options back to the dropdown
            $.each(options, function(index, option) {
                $select.append(option);
            });

            $("#log_out_btn").click(function(){

            });
            var form = document.getElementById("personnel_form");
            document.querySelectorAll("input").forEach(function(input){
                var saved_value = localStorage.getItem(input.name);
                if(saved_value){
                    input.value = saved_value;
                }
            });
            form.addEventListener('input', function(event){
                var input_name = event.target.name;
                var input_value = event.target.value;
                localStorage.setItem(input_name, input_value);
            });

            var stored_row = sessionStorage.getItem('new_row');
            console.log ("stored_row",stored_row);
            if(stored_row){
                document.getElementById("tableBody").innerHTML += stored_row;
            }

            $("#displayDataBtn").click(function() {
                // Get form values
                var designation = $("#designation").val();
                var number = $("#number").val();
                var role = $("#role").val();
                var status = $("#status").val();
                var step = $("#step").val();
                var period = $("#period").val();
                var fte = $("#fte").val();
                var Description_other = $("#Description_other").val();
                var role_other = $("#role_other").val();
                var number_other = $("#number_other").val();
                var period_other = $("#period_other").val();
                var allowance_other = $("#allowance_other").val();
                var Subscriptions_other = $("#Subscriptions_other").val();
                var funders_exchange_rate = $('#funders_exchange_rate').val();

                if((status ==="pnp")|| (status ==="contract")){
                    if(!number || !role || !period || !fte){
                        alert('Please fill all fields PNP');                   
                        return;
                    }
                }else{
                    if(!Description_other || !role_other || !number_other || !period_other || !allowance_other || !Subscriptions_other){
                        alert('Please fill all fields other');                   
                        return;
                    } 
                }
                
                // Send form data to PHP script using AJAX
                $.ajax({
                    type: "POST",
                    url: "process_personel_budget.php", // Your PHP script that processes the form data
                    data: { designation: designation, number: number, role: role, 
                        step: step, status: status, period: period, fte: fte,
                        Description_other:Description_other, role_other: role_other,
                        allowance_other: allowance_other, Subscriptions_other: Subscriptions_other,
                        funders_exchange_rate: funders_exchange_rate, number_other: number_other, period_other: period_other},
                        
                    success: function(response) {
                        // Append the received data to the table body
                        $("#tableBody").append(response);
                        
                        updateTotalAmount();
                        updateTotalConvertedAmount();
                        console.log("Final Total:", finalTotal);
                        //clear form inputs
                        //$('#designation').val('');
                        $("#number").val("");
                        $("#role").val("");
                        //$("#status").val("");
                        //$("#step").val("");
                        $("#period").val("");
                        $("#fte").val("");
                        $("#Description_other").val("");
                        $("#role_other").val("");
                        $("#allowance_other").val("");
                        $("#Subscriptions_other").val("");
                        $("#funders_exchange_rate").val("");
                        $("#number_other").val("");
                        $("#period_other").val("");
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX error
                        console.error('AJAX Error:', error);
                    }
                });

                if(status == 'other'){
                    $('#other_personnel').hide();
                    $('.form-column').show();
                }

            });
            
            var finalTotal = 0;
            //var table_id = 'personnel';
            function updateTotalAmount() {
                var total = 0;
                // Loop through each row in the table body
                $('.dataTable tbody tr').each(function() {
                    // Get the value of the "amount" column for the current row
                    var amountstr = $(this).find('td:eq(8)').text();
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
                    var amountStr = $(this).find('td:eq(9)').text();
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
          
            //enter data in database
            //$("#submitBtn").click(function() {
                // Get total amount
                //var total = finalTotal;
                
                // Send total amount to PHP script using AJAX
                //$.ajax({
                //    type: "POST",
                //    url: "insert_to_database.php", // Path to your PHP script
                //    data: { total: total, finalConvertedTotal: finalConvertedTotal },
                //    success: function(response) {
                //        console.log(response); // Log server response
                //        alert("Personnel budget saved.");
                //    },
                //    error: function(xhr, status, error) {
                //        console.error('AJAX Error:', error);
                //        alert("Error: Unable to insert total.");
                //    }
                //});
            //});

            //display other div
            $('#status').change(function(){
                if($(this).val() === 'other'){
                    //window.location.href = 'other_personnel.php';
                    $('.form-column').css('display','none');
                    $('#other_personnel').css('display', 'flex');
                    $('#other_personnel').css('flex-direction', 'row');
                    $('#other_personnel').css('gap', '20px');
                    $('#other_personnel').css('flex', '1');
                    $('#other_personnel').css('justify-content', 'center');
                    var other_status = $(this).val();
                    console.log(other_status);

                } else {
                    $('#other_personnel').css('display', 'none');
                }
            }); 
            function storeTableContentInSession() {
                var tableContent = $('.view_table').html(); // Get HTML content of tbody
                $.ajax({
                    type: "POST",
                    url: "store_personnel_table.php", // Path to your PHP script
                    data: { tableContent: tableContent },
                    success: function(response) {
                        console.log(response); // Log server response
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                    }
                });
            }

            $("#submitBtn").click(function() {
                storeTableContentInSession();
                // Calculate total amount
                var total = finalTotal;
                console.log('is',total);
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
                    $.ajax({
                    type: "POST",
                    url: "process_personel_total.php", // Path to your PHP script
                    data: { total: total, finalConvertedTotal: finalConvertedTotal},
                    success: function(response) {
                        console.log(response); // Log server response
                        alert("Personnel budget saved successfully.");
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        alert("Error: Unable to save final total.");
                    }
                    });
               // });
            });
            
            function updateTableHeader() {        
                var fundersCurrency = "<?php echo $_SESSION['funders_currency'];?>";
        
                // Update the table header text with the selected option's value
                $('#amount-header').text('Amount (' + fundersCurrency + ')');
             
            }
            updateTableHeader();    
            
            $('input[type="radio"][value="standard"]').prop('checked', true);
            $('.other_form-group').hide();
            $('input[type="radio"]').change(function(){
                
                if($(this).val() === 'other'){
                    $('.other_form-group').show();
                }else{
                    $('.other_form-group').hide();
                }
            });
        }); 
    </script>  
</body>
</html>