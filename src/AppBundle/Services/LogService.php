<?php

namespace AppBundle\Services;

use AppBundle\Entity\Log;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class LogService
 * @package App\Services
 */
class LogService
{
    protected $connection;

    protected $log;

    /**
     * LogService constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->connection = $em;

        $log = new Log();
        $this->log = $log;
    }

    /**
     * Info log
     *
     * @param $data
     * @param $source
     * @param string $section
     * @throws \Exception
     */
    public function info($data, $source, $section = Log::SECTION_USER)
    {
        $this->create($data, $source, Log::LEVEL_INFO, $section);
    }

    /**
     * Warning log
     *
     * @param $data
     * @param $source
     * @param string $section
     * @throws \Exception
     */
    public function warning($data, $source, $section = Log::SECTION_USER)
    {
        $this->create($data, $source, Log::LEVEL_WARNING, $section);
    }

    /**
     * Error log
     *
     * @param $data
     * @param $source
     * @param string $section
     * @throws \Exception
     */
    public function error($data, $source, $section = Log::SECTION_USER)
    {
        $this->create($data, $source, Log::LEVEL_ERROR, $section);
    }

    /**
     * Saves the log
     *
     * @param $log
     */
    private function save($log)
    {
        $this->connection->persist($log);
        $this->connection->flush();
    }

    /**
     * Creates a log entity
     *
     * @param $data
     * @param $source
     * @param $level
     * @param string $section
     * @throws \Exception
     */
    private function create($data, $source, $level, $section)
    {
        $this->log
            ->setData(json_encode($data))
            ->setSource($source)
            ->setDate(new \DateTime())
            ->setLevel($level)
            ->setSection($section);

        $this->save($this->log);
    }

    public function getLogsByOptions(array $options = [])
    {
        return $this->connection->getRepository(Log::class)->findByOptions($options);
    }
}
