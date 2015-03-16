<?php

namespace Spomky\IpFilterBundle\Model;

use Doctrine\ORM\EntityRepository;

/**
 * @method \Doctrine\Common\Collections\ArrayCollection() findByIp(string $ip, string $environment)
 */
class IpRepository extends EntityRepository implements IpRepositoryInterface
{
    public function findByIp($ip, $environment)
    {
        return $this->createQueryBuilder('r')
            ->where('r.ip = :ip')
            ->andWhere('r.environment LIKE :environment OR r.environment is NULL')
            ->orderBy('r.authorized', 'DESC')
            ->setParameter('ip', bin2hex(inet_pton($ip)))
            ->setParameter('environment', '%'.$environment.'%')
            ->getQuery()
            ->execute();
    }
}
