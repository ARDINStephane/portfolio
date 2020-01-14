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
     * @Route("/set/locale/{lastRoute}/{routeParams}/{locale}", name="set_locale")
     * @param string $lastRoute
     * @param string|null $routeParams
     * @param string $locale
     * @param Request $request
     * @return RedirectResponse
     */
    public function setLocale(
        string $lastRoute,
        ?string $routeParams,
        string $locale,
        Request $request
    ): RedirectResponse
    {
        $request->getSession()->set('_locale', $locale);
      
        return $this->redirectToRoute($lastRoute, json_decode($routeParams, true));
    }
}