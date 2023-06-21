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
const testingLabel = document.getElementById('testingLabel')

dateDropdown.addEventListener('change',(event) => {
    const selectedDate = event.target.value;

    updateProductList(selectedDate);
})

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
        kidsAmount = 0;
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