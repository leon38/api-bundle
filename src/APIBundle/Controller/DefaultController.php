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
        $wct = $request->get('wct', '');
        $wui = $request->get('wui', '');
        $wuui = $request->get('wuui', '');
        $lastStatistic = $dm->getRepository('APIBundle:Statistic')->getLastStatistic($wct, $wui, $wuui);
        $save = true;
        if ($lastStatistic->getCreated() != null) {
            $diff = $now->diff($lastStatistic->getCreated());
            if ($diff->i == 0 && $diff->h == 0 && $diff->d == 0 && $diff->m == 0 && $diff->y == 0 && $diff->s <= 1) {
                $save = false;
                return new JsonResponse(array('status' => false, 'error' => 'Too many statistics in a short period of time !'));
            }
        }

        $user = $dm->getRepository('APIBundle:User')->findOneBy(array('wui' => $wui));
        if (is_null($user)) {
            return new JsonResponse(array('status' => false, 'error' => 'This user does not exist'));
        }


        $qt = (int)$request->get('qt', 0);
        $qt_max = (int)$this->getParameter('queue_time_max');
        if ($qt > $qt_max) {
            return new JsonResponse(array('status' => false, 'error' => "The queue time is more than queue time max"));
        }

        $statistic = new Statistic();
        $parameters = $request->query->all();
        dump($parameters); die;

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
        $statistic->setCookies($request->cookies);

        $validator = $this->get('validator');
        $errors_validate = $validator->validate($statistic);
        if (count($errors_validate) > 0) {
            foreach ($errors_validate as $error) {
                $errors[] = $error->getMessage();
            }
        }
        if (count($errors)) {
            return new JsonResponse(array("status" => false, "errors" => $errors));
        }

        if ($save) {
            $dm->persist($statistic);
            $dm->flush();
        }
        return new JsonResponse(array("status" => true));
    }
}
