<?php

use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    public function testFirstPHPCode()
    {

        ob_start();
        include_once './apps/index.php';

        $output = ob_get_clean();
        $dom = new DOMDocument();
        $dom->loadHTML($output);
        $content = $dom->textContent;
        $expectedMessage = "Hello World!";
        $this->assertEquals($expectedMessage, $content, 'Tidak ditemukan teks "Hello World!');
    }
}
