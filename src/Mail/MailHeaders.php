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
    /**
     * @return null
     */
    public function getMessageId()
    {
        return $this->get('message-id');
    }

    /**
     * @return null
     */
    public function getTo()
    {
        return $this->get('to');
    }

    /**
     * @return null
     */
    public function getFrom()
    {
        return $this->get('from');
    }

    /**
     * @return null
     */
    public function getSubject()
    {
        return $this->get('subject');
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return new \DateTime($this->get('date'));
    }

    /**
     * @return null
     */
    public function getContentType()
    {
        return $this->get('content-type');
    }
}