<?php

use PHPUnit\Framework\TestCase;

class ValidasiFormPHPTest extends TestCase
{
    public function testValidFormData()
    {
        $_GET['yourName'] = 'AliyyaPS';
        $_GET['yourAddress'] = 'Sidoarjo';

        ob_start();
        include_once './apps/validasiForm.php';

        $output = ob_get_clean();
        $dom = new DOMDocument();
        $dom->loadHTML($output);

        $titleElemen = $dom->getElementsByTagName('title')->item(0);

        $this->assertEquals('Validasi Form', $titleElemen->nodeValue, 'Text content elemen title pada halaman seharusnya "Validasi Form""');

        $bodyElemen = $dom->getElementsByTagName('body')->item(0);
        $this->assertStringContainsString('Selamat Datang AliyyaPS yang berasal dari Sidoarjo', $bodyElemen->nodeValue);
    }

    public function testInvalidFormData()
    {
        $html = file_get_contents('./apps/validasiForm.php');
        $dom = new DOMDocument();
        $dom->loadHTML($html);

        $titleElemen = $dom->getElementsByTagName('title')->item(0);

        $this->assertEquals('Validasi Form', $titleElemen->nodeValue, 'Text content elemen title pada halaman seharusnya "Validasi Form""');

        $bodyElemen = $dom->getElementsByTagName('body')->item(0);
        $this->assertStringContainsString('Maaf, Kamu harus mengakses halaman ini dari validasiForm.html', $bodyElemen->nodeValue);
    }
}
