<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'security.firewall.map.config.test' shared service.

return $this->privates['security.firewall.map.config.test'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallConfig('test', 'security.user_checker', '.security.request_matcher.3UEFixr', true, false, 'security.user.provider.concrete.in_memory', 'test', NULL, NULL, NULL, [0 => 'anonymous'], NULL);
