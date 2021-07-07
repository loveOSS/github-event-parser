<?php



namespace LoveOSS\Github\Entity;

class Label
{
    private $url;
    private $name;
    private $color;

    public static function createFromData(array $data)
    {
        return new static($data);
    }

    public function __construct($data)
    {
        $this->url = $data['url'];
        $this->name = $data['name'];
        $this->color = $data['color'];
    }

    /**
     * Gets the value of url.
     *
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Gets the value of name.
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the value of color.
     *
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }
}
