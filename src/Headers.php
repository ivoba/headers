<?php

namespace Ivoba\Headers;

class Headers
{
    const STATUS_LINE = 'status-line';
    const HEADER_FIELDS = 'header-fields';

    private $statusLine;
    private $headers;

    /**
     * Headers constructor.
     * @param $statusLine
     * @param $headers
     */
    public function __construct(StatusLine $statusLine, HeaderCollection $headers)
    {
        $this->statusLine = $statusLine;
        $this->headers    = $headers;
    }

    /**
     * @param $headersString
     * @return bool|string
     */
    public static function getStatusLineFromHeaders($headersString)
    {
        return substr($headersString, 0, strpos($headersString, "\n"));
    }

    /**
     * @param $headersString
     * @return bool|string
     */
    public static function removeStatusLineFromHeaders($headersString)
    {
        return substr($headersString, strpos($headersString, "\n") + 1);
    }

    /**
     * @param $headersString
     * @return Headers
     */
    public static function fromString($headersString)
    {
        $headersArray = self::parse($headersString);

        return new self($headersArray[self::STATUS_LINE], $headersArray[self::HEADER_FIELDS]);
    }

    /**
     * @param $headersString
     * @return array
     */
    public static function parse($headersString)
    {
        $headers                      = array();
        $statusLine                   = self::getStatusLineFromHeaders($headersString);
        $headers[self::STATUS_LINE]   = StatusLine::fromString($statusLine);
        $headers[self::HEADER_FIELDS] = HeaderCollection::fromString(self::removeStatusLineFromHeaders($headersString));

        return $headers;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            self::STATUS_LINE   => $this->getStatusLine()->toArray(),
            self::HEADER_FIELDS => $this->getHeaders()->toArray(),
        );
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->statusLine->__toString()."\r\n".$this->headers->__toString();
    }

    /**
     * @return StatusLine
     */
    public function getStatusLine()
    {
        return $this->statusLine;
    }

    /**
     * @return HeaderCollection
     */
    public function getHeaders()
    {
        return $this->headers;
    }

}