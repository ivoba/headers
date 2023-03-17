<?php

namespace Ivoba\Headers;

class Headers
{
    public const STATUS_LINE = 'status-line';
    public const HEADER_FIELDS = 'header-fields';

    public function __construct(private readonly StatusLine $statusLine, private readonly HeaderCollection $headers)
    {
    }

    public static function getStatusLineFromHeaders(?string $headersString): string
    {
        $line = substr($headersString, 0, strpos($headersString, "\n"));

        return $line ?: '';
    }

    public static function removeStatusLineFromHeaders(?string $headersString): string
    {
        $headers = substr($headersString, strpos($headersString, "\n") + 1);

        return $headers ?: '';
    }

    public static function fromString(?string $headersString): self
    {
        $headersArray = self::parse($headersString);

        return new self($headersArray[self::STATUS_LINE], $headersArray[self::HEADER_FIELDS]);
    }

    public static function parse(?string $headersString): array
    {
        $headers                      = array();
        $statusLine                   = self::getStatusLineFromHeaders($headersString);
        $headers[self::STATUS_LINE]   = StatusLine::fromString($statusLine);
        $headers[self::HEADER_FIELDS] = HeaderCollection::fromString(self::removeStatusLineFromHeaders($headersString));

        return $headers;
    }

    public function toArray(): array
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

    public function getStatusLine(): StatusLine
    {
        return $this->statusLine;
    }

    public function getHeaders(): HeaderCollection
    {
        return $this->headers;
    }

}
