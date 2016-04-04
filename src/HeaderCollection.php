<?php

namespace Ivoba\Headers;

/**
 * Class HeaderCollection
 */
class HeaderCollection extends Collection
{
    /**
     * @param $key
     * @return null
     */
    public function get($key)
    {
        return parent::get(self::normalizeKey($key));
    }

    /**
     * Create a header collection from a headers string
     *
     * @param string $headers Headers string
     */
    public static function fromString($headers)
    {
        return new static(self::parseHeaders($headers));
    }

    /**
     * Parse headers into key/value pairs
     *
     * @param string $headers Unparsed headers as string
     *
     * @return array Parsed headers
     */
    protected static function parseHeaders($headers)
    {
        $lines   = preg_split('/\\r?\\n/', $headers);
        $headers = array();
        foreach ($lines as $line) {
            if (preg_match('/^[\S|\T]/', $line)) {
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
                        $headers[$key][] = array_pop($headers[$key]) . $value;
                    } else {
                        $headers[$key] .= $value;
                    }
                }
            }
        }

        return $headers;
    }

    /**
     * @param $key
     * @return string
     */
    protected static function normalizeKey($key)
    {
        return strtolower($key);
    }
}