<?php
namespace GiftCards\PackagistBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Packagist\WebBundle\Controller\ApiController as PackagistApiController;

class ApiController extends PackagistApiController
{

    /**
     * @Route("/api/stash", name="stash_postreceive", defaults={"_format" = "json"})
     * @Method({"POST"})
     */
    public function stashPostReceive(Request $request)
    {
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $payload = json_decode($request->getContent(), true);
        }

        if (!$payload || !isset($payload['repository']['slug']) || !isset($payload['repository']['project']['key'])) {
            return new Response(
                json_encode(
                    array('status' => 'error', 'message' => 'Missing or invalid payload')
                ),
                406
            );
        }

        $urlFormat = '%s://git@%s%s/%s/%s.git';

        $repoUrl = sprintf(
            $urlFormat,
            $this->container->getParameter('gift_cards_packagist.stash.protocol'),
            $this->container->getParameter('gift_cards_packagist.stash.domain'),
            (is_null($this->container->getParameter('gift_cards_packagist.stash.port')) ? '' : ':' . $this->container->getParameter('gift_cards_packagist.stash.port')),
            strtolower($payload['repository']['project']['key']),
            strtolower($payload['repository']['slug'])
        );

        $urlRegex = '{^(?:https?://|ssh://git@|git@)?(?P<host>' . preg_quote($this->container->getParameter('gift_cards_packagist.stash.domain')) . ')[/:\d]+(?P<path>[\w.-]+/[\w.-]+?)(\.git)?/?$}';

        return $this->receivePost($request, $repoUrl, $urlRegex);
    }
}
