<?php

use PHPUnit\Framework\TestCase;

class PostFormPHPTest extends TestCase
{
    public function testPostFormHandlingResult()
    {
        $_POST['yourName'] = 'AliyyaPS';
        $_POST['yourAddress'] = 'Sidoarjo';

        ob_start();
        include_once './apps/postFormHandling.php';

        $output = ob_get_clean();
        $dom = new DOMDocument();
        $dom->loadHTML($output);

        $titleElemen = $dom->getElementsByTagName('title')->item(0);
        $this->assertEquals('Post Form Handling', $titleElemen->nodeValue, 'Text content elemen title pada halaman seharusnya "Post Form Handling"');

        $h3Elemen = $dom->getElementsByTagName('h3')->item(0);
        $this->assertEquals('Halo! Selamat Datang', $h3Elemen->nodeValue, 'Text content elemen h3 seharusnya "Halo! Selamat Datang"');

        $pElemen = $dom->getElementsByTagName('p')->item(0);
        $this->assertStringContainsString('AliyyaPS yang berasal dari', $pElemen->nodeValue);
        $this->assertStringContainsString('Sidoarjo', $pElemen->nodeValue);
    }
}
