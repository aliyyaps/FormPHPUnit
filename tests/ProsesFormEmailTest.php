<?php

use PHPUnit\Framework\TestCase;

class ProsesFormEmailTest extends TestCase
{
    public function testSuccessfulSubmission()
    {
        $_GET['yourname'] = 'Aliyya Putri S';
        $_GET['youremail'] = 'example@gmail.com';

        ob_start();

        include './apps/prosesFormEmail.php';

        $output = ob_get_clean();

        $dom = new DOMDocument();
        $dom->loadHTML($output);

        $this->assertStringContainsString('Nama Kamu: Aliyya Putri S', $dom->textContent);
        $this->assertStringContainsString('Email Kamu: example@gmail.com', $dom->textContent);
    }
}
