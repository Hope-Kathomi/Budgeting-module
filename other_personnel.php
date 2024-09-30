<?php 
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
        Personnel Others
    </div>
    
    <div class="containers">
        <div class="left_nav_panel">
            <a href="Personnel.php">Personnel</a>
            <a href="equipments.php">Equipments</a>
            <a href="Supplies.php">Supplies</a>
            <a href="Travels.php">Travels</a>
            <a href="Contractuals.php">Contractuals</a>
            <a href="Others.php">Others</a>
        </div>
        <div>
            <div id="input_form">
                <form method="post" action="process_personel_budget.php" class="form-container">
                    <div class="form-column">
                        <div class="form-group">
                            <label for="designation">Description</label>
                            <input type="text" name="description" id="description">
                        </div>
                        <div class="form-group">
                            <label for="role" >Role</label>
                            <input type="text" id="role" name="role" required>
                        </div>
                        <div class="form-group">
                            <label for="number">Number of staff</label>
                            <input type="number" name="number" id="number" required>
                        </div>
                    </div>
                    <div class="form-column">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" id="status" name="status">
                        </div>
                        <div class="form-group">
                            <label for="period" >Period (in months)</label>
                            <input type="number" id ='period' name="period" required>
                        </div>
                        <div class="form-group">
                            <label for="Allowance" >Allowance</label>
                            <input type="number" id = 'allowance' name="allowance" required>
                        </div>
                        <div class="form-group">
                            <label for="Fees and Subscriptions" >Fees and Subscriptions</label>
                            <input type="number" id ='subscriptions' name="subscriptions" required>
                        </div>
                    </div> 
                </form>  
            </div>
            <div class="form-group">
                <button type="button" id="displayDataBtn">Add</button>
            </div>
            <div class="view_table" id="other_table">
                <table class="dataTable">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Number of staff</th>
                            <th>Allowance</th>
                            <th>Fees and subscriptions</th>
                            <th>Period (in months)</th>
                            <th>Amount (ksh)</th>
                        
                        </tr>
                    </thead>
                    <tbody id='tableBody'>
                    <!-- Table rows will be dynamically added -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">Total</td>
                     
                            <td id="sum">sum</td>
                        </tr>
                    </tfoot>
                </table>
                <div class = 'bottom_buttons'>
                    <div><button id="saveBtn">Save</button></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#displayDataBtn").click(function() {
                // Get form values
                var description = $("#description").val();
                var number = $("#number").val();
                var role = $("#role").val();
                var status = $("#status").val();
                var step = $("#step").val();
                var period = $("#period").val();
                var allowance = $("#allowance").val();
                var subscriptions = $("#subscriptions").val();


                // Send form data to PHP script using AJAX
                $.ajax({
                    type: "POST",
                    url: "process_other_personel_budget.php", // Your PHP script that processes the form data
                    data: { description: description, number: number, role: role, status: status, period: period,
                        role: role, allowance: allowance, subscriptions: subscriptions},
                        
                    success: function(response) {
                        // Append the received data to the table body
                        $("#tableBody").append(response);
                        updateTotalAmount();
                        console.log("Final Total:", finalTotal);
                        //clear form inputs
                        $('#description').val('');
                        $("#number").val("");
                        $("#role").val("");
                        $("#status").val("");
                        $("#allowance").val("");
                        $("#period").val("");
                        $("#subscriptions").val("");
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
                    var amount = parseFloat($(this).find('td:eq(7)').text());
                    // Add the amount to the total
                    total += amount;
                    console.log("Total is:", total);
                });
                // Update the total amount in the footer
                $('#sum').text(total.toFixed(2)); // Display total with 2 decimal places
                finalTotal = total;
            }

            $(document).ready(function() {
            $("#saveBtn").click(function() {
                // Clone the rows from table1
                var rows = $("#table1 tbody tr").clone();
                
                // Append the cloned rows to table2
                $("#table2 tbody").append(rows);
            });
        });
     
        });
    </script>  
</body>
</html>