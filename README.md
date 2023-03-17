# headers

A PHP library for working with HTTP and mail headers

[![Build Status](https://img.shields.io/github/actions/workflow/status/ivoba/headers/test.yml?style=flat-square)](https://github.com/ivoba/headers/actions)


## Install

    composer require ivoba/headers
    
Version 2 requires minimum PHP7.1.
    
## Usage 

    $headers = Headers::fromString(
    'HTTP/1.1 200 OK
     Content-Length: 782420
     Content-Type: text/xml; charset=utf-8
     Server: Microsoft-HTTPAPI/2.0
     Date: Tue, 28 Nov 2017 16:08:41 GMT'
    );
    
    $reason = $headers->getStatusLine()->get(StatusLine::REASON_PHRASE); //OK
    $server = $headers->getHeaders()->get('server'); //Microsoft-HTTPAPI/2.0
    
    
## Tests
Install the dependencies via composer and run

    vendor/bin/phpunit

### Credits
This is a shameless port of https://github.com/ddeboer/headers which seems to be unmaintained.
