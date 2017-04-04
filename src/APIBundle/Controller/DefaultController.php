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

        // On récupère la dernière statistique de l'utilisateur
        $lastStatistic = $dm->getRepository('APIBundle:Statistic')->findOneBy(array('wiiz_creator_type' => $wct, 'wiiz_user_id' => $wui, 'wiiz_user_unique_id' => $wuui));
        if ($lastStatistic != null && $lastStatistic->getCreated() != null) {
            $diff = $now->diff($lastStatistic->getCreated());
            // Si le nombre de secondes est inférieure à 1, on renvoie une erreur
            if ($diff->i == 0 && $diff->h == 0 && $diff->d == 0 && $diff->m == 0 && $diff->y == 0 && $diff->s <= 1) {
                return new JsonResponse(array('status' => false, 'errors' => array('Too many statistics in a short period of time !')));
            }
        }


        $qt = (int)$request->get('qt', 0);
        $qt_max = (int)$this->getParameter('queue_time_max');
        if ($qt > $qt_max) {
            return new JsonResponse(array('status' => false, 'errors' => array("The queue time is more than queue time max")));
        }

        $statistic = new Statistic();
        $parameters = $request->query->all();
        foreach($parameters as $key => $value) {
            $statistic->{$key} = $value;
        }
        // On ajoute les cookies pour vérifier les valeurs dans le validateur
        $statistic->setCookies($request->cookies);

        // On valide l'objet avec toutes les contraintes du Document et du validateur
        $validator = $this->get('validator');
        $errors_validate = $validator->validate($statistic);
        $errors = array();
        if (count($errors_validate) > 0) {
            foreach ($errors_validate as $error) {
                $errors[] = $error->getMessage();
            }
        }
        if (count($errors)) {
            return new JsonResponse(array("status" => false, "errors" => $errors));
        }

        // S'il n'y a pas d'erreur on sauvegarde la statistique
        $dm->persist($statistic);
        $dm->flush();
        // On renvoie une réponse en json avec un status à "true"
        return new JsonResponse(array("status" => true));
    }
}
