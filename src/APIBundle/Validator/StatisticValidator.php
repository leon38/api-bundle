<?php

/**
 * User: DCA
 * Date: 03/04/2017
 * Time: 16:57
 * test-mongo
 */
namespace APIBundle\Validator;

use APIBundle\Document\Statistic;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class StatisticValidator
{

    public static function validate(Statistic $stat, ExecutionContextInterface $context, $payload)
    {
        $cookies = $stat->getCookies();

        $hit_type = $stat->getT();
        $userMobile = ($stat->getDs() == "apps");
        // Si c'est un utilisateur mobile, le nom de l'application est obligatoire
        if ($userMobile) {
            if ($stat->getAn() == '') {
                $context->buildViolation("The application name is mandatory for mobile users")
                    ->atPath('Application name')
                    ->addViolation();
            }
        } else  {
            // Si c'est un utilisateur web, on va chercher les valeurs dans le cookie.
            if ($stat->getWct() == '') {
                $stat->setWct($cookies->get('wct'));
            }
            if ($stat->getWui() == '') {
                $stat->setWui($cookies->get('wuid'));
            }
            if ($stat->getWuui() == '') {
                $stat->setWuui($cookies->get('uniqUserId'));
            }
        }

        // Liste d'utilisateur exemple, on vérifie que l'utilisateur existe
        $user = (in_array($stat->getWui(), array('emeric-wasson', 'remi-alvado', 'damien-corona')));
        if (!$user) {
            $context->buildViolation("This user does not exist")
                ->atPath('User')
                ->addViolation();
        }

        // Si c'est une statistique de type évènement, on vérifie tous les paramètres obligatoires
        if ($hit_type == 'event') {
            if ($stat->getEc() == '') {
                $context->buildViolation("The event category is mandatory for event hits")
                    ->atPath('Event category')
                    ->addViolation();
            }

            if ($stat->getEa() == '') {
                $context->buildViolation("The event action is mandatory for event hits")
                    ->atPath('Event action')
                    ->addViolation();
            }
        } else if ($hit_type == 'screenview') {
            if ($stat->getSn() == '') {
                $context->buildViolation("The screen name is mandatory for screenview hits")
                    ->atPath('Screen name')
                    ->addViolation();
            }
        }
    }

}