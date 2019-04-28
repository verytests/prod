<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LogRepository")
 * @ORM\Table(name="logs")
 */
class Log
{
    const LEVEL_INFO = 'info';
    const LEVEL_WARNING = 'warning';
    const LEVEL_ERROR = 'error';

    const SOURCE_SIGNUP = 'signUp';
    const SOURCE_GLOBAL = 'global';
    const SOURCE_ADD_TEST = 'add_test';
    const SOURCE_REMOVE_TEST = 'remove_test';
    const SOURCE_UPDATE_TEST_STATUS = 'update_status';

    const SECTION_ADMIN = 'admin';
    const SECTION_USER = 'user';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json")
     */
    private $data;

    /**
     * @ORM\Column(type="string")
     */
    private $source;

    /**
     * @ORM\Column(type="string")
     */
    private $level;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string")
     */
    private $section;

    public function getId()
    {
        return $this->id;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function getSection()
    {
        return $this->section;
    }

    public function setSection($section)
    {
        $this->section = $section;

        return $this;
    }

    public function getLevels()
    {
        return [
            self::LEVEL_ERROR,
            self::LEVEL_INFO,
            self::LEVEL_WARNING
        ];
    }

    public function getSources()
    {
        return [
          self::SOURCE_ADD_TEST,
          self::SOURCE_GLOBAL,
          self::SOURCE_SIGNUP
        ];
    }

    public function getSections()
    {
        return [
            self::SECTION_ADMIN,
            self::SECTION_USER
        ];
    }
}
