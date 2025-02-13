<?php
/* @description     Transformation Style Sheets - Revolutionising PHP templating    *
 * @author          Tom Butler tom@r.je                                             *
 * @copyright       2017 Tom Butler <tom@r.je> | https://r.je/                      *
 * @license         http://www.opensource.org/licenses/bsd-license.php  BSD License *
 * @version         1.2                                                             */

namespace Transphporm;

class Exception extends \Exception
{
    public const PROPERTY = 'property';
    public const TSS_FUNCTION = 'function';
    public const PSEUDO = 'pseudo';
    public const FORMATTER = 'formatter';

    public function __construct(RunException $runException, $file, $line)
    {
        $message = $runException->getMessage() . ' on Line ' . $line . ' of ' . ($file === null ? 'tss' : $file);

        parent::__construct($message, 0, $runException->getPrevious());
    }
}
