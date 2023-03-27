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
function addAmount(productId){
    console.log(productId);
}