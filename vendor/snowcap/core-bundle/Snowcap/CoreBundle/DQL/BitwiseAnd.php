<?php

namespace Snowcap\CoreBundle\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

class BitwiseAnd extends FunctionNode
{

    /**
     * @var \Doctrine\ORM\Query\AST\Literal
     */
    private $firstValue;

    /**
     * @var \Doctrine\ORM\Query\AST\Literal
     */
    private $secondValue;

    /**
     * @param \Doctrine\ORM\Query\Parser $parser
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER); // (2)
        $parser->match(Lexer::T_OPEN_PARENTHESIS); // (3)
        $this->firstValue = $parser->ArithmeticPrimary(); // (4)
        $parser->match(Lexer::T_COMMA); // (5)
        $this->secondValue = $parser->ArithmeticPrimary(); // (6)
        $parser->match(Lexer::T_CLOSE_PARENTHESIS); // (3)
    }

    /**
     * @param \Doctrine\ORM\Query\SqlWalker $sqlWalker
     * @return string
     */
    public function getSql(SqlWalker $sqlWalker)
    {
        return $this->firstValue->dispatch($sqlWalker) . ' & ' . $this->secondValue->dispatch($sqlWalker); // (7)
    }
}