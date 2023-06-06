<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/stylesheet.css" type="text/css">
</head>
<body>
<?php require __DIR__ . '/../adminNavbar.php'; ?>
<div id="editReservationForm" class="mt-3 ms-2">
    <h1 id="pageTitle" class="mb-4"></h1>
    <form class="row g-3 w-50 ms-5">
    <div class="form-floating col-md-6 mb-2">
        <input type="text" class="form-control" id="nameField" placeholder="name" value="">
        <label for="nameField">Name</label>
    </div>
    <div id="datePickercontainer" class="col-md-6 mb-2">
    <label for="datePicker" class="mb-1">Date + Time:</label>
    <input type="datetime-local" id="datePicker" name="datePicker" class="w-75">
    </div>
    <div class="form-floating mb-3 col-md-6">
        <select class="form-select" id="restaurantDropdown">
            <option selected>...</option>
            <?php foreach ($restaurants as $restaurant){?>
            <option value="<?php echo $restaurant->getRestaurantId()?>"><?php echo $restaurant->getRestaurantName()?></option>
            <?php } ?>
        </select>
        <label for="restaurantDropdown">Restaurant</label>
    </div>
    <div id="quantityChooserContainer" class="mb-3 col-md-6">
        <label for="adultAmountField" class="me-2">Adults:</label>
        <input type="number" id="adultAmountField" min="0" max="10" step="1">
        <label for="kidsAmountField" class="mx-2 pt-3">Kids:</label>
        <input type="number" id="kidsAmountField" min="0" max="10" step="1">
    </div>

<div class="mb-3 row">
    <div class="form-floating">
        <textarea class="form-control" id="additionalGuestNote" style="height: 100px"></textarea>
        <label for="additionalGuestNote">Guest Note</label>
    </div>
</div>
        <div class="form-floating mb-3 col-12 w-75">
            <select class="form-select" id="statusDropdown">
                <option <?php if(!isset($this->reservation)){echo '';} else {echo 'selected';} ;?>>...</option>
                <option value="0" data-id="1">Cancelled</option>
                <option value="1" data-id="2" <?php echo ($reservation->getIsActive() == 1) ? 'selected' : '';?>>Scheduled</option>
            </select>
            <label for="statusDropdown">Status</label>
        </div>
    </form>
        <div id="btnGroup" class="mb-5">
            <button id="saveBtn" class="btn btn-success me-3">Save</button>
            <button class="btn btn-danger" onclick="closeWindow()">Cancel</button>
        </div>

</div>
</body>
</html>
<script>
    const pageTitle = document.getElementById("pageTitle");
    const nameField = document.getElementById("nameField");
    const datePicker = document.getElementById("datePicker");
    const restaurantDropdown = document.getElementById("restaurantDropdown");
    const adultAmountField = document.getElementById("adultAmountField");
    const kidsAmountField = document.getElementById("kidsAmountField");
    const additionalGuestNote = document.getElementById("additionalGuestNote");
    const statusDropdown = document.getElementById("statusDropdown");
    const saveBtn = document.getElementById("saveBtn");
    let reservationId = 0;

window.onload = function loadForm(){
   <?php if ($existingReservation){?>
    reservationId = <?php echo $reservation->getId();?>;
    pageTitle.innerText = "Edit Reservation #"+ reservationId;
    nameField.value = "<?php echo $reservation->getName()?>";
    datePicker.value = "<?php echo $reservation->getDateTime()->format('Y-m-d H:i')?>";
    adultAmountField.value = "<?php echo $reservation->getAmountAdults()?>"
    kidsAmountField.value = "<?php echo $reservation->getAmountKids()?>"
    additionalGuestNote.innerText = "<?php echo $reservation->getAdditionalNote()?>"
    restaurantDropdown.value = "<?php echo $reservation->getRestaurantId()?>"
    //statusDropdown.value = "<//?php echo $reservation->getIsActive()?>"
    statusDropdown.setAttribute('selected', <?php echo ($reservation->getIsActive() == 0) ? 'selected' : '';?>)
    statusDropdown.op
    saveBtn.onclick = updateReservation;
    <?php } else {?>
    pageTitle.innerText = "Add a new Reservation";
    saveBtn.onclick = createReservation;
    <?php }?>
}

function updateReservation(){
        fetch('/admin/editReservation', {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(reservationData()),
        })
            .then(response => response.json())
            .then(response => console.log(response))
            .then(closeWindow)
            .catch(error => console.error(error));
}
function createReservation(){
    fetch('/admin/createReservation', {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(reservationData()),
    })
        .then(response => response.json())
        .then(response => console.log(response))
        .catch(error => console.error(error));
}

function reservationData(){
    const data = { "id": reservationId, "name": nameField.value, "date": datePicker.value, "adults": adultAmountField.value,
        "kids": kidsAmountField.value, "guestNote": additionalGuestNote.value, "restaurantId": restaurantDropdown.value,
        "status": statusDropdown.value }

    return data;
}
function closeWindow(){
 window.location.href = "/admin/manageReservations"
}
</script>