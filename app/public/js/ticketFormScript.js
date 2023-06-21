const dateDropdown = document.getElementById('selectDateInput');
const timeDropdown = document.getElementById('selectTimeInput');
const productListDiv = document.getElementById('productList');
const productAmountField = document.getElementById("productAmount")
let productAmount = 0;
let selectedProduct;
let kidsAmount = 0;
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
    small.innerHTML = ticketPrice;

    var p = document.createElement("p");
    p.setAttribute("class", "mb-1");
    p.innerHTML = "on "+ticketDate + " at " + ticketTime;

    var location = document.createElement("small");
    location.innerHTML = "Location: "+ ticketLocation;

    div.appendChild(h6);
    div.appendChild(small);
    newProduct.appendChild(div);
    newProduct.appendChild(p);
    newProduct.appendChild(location);

    return newProduct;
}

function selectProduct(productId){

    if(productId == 0){
        productInfoField.value = "Sold Out"
        productAmount.value = "X";
    } else {
        selectedProduct = productId;
        productAmount = 1;

        const data = {"productId": productId}
        fetch('/api/buyticketform/selectTicket', {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        })
            .then(response => response.json())
            .then(data => {productInfoField.value = data.name; productAmountField.value = productAmount;})
            .catch(error => console.error(error));

    }
}

function changeAmount(number){
    if(number == "+1"){
        productAmount+= 1;
    } else if (number == "-1" & productAmount > 0) {
        productAmount-= 1;
    }

    productAmountField.value = productAmount;
}

