<?php

namespace APIBundle\Controller;

use APIBundle\Document\Statistic;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        $now = new \DateTime();
        $dm = $this->get('doctrine_mongodb')->getManager();
        $lastStatistic = $dm->getRepository('APIBundle:Statistic')->getLastStatistic();
        $save = true;
        if ($lastStatistic->getCreated() != null) {
            $diff = $now->diff($lastStatistic->getCreated());
            if ($diff->i == 0 && $diff->h == 0 && $diff->d == 0 && $diff->m == 0 && $diff->y == 0 && $diff->s <= 1) {
                $save = false;
            }
        }
        $statistic = new Statistic();
        $userMobile = ($request->get('ds') == "apps");

        $cookies = $request->cookies;
        $wct = $request->get('wct', '');
        $wui = $request->get('wui', '');
        $user = $dm->getRepository('APIBundle:User')->findOneBy(array('wui' => $wui));
        if (is_null($user)) {
            $errors[] = "This user doesn't exist";
        }
        $wuui = $request->get('wuui', '');
        $hit_type = $request->get('t');
        $qt = (int)$request->get('qt', 0);

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

        $qt_max = (int)$this->getParameter('queue_time_max');
        if ($qt > $qt_max) {
            $errors[] = "The queue time is more than queue time max";
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
        $statistic->setQueueTime($qt);
        $statistic->setCreated($now);

        $validator = $this->get('validator');
        $errors_validate = $validator->validate($statistic);
        if (count($errors_validate) > 0) {
            foreach ($errors_validate as $error) {
                $errors[] = $error->getMessage();
            }
        }
        if (count($errors)) {
            return new JsonResponse(array("errors" => $errors));
        }

        if ($save) {
            $dm->persist($statistic);
            $dm->flush();
        }
        return new JsonResponse(array("status" => "OK"));
    }
}
