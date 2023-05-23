
<!DOCTYPE html>
<body>
<div id="reservationForm" class="form-popup">
        <form action="/action_page.php" class="form-container">
            <h1>Make Reservation for Restaurant</h1>
            <select id="selectDateInput" class="form-select col" aria-label="Default select example">
                <option value="Selected"selected>Select Date</option>


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
            <?php if($thisEvent->getId() == 2){?>
                    <div id="kidsOutput"></div>
                <button id="addKidsBtn" type="button" class="btn rounded-pill" onClick="addKids()">Add Kids</button>

            <?php }?>

            <div class="m-2 ms-5 me-5">
                <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Additional Notes" rows="3" style="max-height: 60px; max-width:400px "></textarea>
            </div>


            <button type="button" id="addToCartBtn" class="btn rounded-pill" onclick="addToCart()">Add to Cart</button>
            <button type="button" id="closeBtn" class="btn rounded-pill cancel" onclick="closeForm('reservationForm')">Close</button>

        </form>
    </div>
<script src="/js/scriptfile.js"></script>
</body>
</html>
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

    /* Add styles to the form container */
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
