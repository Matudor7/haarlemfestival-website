function openTicketForm(){
    document.getElementById("ticketForm").style.display="block";
    document.getElementById("main").style.filter = "blur(5px)";
    document.getElementById("ticketForm").style.filter="none";
}

function closeTicketForm(){
    document.getElementById("ticketForm").style.display = "none";
    document.getElementById("main").style.filter = "none";
}

//validate date in ticket form to display times
function selectedDate(date){
    var dateDropdown = document.getElementById(selectDateInput);
    if(dateDropdown.value == "Selected"){
        document.getElementById("testinglabel").contentEditable = "red";
    } else {
        alert("selected date" + date);
    }
}
//DANCE JS METHODS
function scrollToElement() {
    document.querySelector('#dance-homepage-schedule').scrollIntoView({
        behavior: 'smooth'
    });
}

//Shopping Cart Methods
async function updateProduct(index, userId, action){
    const shoppingCartUrl = "http://localhost/api/shoppingcart?user_id=" + userId;
    const amount = document.getElementById("productamount " + index);
    const div = document.getElementById("productdiv " + index);
    
    const productPrice = document.getElementById("productprice " + index);

    fetch(shoppingCartUrl)
    .then(response=> response.json())
    .then(data => {
        return fetch("http://localhost/api/products?product_id=" + data.product_ids[index])
        .then(response=>response.json())
        .then(product=>{
            price = product[0].price * data.amounts[index];
        })
        .then(()=>{
            productPrice.innerHTML = '\u20AC' + price;
        })
    })
    .catch(error=> {console.error(error)
    });
    
    if(action == "add"){
        amount.innerHTML = parseInt(amount.innerHTML) + 1;
    }else if(action == "delete"){
        if(parseInt(amount.innerHTML) <= 1){
            div.remove();
        }else{
            amount.innerHTML = parseInt(amount.innerHTML) - 1;
        }
    }
}

function addAmount(index, userId, productId){
    const apiUrl = 'http://localhost/api/shoppingcart?user_id=' + userId + '&product_id=' + productId + '&action=add';
    fetch(apiUrl, {
        method: "PATCH",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            amounts: [{index: index, increment: 1}]
        })
    })
    .then(response => {
        if(!response.ok){
            throw new Error('Request failed.');
        }
    })
    .then(()=>{
        updateProduct(index, userId, "add");
    })
    .catch(error=> {
        console.error(error);
    });
}

function removeAmount(index, userId, productId){
    const apiUrl = 'http://localhost/api/shoppingcart?user_id=' + userId + '&product_id=' + productId + '&action=delete';

    fetch(apiUrl, {
        method: "PATCH",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            amounts: [{index: index, decrement: 1}]
        })
    })
    .then(response => {
        if(!response.ok){
            throw new Error('Request failed.');
        }
    })
    .then(()=>{
        updateProduct(index, userId, "delete");
    })
    .catch(error=> {
        console.error(error);
    });
}