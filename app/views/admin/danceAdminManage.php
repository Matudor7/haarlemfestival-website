<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Dance [Element Name]</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<?php 
function generateTableByElement($element, $artists,$danceLocations, $danceEvents){
    switch ($element) { // Generate HTML table based on the type of element being managed
        case "Artist":
            $tableHtml = generateArtistTable($artists);
            break;
        case "Location":
            $tableHtml = generateLocationTable($danceLocations);
            break;
        case "Event":
            $tableHtml = generateEventTable($danceEvents);
            break;
        default:
            $tableHtml =
                "<p>There has been an error. Please try again later.</p>";
            break;
    }
    return $tableHtml;
}
function generateArtistTable($artists)
    {   
        $musicTypeLink = '/adminDance/danceAdminAdd?type=MusicType';
        $musicTypeButton = '<a href="'.$musicTypeLink.'">
                      <button type="button" class="btn btn-info">Add New Music Type</button>
                      </a>';

        $tableHtml = $musicTypeButton . '<table class="table">';
        $tableHtml .= '<thead class="thead-light">
                <tr>
                    <th scope="col">Artist Id </th>
                    <th scope="col">Artist Photo</th>
                    <th scope="col">Artist Name</th>
                    <th scope="col">Music Type</th>
                    <th scope="col">Detail Page</th>
                    <th scope="col">Image Url</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>';
        $tableHtml .= "<tbody>";

        foreach ($artists as $artist) {
            $tableHtml .= "<tr>";
            $tableHtml .= "<td>" . $artist->getId() . "</td>";
            $tableHtml .=
                '<td><img src="' .
                $artist->getArtistHomepageImageUrl() .
                '" class="img-fluid" alt="' .
                $artist->getName() .
                ' Photo" style="max-height:30px;"></td>';
            $tableHtml .= "<td>" . $artist->getName() . "</td>";
            $tableHtml .= "<td>" . $artist->getArtistMusicTypes() . "</td>";
            $tableHtml .=
                "<td>" . ($artist->getHasDetailPage() ? "Yes" : "No") . "</td>";
            $tableHtml .=
                "<td>" . $artist->getArtistHomepageImageUrl() . "</td>";
            $tableHtml .= '<td><button class="btn btn-warning" onclick="editElement(' . $artist->getId() . ')">Edit</button></td>';
                $tableHtml .= '<td><button class="btn btn-danger" onclick="deleteElement(' . $artist->getId() . ')">Delete</button></td>';
            $tableHtml .= "</tr>";
        }

        $tableHtml .= "</tbody></table>";
        return $tableHtml;
    }
    function generateLocationTable($danceLocations)
    {
        $tableHtml = '<table class="table">';
        $tableHtml .= '<thead class="thead-light">
                <tr>
                    <th scope="col">Location Id </th>
                    <th scope="col">Location Photo</th>
                    <th scope="col">Location Name</th>
                    <th scope="col">Street</th>
                    <th scope="col">Number</th>
                    <th scope="col">Postcode</th>
                    <th scope="col">City</th>
                    <th scope="col">URL to their site</th>
                    <th scope="col">Image URL</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>';
        $tableHtml .= "<tbody>";

        foreach ($danceLocations as $location) {
            $tableHtml .= "<tr>";
            $tableHtml .= "<td>" . $location->getDanceLocationId() . "</td>";
            $tableHtml .=
                '<td><img src="' .
                $location->getDanceLocationImageUrl() .
                '" class="img-fluid" alt="' .
                $location->getDanceLocationName() .
                ' Photo" style="max-height:30px;"></td>';
            $tableHtml .= "<td>" . $location->getDanceLocationName() . "</td>";
            $tableHtml .=
                "<td>" . $location->getDanceLocationStreet() . "</td>";
            $tableHtml .=
                "<td>" . $location->getDanceLocationNumber() . "</td>";
            $tableHtml .=
                "<td>" . $location->getDanceLocationPostcode() . "</td>";
            $tableHtml .= "<td>" . $location->getDanceLocationCity() . "</td>";
            $tableHtml .=
                "<td>" . $location->getDanceLocationUrlToTheirSite() . "</td>";
            $tableHtml .=
                "<td>" . $location->getDanceLocationImageUrl() . "</td>";
            $tableHtml .= '<td><button class="btn btn-warning" onclick="editElement(' . $location->getDanceLocationId() . ')">Edit</button></td>';
            $tableHtml .= '<td><button class="btn btn-danger" onclick="deleteElement(' . $location->getDanceLocationId() . ')">Delete</button></td>';
            $tableHtml .= "</tr>";
        }

        $tableHtml .= "</tbody></table>";
        return $tableHtml;
    }
    function generateEventTable($danceEvents)
    {
        $tableHtml = '<table class="table">';
        $tableHtml .= '<thead class="thead-light">
                <tr>
                    <th scope="col">Event Id </th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Location Name</th>
                    <th scope="col">Artists</th>
                    <th scope="col">Session</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Available Tickets</th>
                    <th scope="col">Price</th>
                    <th scope="col">Extra Note</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>';
        $tableHtml .= "<tbody>";

        foreach ($danceEvents as $event) {
            $tableHtml .= "<tr>";
            $tableHtml .= "<td>" . $event->getDanceEventId() . "</td>";
            $tableHtml .=
                "<td>" .
                $event->getDanceEventDateTime()->format("d-m-Y") .
                "</td>";
            $tableHtml .=
                "<td>" .
                $event->getDanceEventDateTime()->format("H:i") .
                "</td>";
            $tableHtml .= "<td>" . $event->getDanceLocationName() . "</td>";
            $tableHtml .= "<td>" . $event->getPerformingArtists() . "</td>";
            $tableHtml .= "<td>" . $event->getDanceSessionTypeName() . "</td>";
            $tableHtml .= "<td>" . $event->getDanceEventDuration() . "</td>";
            $tableHtml .=
                "<td>" . $event->getDanceEventAvailableTickets() . "</td>";
            $tableHtml .=
                "<td>" .
                number_format($event->getDanceEventPrice(), 2, ".", "") .
                "€" .
                "</td>";
            $tableHtml .= "<td>" . $event->getDanceEventExtraNote() . "</td>";
            $tableHtml .= '<td><button class="btn btn-warning" onclick="editElement(' . $event->getDanceEventId() . ')">Edit</button></td>';
            $tableHtml .= '<td><button class="btn btn-danger" onclick="deleteElement(' . $event->getDanceEventId() . ')">Delete</button></td>';
            $tableHtml .= "</tr>";
        }

        $tableHtml .= "</tbody></table>";
        return $tableHtml;
    }
?>

<body>
    <?php
    require __DIR__ . '/../adminNavbar.php';
    ?>
    <div class="container-fluid">
        <h1>Manage Dance <?php echo $element ?>s</h1>

        <a href="/adminDance/danceAdminAdd?type=<?php echo $element ?>">
            <button class="btn btn-success my-3">Add New Dance <?php echo $element ?></button>
        </a>
        <?php $tableHtml = generateTableByElement($element, $artists,$danceLocations, $danceEvents); 
        echo $tableHtml ?>
    </div>
    <script>
    function deleteElement(id) {
        if ('<?php echo $element ?>' === 'Location') {
            window.location.href = '/adminDance/deleteElement?type=Location&id=' + id;
        } else if ('<?php echo $element ?>' === 'Artist') {
            window.location.href = '/adminDance/deleteElement?type=Artist&id=' + id;
        }else if ('<?php echo $element ?>' === 'Event') {
            window.location.href = '/adminDance/deleteElement?type=Event&id=' + id;
        }
    }

    function editElement(id) {
        if ('<?php echo $element ?>' === 'Location') {
            window.location.href = '/adminDance/editElement?type=Location&id=' + id;
        } else if ('<?php echo $element ?>' === 'Artist') {
            window.location.href = '/adminDance/editElement?type=Artist&id=' + id;
        }else if ('<?php echo $element ?>' === 'Event') {
            window.location.href = '/adminDance/editElement?type=Event&id=' + id;
        }
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>