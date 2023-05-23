function openForm(formId){
    document.getElementById(formId).style.display="block";
    document.getElementById("main").style.filter = "blur(5px)";
    document.getElementById(formId).style.filter="none";
}

function closeForm(formId){
    location.reload();
    document.getElementById(formId).style.display = "none";
    document.getElementById("main").style.filter = "none";
}
//DANCE JS METHODS
function scrollToElement() {
    document.querySelector('#dance-homepage-schedule').scrollIntoView({
        behavior: 'smooth'
    });
}

//Shopping Cart Methods
//Tudor Nosca (678549)
function copyCartLink(userId){
    var text = "http://localhost/shareCart?user_id=" + userId;

    navigator.clipboard.writeText(text);

    alert("Copied link (" + text + ")");
}

function updateProduct(index, userId, action){
    const shoppingCartUrl = "http://localhost/api/shoppingcart?user_id=" + userId;
    const amount = document.getElementById("productamount " + index);
    const div = document.getElementById("productdiv " + index);
    
    const productPrice = document.getElementById("productprice " + index);

    fetch(shoppingCartUrl)
    .then(response=> response.json())
    .then(data => {
        return fetch("http://localhost/api/products?product_id=" + data.product_id[index])
        .then(response=>response.json())
        .then(product=>{
            price = product.price * data.amount[index];
        })
        .then(()=>{
            productPrice.innerHTML = '\u20AC' + price;
            updateTotal(userId);
        })
    })
    .catch(error=> {console.error(error)
    });
    
    if(action == "add"){
        amount.innerHTML = parseInt(amount.innerHTML) + 1;
    }else if(action == "delete"){
        if(parseInt(amount.innerHTML) <= 1){
            location.reload();
        }else{
            amount.innerHTML = parseInt(amount.innerHTML) - 1;
        }
    }
}

function updateTotal(userId){
    const totalPriceHeader = document.getElementById("totalprice");

    const shoppingCartUrl = "http://localhost/api/shoppingcart?user_id=" + userId;

    fetch(shoppingCartUrl)
    .then(response=> response.json())
    .then(data => {
            let totalPrice = 0;
            const vat = 0.21;
            for (let i = 0; i < data.product_id.length; i++) {
                fetch("http://localhost/api/products?product_id=" + data.product_id[i])
                .then(response=>response.json())
                .then(product=>{
                totalPrice += (product.price * data.amount[i]);
                totalPriceHeader.innerHTML = 'Total: ' + '\u20AC' + (totalPrice + (totalPrice * vat));
                })
            }
    })
    .catch(error=> {console.error(error)
    });
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
            amount: [{index: index, decrement: 1}]
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