<?php

namespace Dbout\Symfony\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class NotHtml
 *
 * @Annotation
 *
 * @package Dbout\Symfony\Validator\Constraints
 *
 * @author      Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @link        https://github.com/dimitriBouteille Github
 * @copyright   (c) 2019 Dimitri BOUTEILLE
 */
class NotHtml extends Constraint
{

    /**
     * @var string
     */
    public $message = 'Le code html n\'est pas autorisé.';

}
