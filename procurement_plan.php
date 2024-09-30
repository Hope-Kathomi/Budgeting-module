<?php 
//session_save_path('C:\Users\hnyaga\Desktop\Software\budget app - 5\budget_app_sessions');
session_start();
include('process_procurement_plan_table.php');

if (isset($_SESSION['combined_table_data'])) {
    $procurementPlanData = $_SESSION['combined_table_data'];
    //print_r($procurementPlanData);
} else {
    echo "No data found!";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procurement Plan</title>
    <!--<meta http-equiv="refresh" content="5">-->
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="nav_panel">
        <div class="page_title_div">Procurement Plan</div>
        <div class="log_out_div">
            <!--<p><?php echo $_SESSION['valid']; ?></p>-->
            <a href="log_out.php">Logout</a>
        </div>
    </div>
    
    <div class="containers" style="background-color: white; "> 
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
                Procurement Plan
            </a>
        </div>
        <div id="period_div">
            <p style="margin-right:50px;">Enter period</p>
            <div>
                <input type="number" placeholder = "start (year)" id="start_year">
                <p style="margin-left:20px; margin-right:20px;" >-</p>
                <input type="text" placeholder = "end (year)" id="end_year">
            </div>  
        </div>
        <div id="Procurement_plan_div">

        </div>
        <div id="Procurement_plan_form">
            <form method="post" action="process_procurement_plan_table.php" class="procurement_plan_form_container">      
                <div class="procurement_plan_div">
                    
                </div> 
                <div class="bottom_buttons">
                    <div><button id="downloadBtn">Download</button></div>
                </div>     
            </form>            
        </div>       
    </div>
</body>
<script>
    const items_lists = <?php echo json_encode($procurementPlanData);?>;
    const items_list_length = items_lists.length;
    
    document.addEventListener("DOMContentLoaded", function() {
        const years = [];
        let start_year, end_year, period;

        function get_years(){
            const start_year_input = document.getElementById('start_year');
            const end_year_input = document.getElementById('end_year');
            
            function calculate_difference(){
                if(start_year!==undefined && end_year!==undefined){
                    const difference = end_year - start_year;
                    return difference;
                }
            }
            
            start_year_input.addEventListener('change', function(){
                start_year = parseInt(start_year_input.value,10);
                update_years();
                calculate_difference()
                period = calculate_difference();
                create_input(period, years);
            });
            end_year_input.addEventListener('change', function(){
                end_year = parseInt(end_year_input.value, 10);
                update_years();
                calculate_difference()
                period = calculate_difference();
                create_input(period, years);
            });
            
        }
        get_years();

        function update_years(){
            if (start_year !== undefined && end_year !== undefined && end_year >=start_year){
                years.length = 0;
                for (let year = start_year; year <= end_year; year++){
                    years.push(year);
                }               
            }
        }

        function create_items_div(item, quantity){
            const new_div = document.createElement('div');
            new_div.style.border = '1px solid #d3d3d3';          
            //new_div.style.padding = "20px";
            new_div.style.marginTop = '40px';
            new_div.style.marginBottom = '40px';
            new_div.style.width = '96%';
            new_div.style.display = 'flex';
            new_div.style.flexDirection ='row';
            new_div.style.borderRadius = '8px';

            const item_div = document.createElement('div');
            item_div.style.backgroundColor = '#d3d3d3';
            item_div.style.padding = '20px';
            item_div.style.width = '300px'
            item_div.style.flexShrink = '0';
            item_div.className = 'item_div';
            item_div.style.borderTopLeftRadius = '8px';
            item_div.style.borderBottomLeftRadius = '8px';

            const name_div = document.createElement('div');
            name_div.style.padding = '20px';
            name_div.className = 'name_div';
            name_div.textContent = `${item}`;

            const Quantity_div = document.createElement('div');
            Quantity_div.style.padding = '20px';
            Quantity_div.textContent = `${quantity}`;
            
            const year_div = document.createElement('div');
            year_div.className = 'year_div';
            year_div.style.padding = '20px';
            year_div.style.display = 'flex';
            year_div.style.flexDirection = 'row';
            year_div.style.maxWidth = '95%';
            year_div.style.flexWrap = 'wrap';
            year_div.style.marginLeft = '50px';
            year_div.style.borderRadius = '8px';
            
            new_div.appendChild(item_div);
            new_div.appendChild(year_div);
            item_div.appendChild(name_div);
            item_div.appendChild(Quantity_div);
            Procurement_plan_div.appendChild(new_div);
        }
        if(items_list_length){
            for(let i = 0; i < items_list_length; i++){
                create_items_div(items_lists[i][1], items_lists[i][2]);
                console.log(items_lists[i][1]);
            }
        }
        
        function create_input(number, years){
            const year_div = document.getElementsByClassName('year_div');
            
            if (year_div.length === 0){
                console.error('No element with class "Year_div" found');
                return;
            }

            for (let j = 0; j < year_div.length; j++){
                year_div[j].innerHTML = '';
                const max_quantity = parseInt(document.getElementsByClassName('item_div')[j].querySelector('div:nth-child(2)').textContent,10);
                console.log('Max',max_quantity);
                const yearly_quantity = [];

                for (let i = 0; i <= number; i++){
                    const div = document.createElement('div');
                    div.style.display = 'flex';
                    div.style.flexDirection = 'row';
                    div.style.alignItems = 'center';
                    div.style.marginRight = '20px';
                    div.style.marginBottom = '18px';
                    
                    if(years[i]){
                        const year = document.createElement('label');
                        year.textContent = `${years[i]}`;
                        div.appendChild(year);
                    }

                    const input = document.createElement('input');
                    input.placeholder = 'Quantity';
                    input.type = 'number';
                    input.id = `input_${j}${i}`;
                    input.style.marginLeft = '10px';
                    input.style.marginBottom = '10px';
                    input.style.border = '1px solid #d3d3d3';
                    input.style.borderRadius = '4px';
                    input.style.height = '40px';

                    input.addEventListener('input', function(){
                        const inputs = year_div[j].getElementsByTagName('input');
                        let total = 0;

                        for (let k = 0; k < inputs.length; k++){
                            const value =parseInt(inputs[k].value, 10) || 0;
                            total+=value;
                        }

                        if (total > max_quantity){
                            alert(`Total quantity for this item cannot exceed ${max_quantity}.`);
                            input.value = '';
                        }
                    })
                                                   
                    div.appendChild(input);
                    year_div[j].appendChild(div);
                }  
                
            }
        }
    });
</script>
</html>
