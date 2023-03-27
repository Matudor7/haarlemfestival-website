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
function updateAmount(){

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
}