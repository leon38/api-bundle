<?php

namespace APIBundle\Controller;

use APIBundle\Documents\Statistic;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        $statistic = new Statistic();
        $userMobile = ($request->get('ds') == "apps");

        $cookies = $request->cookies;
        $wct = $request->get('wct', '');
        $wui = $request->get('wui', '');
        $wuui = $request->get('wuui', '');
        $hit_type = $request->get('t');

        if (!$userMobile) {
            if ($wct == '' && $cookies->has('wiizbii_stat_wct')) {
                $wct = $cookies->get('wiizbii_stat_wct');
            }
            if ($wui == '' && $cookies->has('wiizbii_stat_wui')) {
                $wui = $cookies->get('wiizbii_stat_wui');
            }
            if ($wuui == '' && $cookies->has('wiizbii_stat_wuui')) {
                $wuui = $cookies->get('wiizbii_stat_wuui');
            }
        } else {
            if ($request->get('an') == '') {
                $errors_controller[] = "The application name is mandatory for mobile users";
            }
        }

        if ($hit_type == 'event') {
            if ($request->get('ec') == '') {
                $errors_controller[] = "The event category is mandatory for event hits";
            }

            if ($request->get('ea') == '') {
                $errors_controller[] = "The event action is mandatory for event hits";
            }
        } else if ($hit_type == 'screenview') {
            if ($request->get('sn') == '') {
                $errors_controller[] = "The screen name is mandatory for screenview hits";
            }
        }

        $statistic->setVersion($request->get('v'));
        $statistic->setHitType($request->get('t'));
        $statistic->setDocumentLocation($request->get('dl'));
        $statistic->setDocumentReferrer($request->get('dr'));
        $statistic->setWiizCreatorType($wct);
        $statistic->setWiizUserId($wui);
        $statistic->setWiizUniqueUserId($wuui);
        $statistic->setEventCategory($request->get('ec'));
        $statistic->setEventAction($request->get('ea'));
        $statistic->setEventLabel($request->get('el'));
        $statistic->setEventValue($request->get('ev'));
        $statistic->setTrackingId($request->get('tid'));
        $statistic->setDataSource($request->get('ds'));
        $statistic->setCampaignName($request->get('cn'));
        $statistic->setCampaignSource($request->get('cs'));
        $statistic->setCampaignMedium($request->get('cm'));
        $statistic->setCampaignKeyword($request->get('ck'));
        $statistic->setScreenName($request->get('sn'));
        $statistic->setApplicationName($request->get('an'));
        $statistic->setApplicationVersion($request->get('av'));
        $statistic->setQueueTime($request->get('qt'));

        $validator = $this->get('validator');
        $errors = $validator->validate($statistic);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            return new JsonResponse(array("errors" => $errors));
        }




    }
}
