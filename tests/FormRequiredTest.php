<?php

use PHPUnit\Framework\TestCase;

class FormRequiredTest extends TestCase
{
    public function testVariableUndefined()
    {
        $_GET['error'] = 'variable_undefined';

        ob_start();
        include './apps/formRequired.php';

        $output = ob_get_clean();
        $dom = new DOMDocument();
        $dom->loadHTML($output);
        $errorMessage = $dom->getElementsByTagName('span')->item(0)->textContent;
        $expectedMessage = "Maaf, kamu harus mengakses halaman ini dari formRequired.php";
        $this->assertEquals($expectedMessage, $errorMessage, 'Pesan error untuk kondisi $_GET["error"] == "variable_undefined" tidak sesuai spesifikasi');

        $this->verifyFormAttributes($dom);
    }

    public function testEmptyName()
    {
        $_GET['error'] = 'empty_name';

        ob_start();
        include './apps/formRequired.php';

        $output = ob_get_clean();
        $dom = new DOMDocument();
        $dom->loadHTML($output);
        $errorMessage = $dom->getElementsByTagName('span')->item(0)->textContent;
        $expectedMessage = "Maaf, nama harus terisi";
        $this->assertEquals($expectedMessage, $errorMessage, 'Pesan error untuk kondisi $_GET["error"] == "empty_name" tidak sesuai spesifikasi');

        $this->verifyFormAttributes($dom);
    }

    public function testEmptyAddress()
    {
        $_GET['error'] = 'empty_address';

        ob_start();
        include './apps/formRequired.php';

        $output = ob_get_clean();
        $dom = new DOMDocument();
        $dom->loadHTML($output);
        $errorMessage = $dom->getElementsByTagName('span')->item(0)->textContent;
        $expectedMessage = "Maaf, alamat harus terisi";
        $this->assertEquals($expectedMessage, $errorMessage, 'Pesan error untuk kondisi $_GET["error"] == "empty_name" tidak sesuai spesifikasi');

        $this->verifyFormAttributes($dom);
    }

    private function verifyFormAttributes(DOMDocument $dom)
    {
        $form = $dom->getElementsByTagName('form')->item(0);
        $this->assertEquals('prosesFormRequired.php', $form->attributes->getNamedItem('action')->nodeValue, 'Nilai atribut action pada form tidak sesuai dengan spesikfikasi');
        $this->assertEqualsIgnoringCase('GET', $form->attributes->getNamedItem('method')->nodeValue, 'Nilai atribut method pada form != GET');

        $tdName = $dom->getElementsByTagName('td')->item(0);
        $this->assertEquals('Nama Kamu:', $tdName->textContent, 'Text content pada elemen td pertama dalam form seharusnya "Nama Kamu"');

        $inputName = $dom->getElementsByTagName('input')->item(0);
        $this->assertEquals('text', $inputName->attributes->getNamedItem('type')->nodeValue, 'Nilai atribut type pada elemen input pertama dalam form seharusnya "text"');
        $this->assertEquals('yourname', $inputName->attributes->getNamedItem('name')->nodeValue, 'Nilai atribut name pada elemen input pertama dalam form seharusnya "yourname"');
        $this->assertEquals('', $inputName->attributes->getNamedItem('value')->nodeValue);

        $tdName = $dom->getElementsByTagName('td')->item(2);
        $this->assertEquals('Alamat Kamu:', $tdName->textContent, 'Text content pada elemen td ketiga dalam form seharusnya "Alamat Kamu"');

        $inputAddress = $dom->getElementsByTagName('input')->item(1);
        $this->assertEquals('text', $inputAddress->attributes->getNamedItem('type')->nodeValue, 'Nilai atribut type pada elemen input kedua dalam form seharusnya "text"');
        $this->assertEquals('youraddress', $inputAddress->attributes->getNamedItem('name')->nodeValue, 'Nilai atribut name pada elemen input kedua dalam form seharusnya "youraddress"');
        $this->assertEquals('', $inputAddress->attributes->getNamedItem('value')->nodeValue);

        $inputSubmit = $dom->getElementsByTagName('input')->item(2);
        $this->assertEquals('submit', $inputSubmit->attributes->getNamedItem('type')->nodeValue, 'Nilai atribut type pada elemen input ketiga dalam form != submit');
        $this->assertEquals('submit', $inputSubmit->attributes->getNamedItem('name')->nodeValue, 'Nilai atribut name pada elemen input ketiga dalam form != submit');
        $this->assertEquals('Submit', $inputSubmit->attributes->getNamedItem('value')->nodeValue, 'Nilai atribut value pada elemen input ketiga dalam form != Submit');
    }
}
