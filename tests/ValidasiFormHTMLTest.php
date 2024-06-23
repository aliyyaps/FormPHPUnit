<?php

use PHPUnit\Framework\TestCase;

class ValidasiFormHTMLTest extends TestCase
{
    public function testFormAttributes()
    {
        $html = file_get_contents('./apps/validasiForm.html');
        $dom = new DOMDocument();
        $dom->loadHTML($html);

        $titleElemen = $dom->getElementsByTagName('title')->item(0);

        $this->assertEquals('Validasi Form', $titleElemen->nodeValue);

        $form = $dom->getElementsByTagName('form')->item(0);

        $this->assertEquals('validasiForm.php', $form->attributes->getNamedItem('action')->nodeValue, 'Nilai atribut action pada form tidak sesuai dengan spesikfikasi');
        $this->assertEqualsIgnoringCase('GET', $form->attributes->getNamedItem('method')->nodeValue, 'Nilai atribut method pada form seharusnya "GET"');

        // label assertion
        $labels = $dom->getElementsByTagName('label');
        $labelName = $labels->item(0);
        $labelAddress = $labels->item(1);

        $this->assertEquals('inputName', $labelName->getAttributeNode('for')->nodeValue, 'Nilai atribut for pada tag label pertama seharusnya "inputName"');
        $this->assertEquals('inputAddress', $labelAddress->getAttributeNode('for')->nodeValue,  'Nilai atribut name pada tag label kedua seharusnya "inputAddress"');

        $this->assertEquals('Nama Kamu: ', $labelName->nodeValue, 'Text content elemen label dengan atribut for == "inputName" seharusnya "Nama Kamu: "');
        $this->assertEquals('Alamat Kamu: ', $labelAddress->nodeValue, 'Text content elemen label dengan atribut for == "inputAddress" seharusnya "Alamat Kamu: "');

        // input assertion
        $inputs = $dom->getElementsByTagName('input');
        $inputName = $inputs->item(0);
        $inputAddress = $inputs->item(1);

        $this->assertNotNull($inputName, 'Tag input pertama tidak ditemukan');
        $this->assertNotNull($inputAddress, 'Tag input kedua tidak ditemukan');

        $this->assertEquals('yourName', $inputName->getAttributeNode('name')->nodeValue, 'Nilai atribut name pada tag input pertama seharusnya "yourName"');
        $this->assertEquals('yourAddress', $inputAddress->getAttributeNode('name')->nodeValue,  'Nilai atribut name pada tag input kedua seharusnya "yourAddress"');

        $this->assertEquals('text', $inputName->getAttributeNode('type')->nodeValue, 'Nilai atribut type pada elemen input dengan name == "yourName" seharusnya "text"');
        $this->assertEquals('inputName', $inputName->getAttributeNode('id')->nodeValue, 'Nilai atribut id pada elemen input dengan name == "yourName" seharusnya "inputName"');
        $this->assertEquals('Masukkan Nama Kamu', $inputName->getAttributeNode('placeholder')->nodeValue, 'Nilai atribut placeholder pada elemen input dengan name == "yourName" seharusnya "Masukkan Nama Kamu"');

        $this->assertEquals('text', $inputAddress->getAttributeNode('type')->nodeValue, 'Nilai atribut type pada elemen input dengan name == "yourAddress" seharusnya "text"');
        $this->assertEquals('inputAddress', $inputAddress->getAttributeNode('id')->nodeValue, 'Nilai atribut id pada elemen input dengan name == "yourAddress" seharusnya "inputAddress"');
        $this->assertEquals('Masukkan Alamat Kamu', $inputAddress->getAttributeNode('placeholder')->nodeValue, 'Nilai atribut placeholder pada elemen input dengan name == "yourAddress" seharusnya "Masukkan Alamat Kamu"');

        $inputSubmit = $inputs->item(2);
        $this->assertNotNull($inputName, 'Tag input ketiga tidak ditemukan');
        $this->assertEquals('submit', $inputSubmit->getAttributeNode('type')->nodeValue, 'Nilai atribut type pada elemen input ketiga dalam form != submit');
    }
}
