<?php

/*abstract class MusicType {
    public const Dance = 0;
    public const House = 1;
    public const Trance = 2;
    public const Techno = 3;
    public const Electro = 4;
    public const Minimal = 5;
    public const ProgressiveHouse = 6;

    // Int to type string
    public static function getType(int $type): String {
        switch ($type) {
            case 0:
                return "Dance";
            case 1:
                return "House";
            case 2:
                return "Trance";
            case 3:
                return "Techno";
            case 4:
                return "Electro";
            case 5:
                return "Minimal";
            case 6:
                return "ProgressiveHouse";
        }
        return "Couldn't get type.";
    }
}*/


require_once 'vendor/autoload.php';

use MyCLabs\Enum\Enum;

/**
 * @method static MusicType DANCE()
 * @method static MusicType TRANCE()
 * @method static MusicType TECHNO()
 * @method static MusicType ELECTRO()
 * @method static MusicType MINIMAL()
 * @method static MusicType PROGRESSIVE_HOUSE()
 */
class MusicType extends Enum
{
    private const DANCE = 'Dance';
    private const TRANCE = 'Trance';
    private const TECHNO = 'Techno';
    private const ELECTRO = 'Electro';
    private const MINIMAL = 'Minimal';
    private const PROGRESSIVE_HOUSE = 'ProgressiveHouse';
}
?>