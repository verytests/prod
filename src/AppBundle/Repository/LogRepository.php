<?php


namespace AppBundle\Repository;

use AppBundle\Entity\Log;
use Doctrine\ORM\EntityRepository;

class LogRepository extends EntityRepository
{
    public function findByOptions(array $options)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select('l')
            ->from(Log::class, 'l');

        if(!empty($options)) {
            if(!empty($options['level'])) {
                $qb
                    ->andWhere('l.level = :level')
                    ->setParameter('level', $options['level']);
            }

            if(!empty($options['source'])) {
                $qb
                    ->andWhere('l.source = :source')
                    ->setParameter('source', $options['source']);
            }

            if(!empty($options['section'])) {
                $qb
                    ->andWhere('l.section = :section')
                    ->setParameter('section', $options['section']);
            }

            if(!empty($options['date']['start']) && !empty($options['date']['end'])) {
                $qb
                    ->andWhere('l.date BETWEEN :start AND :end')
                    ->setParameters([
                        'start' => new \DateTime($options['date']['start']),
                        'end' => new \DateTime($options['date']['end'])
                    ]);
            }
        }

        return $qb
            ->orderBy('l.date', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
