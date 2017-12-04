<?php

namespace Ivoba\Headers\Mail;

use Ivoba\Headers\HeaderCollection;

/**
 * The header part of an e-mail message
 *
 * Class MailHeaders
 * @link http://tools.ietf.org/html/rfc5322#section-2.2
 */
class MailHeaders extends HeaderCollection
{
    public function getMessageId(): ?string
    {
        return $this->get('message-id');
    }

    public function getTo(): ?string
    {
        return $this->get('to');
    }

    public function getFrom(): ?string
    {
        return $this->get('from');
    }

    public function getSubject(): ?string
    {
        return $this->get('subject');
    }

    public function getDate(): \DateTime
    {
        return new \DateTime($this->get('date'));
    }

    public function getContentType(): ?string
    {
        return $this->get('content-type');
    }
}