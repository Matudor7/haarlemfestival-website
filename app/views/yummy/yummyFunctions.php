<?php

class yummyFunctions
{
    function displayImageBasedOnEnum($enumValue) {
        switch ($enumValue) {
            case 'NoRating':
                echo '<img src="\yummyPics\3startsPic.svg" alt="Red Image">';
                break;
            case 'OneStar':
                echo '<img src="\yummyPics\4startsPic.png" alt="Green Image">';
                break;
           /* case 'TwoStar':
                echo '<img src="blue-image.jpg" alt="Blue Image">';
                break;
            case 'threeStar':
                echo '<img src="blue-image.jpg" alt="Blue Image">';
                break;
            case 'FourStar':
                echo '<img src="blue-image.jpg" alt="Blue Image">';
                break;*/
            default:
                echo '<img src="\yummyPics\4startsPic.png" alt="Default Image">';
                break;
        }
    }

}