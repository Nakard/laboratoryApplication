<?php
/**
 * RedisController.php
 *
 * Creation date: 2014-07-11
 * Creation time: 01:06
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RedisController
 *
 * @package Nakard\Laboratory\TestBundle\Controller
 */
class RedisController extends Controller
{
    /**
     * Fetches test results from Redis, this method is being called regularly while performing tests
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function fetchAction(Request $request)
    {
        $testsIds = $request->get('testsIds');
        $redis = $this->get('nakard_laboratory_test.redis');
        $response = [];
        foreach ($testsIds as $id) {
            $key = 'test:' . $id;
            $testValue = $redis->hget($key, 'value');
            $response[str_replace(':', '-', $key)] = $testValue;
        }
        return new JsonResponse($response);
    }
}
