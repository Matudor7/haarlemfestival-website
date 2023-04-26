<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage Editor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/stylesheet.css" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>

<body>
    <?php
    require __DIR__ . '/../adminNavbar.php';
    ?>
    <?php 
    $contentById = [];
    try{
        foreach ($contents as $content) {
            $contentById[$content->getContentId()] = $content->getContentText();
        }
        if (empty($contentById)){
            echo '<p style="color: red; font-weight: bold;">No data in content table in database</p>';
        }
    } catch (PDOException $e) {
        echo $e;
    }
    ?>
    <section id="header" class="mx-0 my-0 py-0 bg-light">
        <img src="/media/homepagemedia/Banner.png" class="img-fluid py-0" alt="banner">
        <div id="banner-text" class="row mt-5 py-lg-5 justify-content text-center">
            <button id="edit" class="btn btn-primary" onclick="edit(0)" type="button"
                style="width: 100px;">Edit</button>
            <button id="save" class="btn btn-primary" onclick="save(0)" type="button"
                style="width: 100px;">Save</button>
            <div class="click2edit">
                <h1 class="fw-semibold display-2 text-nowrap"><?php echo html_entity_decode($contentById[1]); ?></h1>
            </div>

            <button id="edit" class="btn btn-primary" onclick="edit(1)" type="button"
                style="width: 100px;">Edit</button>
            <button id="save" class="btn btn-primary" onclick="save(1)" type="button"
                style="width: 100px;">Save</button>

            <div class="click2edit">
                <p class=" text-light fs-2"><?php echo html_entity_decode($contentById[2]); ?></p>
            </div>
        </div>
        </div>
    </section>


    <section class="mx-0 my-5 py-0 bg-light">
        <div class="py-lg-5 justify-content text-center">
            <button id="edit" class="btn btn-primary" onclick="edit(2)" type="button"
                style="width: 100px;">Edit</button>
            <button id="save" class="btn btn-primary" onclick="save(2)" type="button"
                style="width: 100px;">Save</button>
            <div class="click2edit">
                <h4 class="fw-semibold text-nowrap display-6"><?php echo html_entity_decode($contentById[3]); ?></h4>
            </div>
            <button id="edit" class="btn btn-primary" onclick="edit(3)" type="button"
                style="width: 100px;">Edit</button>
            <button id="save" class="btn btn-primary" onclick="save(3)" type="button"
                style="width: 100px;">Save</button>
            <div class="click2edit">
                <p class="text-dark fs-5 mx-5"><?php echo html_entity_decode($contentById[4]); ?></p>
            </div>


        </div>
    </section>

    <?php
    foreach($events as $event){
        ?>
    <section id="detail-page-1" class="mx-0 my-5 py-0 bg-light">
        <h4 class="fw-semibold text-nowrap display-6" style="text-align: center;"><?php echo $event->getName()?></h4>
        <h6 class="text-dark fs-5 mx-5" style="text-align: center;"><?php echo $event->getDescription()?></h6>
        <a href="<?php echo $event->getUrlRedirect()?>"><img src=<?php echo $event->getImageUrl()?>
                class="img-fluid py-0" alt="banner"></a>

        <button type="button" class="btn btn-dark border boder-light rounded-pill mx-1 px-3 mt-5"
            onclick="location.href='<?php echo $event->getUrlRedirect()?>'">Go To Page</button>
    </section>
    <?php
    };
  ?>
    <?php include __DIR__ . '/../footer.php';?>

    <script>
    $(document).ready(function() {
        $('.click2edit').each(function() {
            $(this).attr('id', 'editor-' + $(this).index('.click2edit'));
        });
    });

    var edit = function(index) {
        console.log('index:', index);
        $('#editor-' + index).summernote({
            focus: true
        });
    };

    var save = function(index) {
        var markup = $('#editor-' + index).summernote('code');
        $(`.click2edit:eq(${index})`).html(markup); // update HTML content
        var editedContent = $(`.click2edit:eq(${index})`).html();
        saveContent(index, editedContent);
        $('#editor-' + index).summernote('destroy');
    };

    function saveContent(index, newContent) {
        const contentData = {
            content_id : index +1,
            content_text : newContent
        }
        fetch(`http://localhost/api/editor`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(contentData),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                console.log('Content updated successfully.');
            })
            .catch(error => {
                console.error('Error updating content:', error);
            });
    }
    </script>

    <style>
    body {
        background-color: white;
    }

    .bi {
        fill: white;
    }

    #banner-text {
        position: absolute;
        top: 15%;
        left: 50%;
        transform: translate(-50%, 0%);
        color: white;
    }

    #banner-text h1 {
        font-size: 80;
    }

    #date-container {
        position: absolute;
        top: 98%;
        left: 50%;
        transform: translate(-50%, 0%);
        color: white;
    }

    .img-fluid {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    #detail-page-1 {
        position: relative;
        width: 100%;
        height: 100%;
        background-color: white;
    }

    #detail-page-1 img {
        position: relative;
        z-index: 1;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    #detail-page-1 button {
        position: absolute;
        top: 70%;
        left: 22%;
        width: 15%;
        height: 8%;
        transform: translate(-50%, -50%);
        z-index: 2;

    }

    #detail-page-1-title {
        position: absolute;
        top: 15%;
        left: 20%;
        transform: translate(-50%, -50%);
        z-index: 2;
        color: white;
    }

    #detail-page-1-description {
        position: absolute;
        top: 35%;
        left: 20%;
        max-width: 30%;
        transform: translate(-50%, -50%);
        z-index: 2;
        color: white;
    }

    #detail-page-2 {
        position: relative;
        width: 100%;
        height: 100%;
        background-color: white;
    }

    #detail-page-2-img {
        position: relative;
        z-index: 1;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    #detail-page-2-logo {
        position: absolute;
        top: 0%;
        left: 50%;
        transform: translate(-50%, 0%);
        z-index: 2;
    }

    #detail-page-2 button {
        position: absolute;
        top: 65%;
        left: 20%;
        width: 15%;
        height: 8%;
        transform: translate(-50%, -50%);
        z-index: 2;
        background-color: #EC5F41;
        border-width: 2px;
        border-color: #09B4BB;

    }

    #detail-page-2-title {
        position: absolute;
        top: 20%;
        left: 49%;
        transform: translate(-50%, -50%);
        z-index: 2;
        color: black;
        max-width: 20%;
    }

    #detail-page-2-description {
        position: absolute;
        top: 50%;
        left: 20%;
        max-width: 30%;
        transform: translate(-50%, -50%);
        z-index: 2;
        color: black;
        background-color: #09B4BB;
        border-radius: 15px;
        padding: 15px;
    }
    </style>


</body>

</html>