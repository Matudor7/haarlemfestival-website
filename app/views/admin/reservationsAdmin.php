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
<h1>Manage Reservations</h1>
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Full Name</th>
        <th scope="col">Date</th>
        <th scope="col">Restaurant</th>
        <th scope="col"># Adults</th>
        <th scope="col"># Kids</th>
        <th scope="col">Guest Note</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($allReservations as $reservation){?>
    <tr>
        <th scope="row"><?php echo $reservation->getId()?></th>
        <td><?php echo $reservation->getName()?></td>
        <td><?php echo $reservation->getDateTime()->format('dS M/Y @ H:i') ?></td>
        <?php $restaurantId = $reservation->getRestaurantId(); ?>
        <td><?php echo $this->yummyService->getById($restaurantId)->getRestaurantName(); ?></td>
        <td><?php echo $reservation->getAmountAdults()?></td>
        <td><?php echo $reservation->getAmountKids()?></td>
        <td><?php echo $reservation->getAdditionalNote()?></td>
        <td>
            <select class="form-select status-dropdown" data-info="<?php echo $reservation->getId();?>" id="statusDropdown<?php echo $reservation->getId();?>">
                <option value="0"  <?php echo ($reservation->getIsActive() == 0) ? 'selected' : ''; ?>>Cancelled</option>
                <option value="1" <?php echo ($reservation->getIsActive() == 1) ? 'selected' : ''; ?>>Scheduled</option>
            </select>
        </td>
        <td>  <button class="btn btn-primary" type="button" onclick="window.location.href = '/admin/editReservationsPage?id=<?=$reservation->getId()?>'">Edit</button>
    </tr>
    <?php } ?>
    </tbody>
</table>
<button class="btn btn-success ms-3 mb-5" type="button"  onclick="window.location.href = '/admin/editReservationsPage'">Add new Reservation</button>
</body>
</html>
<script>
const statusDropdown2 = document.getElementById("statusDropdown2");
let selectedStatus;
let reservationId;
statusDropdown2.addEventListener('change', function(event){
    selectedStatus = event.target.value;
    reservationId = event.target.dataset.info;
    changeStatus()
})

function changeStatus(){
    const data = {"id": reservationId, "status": selectedStatus}
    fetch('/admin/changeReservationStatus', {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
        .then(response => response.json())
        .then(response => console.log(response))
        .then(location.reload)
        .catch(error => console.error(error));
}
</script>