<?php
namespace Spomky\IpFilterBundle\Voter;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Spomky\IpFilterBundle\Model\IpManagerInterface;

class IpVoter implements VoterInterface
{
    protected $container;
    protected $im;
    protected $policy;

    public function __construct(ContainerInterface $container, IpManagerInterface $im) {

        $this->container = $container;
        $this->im        = $im;
        $this->policy    = $container->getParameter('spomky_ip_filter.policy');
    }

    public function supportsAttribute($attribute) {

        return true;
    }

    public function supportsClass($class) {

        return true;
    }

    public function vote(TokenInterface $token, $object, array $attributes) {
        
        $request = $this->container->get('request');
        $ip = $this->im->findIp( $request->getClientIp() );
        if( $this->policy === 'whitelist' ) {
            return $ip?VoterInterface::ACCESS_GRANTED:VoterInterface::ACCESS_DENIED;
        }
        if( $this->policy === 'blacklist' ) {
            return $ip?VoterInterface::ACCESS_DENIED:VoterInterface::ACCESS_ABSTAIN;
        }
        return VoterInterface::ACCESS_ABSTAIN;
    }
}
