<?php
/* @description     Transformation Style Sheets - Revolutionising PHP templating    *
 * @author          Tom Butler tom@r.je                                             *
 * @copyright       2017 Tom Butler <tom@r.je> | https://r.je/                      *
 * @license         http://www.opensource.org/licenses/bsd-license.php  BSD License *
 * @version         1.2                                                             */

namespace Transphporm\Pseudo;

class Attribute implements \Transphporm\Pseudo
{
    public function match($name, $args, \DomElement $element)
    {
        if ($name === null) {
            return true;
        }
        return $args[0];
    }
}
