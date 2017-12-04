<?php

namespace Ivoba\Header\Test\Mail;

use Ivoba\Headers\HeaderCollection;
use Ivoba\Headers\Mail\MailHeaders;
use PHPUnit\Framework\TestCase;

class MailHeadersTest extends TestCase
{
    public function testHeadersFromGmailMessage()
    {
        $string  = file_get_contents(__DIR__ . '/../Fixtures/Mail/gmail.txt');
        $headers = MailHeaders::fromString($string);
        $this->assertEquals('jamesbond@gmail.com', $headers->get('delivered-to'));
        $this->assertEquals('Q <q@gmail.com>', $headers->get('from'));
        $this->assertInternalType('array', $headers->get('received'));

        $this->assertInstanceOf('\DateTime', $headers->getDate());

        $array = $headers->toArray();
        $this->assertInternalType('array', $array);
        $this->assertArrayHasKey('from', $array);
    }

    /**
     * assure it doesnt break when an empty header string is passed
     */
    public function testNullHeaders()
    {
        $headersString = null;
        $headers       = HeaderCollection::fromString($headersString);
        $this->assertNull($headers->get('from'));
    }

}