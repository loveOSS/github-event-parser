<?php

namespace LoveOSS\Github\Entity;

class CommitUser
{
    /**
     * @var \DateTime|\DateTimeImmutable
     */
    private \DateTimeInterface $date;
    private $name;
    private $email;

    public static function createFromData($data)
    {
        return new static($data);
    }

    final public function __construct($data)
    {
        $this->date = new \DateTime($data['date']);
        $this->name = $data['name'];
        $this->email = $data['email'];
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    /* Get an human readable description of CommitUser object.
     *
     * @return string the commit author/committer
     */
    public function __toString()
    {
        return $this->name . ' (' . $this->email . ')';
    }
}
