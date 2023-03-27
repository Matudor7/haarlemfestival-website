function openTicketForm(){
    document.getElementById("ticketForm").style.display="block";
    document.getElementById("main").style.filter = "blur(5px)";
    document.getElementById("ticketForm").style.filter="none";
}

function closeTicketForm(){
    document.getElementById("ticketForm").style.display = "none";
    document.getElementById("main").style.filter = "none";
}

//DANCE JS METHODS
function scrollToElement() {
    document.querySelector('#dance-homepage-schedule').scrollIntoView({
        behavior: 'smooth'
    });
}

//Shopping Cart Methods
function updateAmount(index, userId, action){
    const shoppingCartUrl = "http://localhost/api/shoppingcart?user_id=" + userId;
    const productsUrl = "http://localhost/api/products";

    const amount = document.getElementById("productamount " + index);
    const div = document.getElementById("productdiv " + index);

    fetch(shoppingCartUrl)
    .then(response=> response.json())
    .then(data => {
        if(data.amounts[index] < 1){
            div.remove();
        }

        
    })
    .catch(error=> {console.log(error)
    });

    if(action == "add"){
        amount.innerHTML = parseInt(amount.innerHTML) + 1;
    }else if(action == "delete"){
        amount.innerHTML = parseInt(amount.innerHTML) - 1;
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
    .catch(error=> {
        console.error(error);
    });

    updateAmount(index, userId, "add");
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
    .catch(error=> {
        console.error(error);
    });

    updateAmount(index, userId, "delete");
}