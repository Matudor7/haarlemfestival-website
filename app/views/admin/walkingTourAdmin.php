<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/stylesheet.css" type="text/css">
    <link rel="stylesheet" href="/yummyStyle.css" type="text/css">
</head>
<body>
<?php require __DIR__ . '/../adminNavbar.php'; ?>
<div id="bodyDiv">
<div id="SectionButtons">
    <button id="createSection" type="button" class="btn btn-success m-4" onClick="">Create Section</button>
    <?php foreach($allContent as $content){?>
    <button id="<?php echo $content->getId()?>" type="button" class="btn btn-primary m-4" onClick="selectSection('<?php echo $content->getSection()?>')"><?php echo $content->getSection()?></button>
    <?php } ?>
</div>
    <div id="rightSide">
        <div id="placeholder"><h1>Select Section</h1></div>
    <div id="formGroup">
            <h4 id="sectionName">Section</h4>
            <label for="titleInput" class="form-label mt-3 mb-2"><strong>Title:</strong></label>
            <input id="titleInput" class="form-control" type="text" placeholder="Here goes this section's Title">
            <label for="textInput" class="form-label mt-3 mb-2"><strong>Text:</strong></label>
            <textarea class="form-control" id="textInput" rows="5" placeholder="Here goes this section's Text"></textarea>
            <label for="buttonTextInput" class="form-label mt-3 mb-2"><strong>Button Text:</strong></label>
            <input id="buttonTextInput" class="form-control" type="text" placeholder="Here goes this section's Button Text">

        <button id="deleteSection" type="button" class="btn btn-danger m-3" onclick="">Delete Section</button>
        <div id="buttonGroup"">
            <button id="cancelButton" type="button" class="btn btn-danger" onclick="displayForm('close')">Cancel</button>
            <button id="updateButton" type="button" class="btn btn-success">Save Changes</button>
    </div>
    </div>
    </div>
</div>

</body>
</html>
<script>
const titleInputField = document.getElementById('titleInput');
const textInputField = document.getElementById('textInput');
const buttonTextInputField = document.getElementById('buttonTextInput');
const sectionNameLabel = document.getElementById('sectionName');

const placeHolderDiv = document.getElementById('placeholder');
const formDiv = document.getElementById('formGroup');

function selectSection(sectionName){
    emptyInputFields();
    displayForm('open');

    selectedSection = sectionName;
    sectionNameLabel.innerHTML = sectionName;

    const data = {"section": sectionName}
    fetch('/admin/selectContent', {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
        .then(response => response.json())
        .then(data => { titleInputField.value = data.title; textInputField.innerText = data.text; buttonTextInputField.value = data.button_text;})
        .catch(error => console.error(error));

}

function emptyInputFields(){
    titleInputField.innerText = '';
    textInputField.innerText = '';
    buttonTextInputField.innerText = '';
}
function displayForm(action){

    switch (action){
        case 'open':
            placeHolderDiv.style.display = "none";
            formDiv.style.display = "block";
            break;
        case 'close':
            placeHolderDiv.style.display = "block";
            formDiv.style.display = "none";
            break;
        default:
            console.log("no action selected");
    }
}
</script>
<style>
    #bodyDiv{
        display: flex;
        margin-top: 15px;
}
    #SectionButtons{
        flex: 1;
        display: flex;
        flex-direction: column;
        overflow-y: scroll;
        max-height: 450px;
    }
#rightSide{
    flex: 2;
    position: relative;
}
    #formGroup{
        display: none;
        margin-left: 30px;
        margin-top: 15px;
        margin-right: 30px;
    }
#placeholder{

    position: absolute;
    top: 40%;
    left: 35%;
}
    #buttonGroup{
        float: right;
        margin: 15px;
    }
</style>