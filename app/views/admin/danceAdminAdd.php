<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add <?php echo $element ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <a href="/adminDance">
            <button type="button" class="my-3 btn btn-primary">Go Back</button>
        </a>
        <h1>Add <?php echo $element ?></h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                <?php echo $addFormHtml?>
                <button type="submit" class="btn btn-success mt-5" name="addbutton" onclick="addElement()">Add
                    <?php echo $element ?></button>
                <a href="/adminDance">
                    <button type="button" class="btn btn-danger mt-5">Cancel</button>
                </a>
            </div>
        </form>
    </div>
    <script>
    function addElement() {
        if ('<?php echo $element ?>' === 'MusicType') {
            addNewMusicType();
        }
        else if ('<?php echo $element ?>' === 'Location') {
            addNewMusicType();
        }
    }
    function addNewMusicType() {
        const danceMusicTypeNameTextBox = document.getElementById('danceMusicTypeNameTextBox').value.trim();

        if (danceMusicTypeNameTextBox === '') {
            window.confirm('Please fill the form correctly.');
        } else {
            const musicTypeData = {
                dance_musicType_name: danceMusicTypeNameTextBox.trim()
            };
            console.log(musicTypeData)

            fetch("http://localhost/api/musicTypes", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(musicTypeData), // stringify the data object
                })
                .catch((err) => {
                    console.error('Error: ', err);
                });
        }
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>