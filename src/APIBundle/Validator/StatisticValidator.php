<?php

/**
 * User: DCA
 * Date: 03/04/2017
 * Time: 16:57
 * test-mongo
 */
namespace APIBundle\Validator;

use APIBundle\Document\Statistic;

class StatisticValidator
{



    public static function validate(Statistic $stat, ExecutionContextInterface $context, $payload)
    {
        $cookies = $stat->getCookies();
        $user = self::$userRepository->findOneBy(array('wui' => $stat->getWiizUserId()));
        if (is_null($user)) {
            $errors[] = "This user doesn't exist";
        }

        $hit_type = $stat->getHitType();
        $userMobile = ($stat->getDataSource() == "apps");
        if ($userMobile) {
            if ($stat->getApplicationName() == '') {
                $context->buildViolation("The application name is mandatory for mobile users")
                    ->atPath('Application name')
                    ->addViolation();
            }
        } else {
            if (!$userMobile) {
                if ($stat->getWiizCreatorType() == '') {
                    // On ira le chercher dans les cookies
                    $wct = 'profile';
                }
                if ($stat->getWiizUserId() == '') {
                    // On ira le chercher dans les cookies
                    $wui = 'emeric-wasson';
                }
                if ($wuui == '') {
                    $wuui = $cookies->get('wiizbii_stat_wuui');
                }
            }
        }

        if ($hit_type == 'event') {
            if ($stat->getEventCategory() == '') {
                $context->buildViolation("The event category is mandatory for event hits")
                    ->atPath('Event category')
                    ->addViolation();
            }

            if ($stat->getEventAction() == '') {
                $context->buildViolation("The event action is mandatory for event hits")
                    ->atPath('Event category')
                    ->addViolation();
            }
        } else if ($hit_type == 'screenview') {
            if ($stat->getScreenName() == '') {
                $context->buildViolation("The screen name is mandatory for screenview hits")
                    ->atPath('Event category')
                    ->addViolation();
            }
        }
    }

}