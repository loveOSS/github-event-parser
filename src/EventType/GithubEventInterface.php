<?php



namespace LoveOSS\Github\EventType;

interface GithubEventInterface
{
    /**
     * @return array list of fields that need to be present to define the event
     */
    public static function fields();

    /**
     * @return string name event
     */
    public static function name();

    /**
     * @param $data array data of the event
     *
     * @return bool validation rule
     */
    public static function isValid($data);

    /**
     * @param $data array data of the event
     *
     * @return GithubEventInterface
     */
    public function createFromData($data);

    /**
     * @return array data of the event
     */
    public function getPayload();
}
