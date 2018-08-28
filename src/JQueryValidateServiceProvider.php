<?php


namespace Mouf\Javascript\JQueryValidate;

use Mouf\Html\Utils\WebLibraryManager\WebLibrary;
use Psr\Container\ContainerInterface;
use TheCodingMachine\Funky\Annotations\Factory;
use TheCodingMachine\Funky\Annotations\Tag;
use TheCodingMachine\Funky\ServiceProvider;

class JQueryValidateServiceProvider extends ServiceProvider
{
    /**
     * @Factory(name="jQueryValidateWebLibrary", tags={@Tag(name="webLibraries", priority=-10.0)})
     */
    public static function createWebLibrary(): WebLibrary
    {
        return new WebLibrary(array(
                'vendor/mouf/javascript.jquery.jquery-validate/jquery.validate.min.js'
            ),
            array());
    }
}
