<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="get_currency.js"></script>
</head>
<body>
    <div class="currency_container">
        <div class="form-group">
            <h3>Pick funders currency</h3>
            <div class="currency_form-column"> 
                <form action="session_variables.php" method="post">
                    <label for="Funders currency">Funders currency</label>
                    <select name="funders_currency" name= "funders_currency" id="funders_currency">
                        <option value="USD"> US dollars</option>
                        <option value="Pounds"> Pounds</option>
                        <option value="EURO"> EURO</option>
                        <option value="Can dollar"> Canadian dollars</option>
                        <option value="Yen"> Japannese Yen</option>
                        <option value="AUS dollar"> Austrarian dollars</option>
                    </select>
                    <label for="Exchange rate">Exchange Rate</label>
                    <input type="number" name="exchange_rate" id="exchange_rate">
                </form>
            </div>
            <div>
                <button type = 'submit' id="currency_next_button">Next</button>
            </div>
        </div>
    </div>
    
</body>
</html>