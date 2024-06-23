<?php

use PHPUnit\Framework\TestCase;

class ProsesFormRequiredTest extends TestCase
{
    public function testSuccessfulSubmission()
    {
        $_GET['yourname'] = 'AliyyaPS';
        $_GET['youraddress'] = 'Sidoarjo';

        ob_start();

        include_once './apps/prosesFormRequired.php';

        $output = ob_get_clean();

        $dom = new DOMDocument();
        $dom->loadHTML($output);

        $this->assertStringContainsString('Nama Kamu: AliyyaPS', $dom->textContent);
        $this->assertStringContainsString('Alamat Kamu : Sidoarjo', $dom->textContent);
    }
}
