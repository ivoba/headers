<?php

namespace Ivoba\Headers;

/**
 * Class HeaderCollection
 */
class HeaderCollection extends Collection
{
    public function get(string $key)
    {
        return parent::get(self::normalizeKey($key));
    }

    public static function fromString(?string $headers): self
    {
        return new static(self::parseHeaders($headers));
    }

    /**
     * Parse headers into key/value pairs
     *
     * @param string|null $headers Unparsed headers as string
     * @return array Parsed headers
     */
    protected static function parseHeaders(?string $headers): array
    {
        $lines   = preg_split('/\\r?\\n/', $headers);
        $headers = [];
        foreach ($lines as $line) {
            if (preg_match('/^\S/', $line)) {
                // Start of new header field: this line must contain a colon
                // (:) to separate header field and value. Note that the colon
                // does not need to be followed by a space.
                $parts = \explode(':', $line, 2);
                $key   = self::normalizeKey(trim($parts[0]));
                $value = trim($parts[1]);

                if (!isset($headers[$key])) {
                    $headers[$key] = $value;
                } elseif (!is_array($headers[$key])) {
                    $headers[$key] = array($headers[$key], $value);
                } else {
                    $headers[$key][] = $value;
                }
            } else {
                // If the line starts with at least one space or tab, it is a
                // continued (folded) header field, which needs to be unfolded.
                // @link http://tools.ietf.org/html/rfc5322#section-2.2.3
                if (isset($key)) {
                    $value = trim($line);
                    if (is_array($headers[$key])) {
                        $headers[$key][] = array_pop($headers[$key]).$value;
                    } else {
                        $headers[$key] .= $value;
                    }
                }
            }
        }

        return $headers;
    }

    /**
     * HTTP header names are case-insensitive, according to RFC 2616
     *
     * @param string $key
     * @return string
     */
    protected static function normalizeKey(string $key): string
    {
        return strtolower($key);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $headers = '';
        foreach ($this as $key => $value) {
            $headers .= $key.': '.$value."\r\n";
        }

        return $headers;
    }

}
