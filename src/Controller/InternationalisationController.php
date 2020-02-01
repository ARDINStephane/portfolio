<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class InternationalisationController
 * @package App\Application\Common\Controller
 */
class InternationalisationController extends AbstractController
{
    /**
     * @Route("/set/locale/{locale}", name="set_locale")
     * @param string $locale
     * @param Request $request
     * @return RedirectResponse
     */
    public function setLocale(
        string $locale,
        Request $request
    ): RedirectResponse
    {
        $lastUrl = $request->server->get('HTTP_REFERER');
        $request->getSession()->set('_locale', $locale);

        return $this->redirect($lastUrl);
    }
}