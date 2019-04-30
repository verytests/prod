<?php

namespace AppBundle\Services;

use AppBundle\Entity\Others\Keyword;
use AppBundle\Entity\Others\ParsedLink;
use AppBundle\Utils\PregUtil;
use Doctrine\ORM\EntityManager;

class DbService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function cleanParsedLinksFromDuplicates()
    {
        $conn = $this->em->getConnection();


        $sql = "
            SELECT link
            FROM parsed_links
            GROUP
            BY link
            HAVING COUNT(*) > 1
        ";

        $query = $conn->prepare($sql);
        $query->execute();

        $res = $query->fetchAll();

        foreach ($res as $item) {
            $links = $this->em->getRepository(ParsedLink::class)->findBy(['link' => $item['link']]);

            for($i = 1; $i < count($links); $i++) {
                $this->em->remove($links[$i]);
                $this->em->flush();
            }
        }
    }

    public function cleanKeywords()
    {
        $conn = $this->em->getConnection();

        $sql = "SELECT COUNT(id) as amount FROM category_keywords";

        $query = $conn->prepare($sql);
        $query->execute();
        $amount = $query->fetch();

        for($i = 0; $i < $amount['amount']; $i++) {
            $sql = "SELECT keyword FROM category_keywords LIMIT ".$i.",1";

            $query = $conn->prepare($sql);
            $query->execute();

            $resQuery = $query->fetch();

            $keywords = $this->em->getRepository(Keyword::class)->findBy(['keyword' => $resQuery['keyword']]);

            foreach ($keywords as $keyword) {
                $cleaned = PregUtil::pregKeyword($keyword->getKeyword());

                $keyword->setKeyword($cleaned);

                $this->em->persist($keyword);
                $this->em->flush();
            }
        }
    }
}