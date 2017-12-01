# headers

A PHP library for working with HTTP and mail headers

[![Build Status](http://img.shields.io/travis/ivoba/headers.svg)](https://travis-ci.org/ivoba/headers)


## Install

    composer require ivoba/headers
    
## Usage 

    $headers = Headers::fromString(
    'HTTP/1.1 200 OK
     Content-Length: 782420
     Content-Type: text/xml; charset=utf-8
     Server: Microsoft-HTTPAPI/2.0
     Date: Tue, 28 Nov 2017 16:08:41 GMT'
    );
    
    
## Tests
Install the dependencies via composer and run

    vendor/bin/phpunit

### Credits
This is a shameless port of https://github.com/ddeboer/headers which seems to be unmaintained.