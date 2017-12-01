<?php

namespace Ivoba\Headers;

/**
 * Class StatusLine
 * @package Ivoba\Headers
 */
class StatusLine extends Collection
{

    const HTTP_VERSION = 'http-version';
    const STATUS_CODE = 'status-code';
    const REASON_PHRASE = 'reason-phrase';
    const METHOD = 'method';
    const REQUEST_URI = 'request-uri';

    /**
     * @param string $line
     * @return StatusLine
     */
    public static function fromString($line)
    {
        return new static(self::parseStatusLine($line));
    }

    /**
     * Status-Line = HTTP-Version SP Status-Code SP Reason-Phrase CRLF
     * in HTTP/2 Reason-Phrase was removed
     *
     * @param string $line
     * @return array
     */
    public static function parseStatusLine($line)
    {
        $statusLine = array();
        $lineArray  = explode(' ', trim($line), 3);

        if (count($lineArray) > 1) {
            if (is_numeric($lineArray[1])) {
                //response
                if (isset($lineArray[0])) {
                    $statusLine[self::HTTP_VERSION] = $lineArray[0];
                }
                if (isset($lineArray[1])) {
                    $statusLine[self::STATUS_CODE] = $lineArray[1];
                }
                if (isset($lineArray[2])) {
                    $statusLine[self::REASON_PHRASE] = $lineArray[2];
                }
            } else {
                //request
                if (isset($lineArray[0])) {
                    $statusLine[self::METHOD] = $lineArray[0];
                }
                if (isset($lineArray[1])) {
                    $statusLine[self::REQUEST_URI] = $lineArray[1];
                }
                if (isset($lineArray[2])) {
                    $statusLine[self::HTTP_VERSION] = $lineArray[2];
                }
            }
        }

        return $statusLine;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return implode(' ', $this->toArray());
    }

}