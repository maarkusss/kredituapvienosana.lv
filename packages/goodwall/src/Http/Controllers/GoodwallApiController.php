<?php

namespace Goodday\Goodwall\Http\Controllers;

use Goodday\Goodwall\Http\Requests\DeleteWhitelist;
use Goodday\Goodwall\Http\Requests\PostWhitelist;
use Goodday\Goodwall\Services\GoodwallService;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodwallApiController extends Controller
{
    /**
     * @var GoodwallService
     */
    protected $service;

    public function __construct(GoodwallService $service)
    {
        $this->service = $service;
    }

    public function status(Request $request): array
    {
        $response = [
            'your ip' => $request->ip(),
            'enabled' => config('goodwall.enabled'),
        ];

        if ($request->input('with')) {
            $include = explode(',', $request->input('with'));

            if (in_array('whitelist', $include)) {
                $response['whitelist'] = $this->service->validIps();
            }
        }

        return $response;
    }

    public function getWhitelist(): JsonResponse
    {
        return response()
            ->json($this->service->validIps());
    }

    public function postWhitelist(PostWhitelist $request): JsonResponse
    {
        foreach ($request->whitelist as $ip_address) {
            $this->service->addToWhitelist($ip_address);
        }

        return response()->json([
            'message' => 'success',
        ], Response::HTTP_CREATED);
    }

    public function deleteWhitelist(DeleteWhitelist $request): JsonResponse
    {
        foreach ($request->whitelist as $ip_address) {
            $this->service->deleteFromWhitelist($ip_address);
        }

        return response()->json([
            'message' => 'success',
        ], config('goodwall.deleted_response_code'));
    }
}
