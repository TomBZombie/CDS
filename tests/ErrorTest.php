<?php

class ErrorTest extends PHPUnit_Framework_TestCase
{
    public function testNoTSSRules()
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('No TSS rules parsed');
        $template = new \Transphporm\Builder('<div></div>', 'NONEXISTANT_FILE');
        $template->output();
    }

    public function testPseudoException()
    {
        $this->expectException('Transphporm\\Exception');
        $this->expectExceptionMessage('TSS Error: Problem carrying out pseudo "nth-child" on Line 2 of tss');

        $xml = '<div></div>';
        $tss = '
		div:nth-child(h) { content: "test"; }
		';
        $template = new \Transphporm\Builder($xml, $tss);
        $template->output();
    }

    public function testFormatterException()
    {
        $this->expectException('Transphporm\\Exception');
        $this->expectExceptionMessage('TSS Error: Problem carrying out formatter "test" on Line 2 of tss');

        $xml = '<div></div>';
        $tss = '
		div { content: "test"; format: test; }
		';
        $template = new \Transphporm\Builder($xml, $tss);
        $template->output();
    }

    public function testPropertyException()
    {
        $this->expectException('Transphporm\\Exception');
        $this->expectExceptionMessage('TSS Error: Problem carrying out property "repeat" on Line 2 of tss');

        $xml = '<div></div>';
        $tss = '
		div { repeat: "test"; }
		';
        $template = new \Transphporm\Builder($xml, $tss);
        $template->output();
    }


    public function testFileNotFound()
    {
        $this->expectException('\\Exception');
        $this->expectExceptionMessage('No TSS rules parsed');

        $template = new \Transphporm\Builder('no-file.tss', 'no-file.xml');

        $template->output();
    }

    public function testIncludeFileNotFound()
    {
        $this->expectException('\\Exception');
        $xml = '<div></div>';
        $tss = 'div {content: template("not-found.xml"); }';
        $template = new \Transphporm\Builder($xml, $tss);
        $template->output();
    }
}
