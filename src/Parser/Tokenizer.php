<?php
/* @description     Transformation Style Sheets - Revolutionising PHP templating    *
 * @author          Tom Butler tom@r.je                                             *
 * @copyright       2017 Tom Butler <tom@r.je> | https://r.je/                      *
 * @license         http://www.opensource.org/licenses/bsd-license.php  BSD License *
 * @version         1.2                                                             */

namespace Transphporm\Parser;

class Tokenizer
{
    private $str;
    private $tokenizeRules = [];

    public const NAME = 'LITERAL';
    public const STRING = 'STRING';
    public const OPEN_BRACKET = 'OPEN_BRACKET';
    public const CLOSE_BRACKET = 'CLOSE_BRACKET';
    public const OPEN_SQUARE_BRACKET = 'SQUARE_BRACKET';
    public const CLOSE_SQUARE_BRACKET = 'CLOSE_SQUARE_BRACKET';
    public const CONCAT = 'CONCAT';
    public const ARG = 'ARG';
    public const WHITESPACE = 'WHITESPACE';
    public const NEW_LINE = 'NEW_LINE';
    public const DOT = 'DOT';
    public const NUMERIC = 'NUMERIC';
    public const EQUALS = 'EQUALS';
    public const NOT = 'NOT';
    public const OPEN_BRACE = 'OPEN_BRACE';
    public const CLOSE_BRACE = 'CLOSE_BRACE';
    public const BOOL = 'BOOL';
    public const IN = 'IN';
    public const COLON = 'COLON';
    public const SEMI_COLON = 'SEMI_COLON';
    public const NUM_SIGN = 'NUM_SIGN';
    public const GREATER_THAN = 'GREATER_THAN';
    public const LOWER_THAN = 'LOWER_THAN';
    public const AT_SIGN = 'AT_SIGN';
    public const SUBTRACT = 'SUBTRACT';
    public const MULTIPLY = 'MULTIPLY';
    public const DIVIDE = 'DIVIDE';

    public function __construct($str)
    {
        $this->str = new Tokenizer\TokenizedString($str);

        $this->tokenizeRules = [
            new Tokenizer\Comments(),
            new Tokenizer\BasicChars(),
            new Tokenizer\Literals(),
            new Tokenizer\Strings(),
            new Tokenizer\Brackets()
        ];
    }

    public function getTokens()
    {
        $tokens = new Tokens();
        $this->str->reset();

        while ($this->str->next()) {
            foreach ($this->tokenizeRules as $tokenizer) {
                $tokenizer->tokenize($this->str, $tokens);
            }
        }

        return $tokens;
    }
}
