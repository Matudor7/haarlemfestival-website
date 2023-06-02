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
<div id="editReservationForm">
    <h1>Edit Reservation #<?php echo $reservation->getId()?></h1>
    <form class="row g-3 w-50 ms-5">
    <div class="form-floating col-md-6 mb-3">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Name</label>
    </div>
    <div id="datePickercontainer" class="col-md-6 mb-3">
    <label for="datePicker">Reservation Date + Time:</label>
    <input type="datetime-local" id="datePicker" name="datePicker" class="w-75">
    </div>
    <div class="form-floating mb-3 col-md-6">
        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
        <label for="floatingSelect">Works with selects</label>
    </div>
    <div id="quantityChooserContainer" class="mb-3 col-md-6">
        <label for="quantityChooser" class="me-2">Adults:</label>
        <input type="number" id="quantityChooser" name="quantityChooser" min="0" max="10" step="1">
        <label for="quantityChooser" class="me-2 pt-3">Kids:</label>
        <input type="number" id="quantityChooser" name="quantityChooser" min="0" max="10" step="1">
    </div>

<div class="mb-3 row">
    <div class="form-floating">
        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
        <label for="floatingTextarea2">Guest Note</label>
    </div>
</div>
    <div id="StatusChecks">
        <label class="mb-2"><strong>Status:</strong></label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
        <label class="form-check-label" for="flexRadioDefault1">Scheduled</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
        <label class="form-check-label" for="flexRadioDefault2">Canceled</label>
    </div>
    </div>
        <div id="btnGroup" class="mb-5">
            <button class="btn btn-success me-3">Save</button>
            <button class="btn btn-danger">Cancel</button>
        </div>
    </form>
</div>
</body>
</html>
<script>

</script>
<style>

</style>