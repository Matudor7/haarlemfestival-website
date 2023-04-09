
<!DOCTYPE html>
<head>
</head>
<body>
<div class="form-popup" id="ticketForm">
        <form action="/action_page.php" class="form-container">
            <h1>Buy <?php echo $thisEvent->getName()?> Tickets</h1>
            <label id="testingLabel">0</label>
            <select id="selectDateInput" class="form-select col" aria-label="Default select example">
                <option value="Selected"selected>Select Date</option>

                <?php
                $dates = array();
                foreach($tickets as $ticket) {
                    $date = $ticket->getProductDate();
                    if(!in_array($date, $dates)) {
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


            <input id="productAmount" class="form-control" type="text" value="Qty" aria-label="readonly input example" readonly>
            <label>X</label>
            <input id="productInfo" class="form-control" type="text" value="Product" aria-label="readonly input example" readonly>


            <div class="m-2 ms-5 me-5">
                <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Additional Notes" rows="3" style="max-height: 60px; max-width:400px "></textarea>
            </div>


            <button type="button" id="addToCartBtn" class="btn rounded-pill" onclick="">Add to Cart</button>
            <button type="button" id="closeBtn" class="btn rounded-pill cancel" onclick="closeTicketForm()">Close</button>

        </form>
    </div>
<script src="/js/scriptfile.js"></script>
</body>
</html>

<script>
    const dateDropdown = document.getElementById('selectDateInput');
    const timeDropdown = document.getElementById('selectTimeInput');
    const testingLabel = document.getElementById('testingLabel');
    const productListDiv = document.getElementById('productList');
    const productAmountField = document.getElementById("productAmount")
    const productInfoField = document.getElementById("productInfo");

    dateDropdown.addEventListener('change',(event) => {
        const selectedDate = event.target.value;

        updateTimeOptions(selectedDate);
        updateProductList(selectedDate, null);
    })

    timeDropdown.addEventListener('change',(event) => {
        const selectedTime = event.target.value;

        updateProductList(dateDropdown.value, selectedTime)
    })

    function updateTimeOptions(selectedDate){
        timeDropdown.innerHTML = "";
        var defaultOption = document.createElement("option");
        defaultOption.text = "Select Time"
        timeDropdown.add(defaultOption);

        <?php foreach ($tickets as $ticket) {?>
        var date = "<?php echo $ticket->getProductDate();?>";
        var time = "<?php echo $ticket->getProductTime();?>";

        if (date == selectedDate){
            var option = document.createElement("option");
            option.text = time;
            timeDropdown.add(option);
        }

        <?php }?>
    }

    function updateProductList(selectedDate, selectedTime){
        productListDiv.innerHTML = "";

        <?php foreach ($tickets as $ticket) {?>
        var id = "<?php echo $ticket->getId();?>";
        var name = "<?php echo $ticket->getName();?>";
        var price = "<?php echo $ticket->getPrice();?>";
        var date = "<?php echo $ticket->getProductDate();?>";
        var time = "<?php echo $ticket->getProductTime();?>";
        var location = "<?php echo $ticket->getLocation();?>";

        if (date == selectedDate && selectedTime == null){

            var product = createProduct(id, name, price, date, time, location)
            productListDiv.appendChild(product);

        } else if (date == selectedDate && time == selectedTime){

            var product = createProduct(id, name, price, date, time, location)
            productListDiv.appendChild(product);
        }
        <?php }?>
    }

    function createProduct(ticketId, ticketName, ticketPrice, ticketDate, ticketTime, ticketLocation){

        var newProduct = document.createElement("a");
        newProduct.setAttribute("onClick", "selectProduct("+ticketId+")");
        newProduct.setAttribute("class", "list-group-item list-group-item-action");
        newProduct.setAttribute("id", ticketId)

        var div = document.createElement("div");
        div.setAttribute("class", "d-flex w-75 justify-content-between");

        var h6 = document.createElement("h6");
        h6.setAttribute("class", "mb-1");
        h6.innerHTML = ticketName;

        var small = document.createElement("small");
        small.innerHTML ="€ " + ticketPrice;

        var p = document.createElement("p");
        p.setAttribute("class", "mb-1");
        p.innerHTML = ticketDate + " at " + ticketTime;

        var location = document.createElement("small");
        location.innerHTML = "Location: "+ ticketLocation;

        // append the child elements to the parent element
        div.appendChild(h6);
        div.appendChild(small);
        newProduct.appendChild(div);
        newProduct.appendChild(p);
        newProduct.appendChild(location);

        return newProduct;
    }

    function selectProduct(productId){

        //<//?php $id = 1; $productService = new ProductService(); ?>
        testingLabel.innerText = productId;

        //productInfoField.value = "<//?php echo $productService->getById($id)->getName()?>";

        
    }
</script>
<style>
    .form-popup {
        display: none;
        position: fixed;
        top: 63%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 3px solid #000000;
        z-index: 9;
    }

    /* Add styles to the form container */
    .form-container {
        max-width: 500px;
        max-height: 370px;
        padding: 10px;
        background-color: white;
        overflow: auto;
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
    /* When the inputs get focus, do something */
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

    /* Set a style for the submit/login button */
    .form-container #addToCartBtn {
        background-color: #04AA6D;
        color: white;
        border: none;
        cursor: pointer;
        max-width: 150px;
        display: inline-block;

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
