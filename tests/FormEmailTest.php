<?php

use PHPUnit\Framework\TestCase;

class FormEmailTest extends TestCase
{
    public function testVariableUndefined()
    {
        $_GET['error'] = 'variable_undefined';

        ob_start();
        include './apps/formEmail.php';

        $output = ob_get_clean();
        $dom = new DOMDocument();
        $dom->loadHTML($output);
        $errorMessage = $dom->getElementsByTagName('span')->item(0)->textContent;
        $expectedMessage = "Maaf, kamu harus mengakses halaman ini dari formEmail.php";
        $this->assertEquals($expectedMessage, $errorMessage, 'Pesan error untuk kondisi $_GET["error"] == "variable_undefined" tidak sesuai spesifikasi');

        $this->verifyFormAttributes($dom);
    }

    public function testEmptyName()
    {
        $_GET['error'] = 'empty_name';

        ob_start();
        include './apps/formEmail.php';

        $output = ob_get_clean();
        $dom = new DOMDocument();
        $dom->loadHTML($output);
        $errorMessage = $dom->getElementsByTagName('span')->item(0)->textContent;
        $expectedMessage = "Maaf, nama harus terisi";
        $this->assertEquals($expectedMessage, $errorMessage, 'Pesan error untuk kondisi $_GET["error"] == "empty_name" tidak sesuai spesifikasi');

        $this->verifyFormAttributes($dom);
    }

    public function testInvalidName()
    {
        $_GET['error'] = 'invalid_name';

        ob_start();
        include './apps/formEmail.php';

        $output = ob_get_clean();
        $dom = new DOMDocument();
        $dom->loadHTML($output);
        $errorMessage = $dom->getElementsByTagName('span')->item(0)->textContent;
        $expectedMessage = "Maaf, nama harus berupa huruf dan spasi";
        $this->assertEquals($expectedMessage, $errorMessage, 'Pesan error untuk kondisi $_GET["error"] == "empty_name" tidak sesuai spesifikasi');

        $this->verifyFormAttributes($dom);
    }

    public function testEmptyEmail()
    {
        $_GET['error'] = 'empty_email';

        ob_start();
        include './apps/formEmail.php';

        $output = ob_get_clean();
        $dom = new DOMDocument();
        $dom->loadHTML($output);
        $errorMessage = $dom->getElementsByTagName('span')->item(0)->textContent;
        $expectedMessage = "Maaf, email harus terisi";
        $this->assertEquals($expectedMessage, $errorMessage, 'Pesan error untuk kondisi $_GET["error"] == "empty_email" tidak sesuai spesifikasi');

        $this->verifyFormAttributes($dom);
    }

    public function testInvalidEmail()
    {
        $_GET['error'] = 'invalid_email';

        ob_start();
        include './apps/formEmail.php';

        $output = ob_get_clean();
        $dom = new DOMDocument();
        $dom->loadHTML($output);
        $errorMessage = $dom->getElementsByTagName('span')->item(0)->textContent;
        $expectedMessage = "Maaf, email tidak sesuai";
        $this->assertEquals($expectedMessage, $errorMessage, 'Pesan error untuk kondisi $_GET["error"] == "empty_email" tidak sesuai spesifikasi');

        $this->verifyFormAttributes($dom);
    }

    private function verifyFormAttributes(DOMDocument $dom)
    {
        $form = $dom->getElementsByTagName('form')->item(0);
        $this->assertEquals('prosesFormEmail.php', $form->attributes->getNamedItem('action')->nodeValue, 'Nilai atribut action pada form tidak sesuai dengan spesikfikasi');
        $this->assertEqualsIgnoringCase('GET', $form->attributes->getNamedItem('method')->nodeValue, 'Nilai atribut method pada form tidak sesuai dengan spesifikasi');

        $tdName = $dom->getElementsByTagName('td')->item(0);
        $this->assertEquals('Nama Kamu:', $tdName->textContent, 'Text content pada elemen td pertama dalam form tidak sesuai');

        $inputName = $dom->getElementsByTagName('input')->item(0);
        $this->assertEquals('text', $inputName->attributes->getNamedItem('type')->nodeValue, 'Nilai atribut type pada elemen input pertama dalam form != text');
        $this->assertEquals('yourname', $inputName->attributes->getNamedItem('name')->nodeValue, 'Nilai atribut name pada elemen input pertama dalam form != yourname');
        $this->assertEquals('', $inputName->attributes->getNamedItem('value')->nodeValue);


        $tdName = $dom->getElementsByTagName('td')->item(2);
        $this->assertEquals('Email Kamu:', $tdName->textContent, 'Text content pada elemen td ketiga dalam form tidak sesuai');

        $inputAddress = $dom->getElementsByTagName('input')->item(1);
        $this->assertEquals('email', $inputAddress->attributes->getNamedItem('type')->nodeValue, 'Nilai atribut type pada elemen input kedua dalam form != email');
        $this->assertEquals('youremail', $inputAddress->attributes->getNamedItem('name')->nodeValue, 'Nilai atribut name pada elemen input kedua dalam form != youremail');
        $this->assertEquals('', $inputAddress->attributes->getNamedItem('value')->nodeValue);

        $inputSubmit = $dom->getElementsByTagName('input')->item(2);
        $this->assertEquals('submit', $inputSubmit->attributes->getNamedItem('type')->nodeValue, 'Nilai atribut type pada elemen input ketiga dalam form != submit');
        $this->assertEquals('submit', $inputSubmit->attributes->getNamedItem('name')->nodeValue, 'Nilai atribut name pada elemen input ketiga dalam form != submit');
        $this->assertEquals('Submit', $inputSubmit->attributes->getNamedItem('value')->nodeValue, 'Nilai atribut value pada elemen input ketiga dalam form != Submit');
    }
}
