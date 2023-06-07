
<!DOCTYPE html>
<body>
<div class="form-popup" id="reservationForm">
        <form action="/action_page.php" class="form-container">
            <h1>Reserve a table at</h1>
            <h2><em><?php echo $restaurant->getRestaurantName()?></em></h2>
            <select id="selectDateInput" class="form-select col" aria-label="Default select example">
                <option value="Selected">Select Date</option>

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

            <div id="products" class="form-group m-3">
                <div id="productList" class="list-group">
                </div>
            </div>

            <h4 id="selectedTimeslotLbl">Select your preferred Timeslot</h4>

            <div id="reservationDetailsForm" class="m-2 ms-5 me-5">
                <label>Reserve under: </label>
                <input type="text" class="form-control" id="nameField" placeholder="your full name..." style="max-width: 200px; display: inline-block">
                <textarea class="form-control" id="additionalNoteField" placeholder="Write here any notes for the restaurant..." rows="4" style="max-height: 70px; max-width:400px"></textarea>
            </div>


            <div id="productOutput">
            <div class="btn-group" role="group">
                <button id="decreasebtn" type="button" class="amountBtns" onClick="changeAmount(-1)">-</button>
                <button id="increasebtn" type="button" class="amountBtns" onClick="changeAmount(+1)">+</button>
            </div>

                <input id="adultsAmount" class="form-control" type="text" value="Qty" aria-label="readonly input example" readonly>
            <label>X</label>
            <strong id="typeLabel">Adult(s)</strong>
            </div>

                    <div id="kidsOutput"></div>
                <button id="addKidsBtn" type="button" class="btn btn-primary rounded-pill" onClick="addKids()">Add Kids</button>

            <div id="cartButtons">
                <button type="button" id="closeBtn" class="btn rounded-pill cancel" onclick="closeForm('reservationForm')">Close</button>
                <button type="button" id="addToCartBtn" class="btn rounded-pill" onclick="addToCart()">Reserve</button>
            </div>
        </form>
    </div>
<script src="/js/scriptfile.js"></script>
</body>
</html>
<script>
    const dateDropdown = document.getElementById('selectDateInput');
    const productListDiv = document.getElementById('productList');
    const adultsAmountField = document.getElementById('adultsAmount')
    const selectedTimeslotLbl = document.getElementById('selectedTimeslotLbl')
    let adultsAmount = 0;
    let selectedTimeslot;
    let selectedTimeslotId;
    let kidsAmount = 0;
    const productInfoField = document.getElementById("productInfo");
    const reservationDetailName = document.getElementById('nameField')
    const additionalNoteField = document.getElementById('additionalNoteField')
    const reservationDetailsDiv = document.getElementById('reservationDetailsForm')
    //const kidsAmountField = document.getElementById('kidsAmountField')
    const testingLabel = document.getElementById('testingLabel')

    dateDropdown.addEventListener('change',(event) => {
        const selectedDate = event.target.value;

        updateProductList(selectedDate);
    })


    function updateProductList(selectedDate){
        productListDiv.innerHTML = "";
        var restaurant = "<?php echo $restaurant->getRestaurantName()?>";

        <?php foreach ($tickets as $ticket) {?>
        var id = "<?php echo $ticket->getId();?>";
        var name = "<?php echo $ticket->getName();?>";
        var price = "<?php echo '€ '.$ticket->getPrice();?>";
        var date = "<?php echo $ticket->getProductDate();?>";
        var time = "<?php echo $ticket->getProductTime();?>";
        var location = "<?php echo $ticket->getLocation();?>";
        var availability = "<?php echo $ticket->getAvailableSeats();?>";

        if (date == selectedDate && location == restaurant && availability > 0){

            let product = createProduct(id, name, price, date, time, location)
            productListDiv.appendChild(product);

        } else if (date == selectedDate && location == restaurant && availability <= 0){
            price = "No Tables Available";
            let product = createProduct(0, name, price, selectedDate, time, location)
            productListDiv.appendChild(product);
        }
        <?php }?>
    }

    function createProduct(ticketId, ticketName, ticketPrice, ticketDate, ticketTime, ticketLocation){

        var newProduct = document.createElement("a");
        newProduct.setAttribute("onClick", "selectTimeslot("+ticketId+")");
        newProduct.setAttribute("class", "list-group-item list-group-item-action");
        newProduct.setAttribute("id", ticketId)

        var div = document.createElement("div");
        div.setAttribute("class", "d-flex w-75 justify-content-between");

        var h6 = document.createElement("h6");
        h6.setAttribute("class", "mb-1");
        h6.innerHTML = ticketName+" at "+ticketTime;

        var small = document.createElement("strong");
        small.innerHTML = ticketPrice;

        var p = document.createElement("p");
        p.setAttribute("class", "mb-1");
        p.innerHTML = "on the "+ticketDate;

        var location = document.createElement("small");
        location.innerHTML = "Location: "+ ticketLocation;

        div.appendChild(h6);
        div.appendChild(small);
        newProduct.appendChild(div);
        newProduct.appendChild(p);
        newProduct.appendChild(location);

        return newProduct;
    }

    function selectTimeslot(timeslotId){

        if(timeslotId == 0){
            productInfoField.value = "Sold Out"
            adultsAmount.value = "X";
        } else {
            selectedTimeslotId = timeslotId;
            adultsAmount = 1;

            const data = {"productId": timeslotId}
            fetch('/api/reservationform/selectTimeslot', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            })
                .then(response => response.json())
                .then(data => {
                    selectedTimeslot = data.starting_time;
                    let fulldate = new Date(selectedTimeslot);
                    let day = fulldate.getDate();
                    let month = fulldate.toLocaleString('en-US', {month: 'long'})
                    let year = fulldate.getFullYear().toString();
                    let hour = fulldate.getHours();
                    let minutes = fulldate.getMinutes();

                    let formattedTimeslot = day +getOrdinalSuffix()+' of '
                        + month+'/'+year+' at '+hour+':'+minutes;


                    selectedTimeslotLbl.innerText = formattedTimeslot;
                    adultsAmountField.value = adultsAmount;
                })
                .catch(error => console.error(error));

        }
    }

    function changeAmount(number){
        if(number == "+1"){
            adultsAmount+= 1;
        } else if (number == "-1" & adultsAmount > 0) {
            adultsAmount-= 1;
        }

        adultsAmountField.value = adultsAmount;
    }

    function addToCart(){

        let userId = <?php if (isset($_SESSION["user_id"]) ){echo $_SESSION["user_id"];} else { echo 0;};?>;
        const eventType = <?php echo $thisEvent->getId()?>;
        let restaurantId = <?php echo $restaurant->getRestaurantId()?>

        const data = {"userId": userId,
            "adultsAmount": adultsAmount,
            "eventType": eventType,
            "kidsAmount": kidsAmount,
            "reservationName": reservationDetailName.value,
            "restaurantId": restaurantId,
            "timeslotId": selectedTimeslotId,
            "note": additionalNoteField.value}
        fetch('/api/reservationform/addToCart', {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        })
            .then(response => response.json())
            .then(data => alert(data))
            .catch(error => console.error(error));

        closeForm('reservationForm');
    }

    function addKids(){
        const div = document.getElementById('kidsOutput')
        const addButton = document.getElementById('addKidsBtn')
        kidsAmount += 1;

        div.innerText = "";

        const btnGroupDiv = document.createElement('div');
        btnGroupDiv.setAttribute('class', 'btn-group');
        btnGroupDiv.setAttribute('role', 'group');
        div.appendChild(btnGroupDiv);
        const decreaseBtn = document.createElement('button');
        decreaseBtn.setAttribute('id', 'decreasebtn');
        decreaseBtn.setAttribute('type', 'button');
        decreaseBtn.setAttribute('class', 'amountBtns');
        decreaseBtn.setAttribute('onClick', 'deleteKids()');
        decreaseBtn.textContent = '-';
        btnGroupDiv.appendChild(decreaseBtn);
        const productAmountInput = document.createElement('input');
        productAmountInput.setAttribute('id', 'kidsAmountField');
        productAmountInput.setAttribute('class', 'form-control');
        productAmountInput.setAttribute('type', 'text');
        productAmountInput.setAttribute('value', kidsAmount);
        productAmountInput.setAttribute('aria-label', 'readonly input example');
        productAmountInput.setAttribute('readonly', 'true');
        div.appendChild(productAmountInput);

        const label = document.createElement('label');
        label.textContent = ' X ';
        div.appendChild(label);

        const kidsLabel = document.createElement('strong');
        kidsLabel.setAttribute('id', 'typeLabel');
        kidsLabel.innerText = ' Kid(s)';
        div.appendChild(kidsLabel);


    }

    function deleteKids(){
        const div = document.getElementById('kidsOutput')
        if(kidsAmount < 0){
            kidsAmount = 0;
            div.innerText = "";
        } else if(kidsAmount > 1){
            kidsAmount -= 1;
        } else {
            div.innerText = "";
        }
        let kidsAmountField = document.getElementById('kidsAmountField')
        kidsAmountField.value = kidsAmount;
    }
    function getOrdinalSuffix(day) {
        if (day >= 11 && day <= 13) {
            return "th";
        }

        switch (day % 10) {
            case 1: return "st";
            case 2: return "nd";
            case 3: return "rd";
            default: return "th";
        }
    }
</script>
<style>
    #reservationForm {
        display: none;
        position: fixed;
        top: 55%;
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
    }

    .form-container h2{
        margin-bottom: 35px;
        text-align: center;
    }

    .form-container #selectDateInput{
        max-width: 240px;
        display: inline-block;
        margin-right: 15px;
    }

    .form-container #adultsAmount, #kidsAmountField{
        max-width: 55px;
        display: inline-block;
    }

    .form-container #typeLabel{
        display: inline-block;
    }

    .form-container #addKidsBtn{
        background-color: #1DA1F2;
    }
    /* Set a style for the submit/login button */
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
    /* Add a red background color to the cancel button */
    .form-container #closeBtn {
        background-color: red;
        display: inline-block;
        max-width: 150px;
    }

    /* Add some hover effects to buttons */
    .form-container .btn:hover, .open-button:hover {
        opacity: 1;
    }
</style>
