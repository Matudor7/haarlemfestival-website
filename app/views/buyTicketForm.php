
<!DOCTYPE html>
<head>
</head>
<body>
<div class="form-popup" id="ticketForm">
        <form action="/action_page.php" class="form-container">
            <h1>Buy <?php echo $thisEvent->getName()?> Tickets</h1>
            <select id="selectDateInput" class="form-select col" aria-label="Default select example">
                <option value="Selected"selected>Select Date</option>

                <?php
                $dates = array();
                foreach($tickets as $ticket) {
                    $date = $ticket->getProductDate();
                    if(!in_array($date, $dates) && $date != "Everyday") {
                        $dates[] = $date;
                        echo "<option value=\"$date\">$date</option>";
                    }
                }
                ?>
            </select>
            <select id="selectTimeInput" class="form-select col" aria-label="Default select example">
            </select>


            <div id="products" class="form-group m-3">
                <div id="productList" class="list-group">
                </div>
            </div>

            <div id="productOutput">
            <div class="btn-group" role="group">
                <button id="decreasebtn" type="button" class="amountBtns" onClick="changeAmount(-1)">-</button>
                <button id="increasebtn" type="button" class="amountBtns" onClick="changeAmount(+1)">+</button>
            </div>

                <input id="productAmount" class="form-control" type="text" value="Qty" aria-label="readonly input example" readonly>
            <label>X</label>
            <input id="productInfo" class="form-control" type="text" value="Product" aria-label="readonly input example" readonly>
            </div>

            <button type="button" id="closeBtn" class="btn rounded-pill cancel" onclick="closeForm('ticketForm')">Close</button>
            <button type="button" id="addToCartBtn" class="btn rounded-pill" onclick="addToCart()">Add to Cart</button>

        </form>
    </div>
<script src="/js/ticketFormScript.js"></script>
</body>
</html>

<script>
    function updateTimeOptions(selectedDate){
        timeDropdown.innerHTML = "";
        var defaultOption = document.createElement("option");
        defaultOption.text = "Select Time"
        timeDropdown.add(defaultOption);
        let times = new Array();

        <?php foreach ($tickets as $ticket) {?>
        var date = "<?php echo $ticket->getProductDate();?>";
        var time = "<?php echo $ticket->getProductTime();?>";
        if (date == selectedDate & !times.includes(time)){
            var option = document.createElement("option");
            option.text = time;
            timeDropdown.add(option);
            times.push(time);
        }

        <?php }?>
    }
    function updateProductList(selectedDate, selectedTime){
        productListDiv.innerHTML = "";

        <?php foreach ($tickets as $ticket) {?>
        var id = "<?php echo $ticket->getId();?>";
        var name = "<?php echo $ticket->getName();?>";
        var price = "<?php echo '€ '.$ticket->getPrice();?>";
        var date = "<?php echo $ticket->getProductDate();?>";
        var time = "<?php echo $ticket->getProductTime();?>";
        var location = "<?php echo $ticket->getLocation();?>";
        var availability = "<?php echo $ticket->getAvailableSeats();?>";

        if (date == "Everyday" || date == selectedDate && selectedTime == null && availability > 0){

            var product = createProduct(id, name, price, date, time, location)
            productListDiv.appendChild(product);

        } else if (date == selectedDate && time == selectedTime && availability > 0){

            var product = createProduct(id, name, price, date, time, location)
            productListDiv.appendChild(product);
        } else if (date == selectedDate && time == selectedTime && availability <= 0){
            price = "No Tickets Available";
            var product = createProduct(0, name, price, selectedDate, selectedTime, location)
            productListDiv.appendChild(product);
        }
        <?php }?>
    }
    function addToCart(){

        var userId = <?php if (isset($_SESSION["user_id"]) ){echo $_SESSION["user_id"];} else { echo 0;};?>;
        var eventType = <?php echo $thisEvent->getId()?>;

        const data = {"userId": userId,
            "amount": productAmount,
            "productId": selectedProduct,
            "eventType": eventType,
            "note": ""}
        fetch('/api/buyticketform/addToCart', {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        })
            .then(response => response.json())
            .then(data => alert(data))
            .catch(error => console.error(error));

        closeForm('ticketForm');
    }
</script>
<style>
    .form-popup {
        display: none;
        position: fixed;
        top: 53%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 3px solid #000000;
        z-index: 9;
        margin-top: 50px;
    }

    .form-container {
        width: 500px;
        max-height: 370px;
        padding: 10px;
        background-color: white;
        overflow: scroll;
        text-align: center;
    }

    .form-container h1{
        text-align: center;
        margin-bottom: 35px;
    }

    .form-container #selectDateInput{
        max-width: 240px;
        display: inline-block;
        margin-right: 15px;
    }
    .form-container #selectTimeInput{
        max-width: 140px;
        display: inline-block;
    }
    .form-container input[type=text]:focus, .form-container input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    .form-container #productAmount{
        max-width: 55px;
        display: inline-block;
    }

    .form-container #productInfo{
        max-width: 240px;
        display: inline-block;
    }

    .form-container #addToCartBtn {
        background-color: #04AA6D;
        color: white;
        border: none;
        cursor: pointer;
        max-width: 150px;
        display: inline-block;

    }
    .form-container .amountBtns{
        max-height: 40px;
        max-width: 40px;
        background-color: lightgrey;
        margin-right: 10px;
    }
    .form-container #closeBtn {
        background-color: red;
        display: inline-block;
        max-width: 150px;
    }

    .form-container .btn:hover, .open-button:hover {
        opacity: 1;
    }
</style>
