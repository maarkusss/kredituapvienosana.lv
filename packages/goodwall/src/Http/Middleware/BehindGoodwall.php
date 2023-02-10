<?php

namespace Goodday\Goodwall\Http\Middleware;

use Goodday\Goodwall\Models\GoodwallHeader;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Goodday\Goodwall\Services\GoodwallService;
use Closure;

/**
 * Middleware to be added to routes which need to be IP-protected
 */
class BehindGoodwall
{
    /**
     * @var GoodwallService
     */
    protected $service;

    public function __construct(GoodwallService $service)
    {
        $this->service = $service;
    }

    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed|null
     */
    public function handle($request, Closure $next)
    {
        if (!$this->service->isEnabled()) {
            return $next($request);
        }

        $valid_ips = $this->service->validIps();
        if (empty($valid_ips)) {
            return $next($request);
        }

        if (!$this->service->isIpWhitelisted($request->ip(), $valid_ips)) {
            $response_code = config('goodwall.restricted_response_code');
            $response_headers = [
                GoodwallHeader::RESTRICTED => true,
            ];

            if ($request->expectsJson()) {
                return response()
                    ->json(null, $response_code)
                    ->withHeaders($response_headers);
            }

            if ($response_code === 404) {
                throw new NotFoundHttpException(
                    '',
                    null,
                    0,
                    $response_headers
                );
            }

            return abort($response_code, '', $response_headers);
        }

        return $next($request);
    }
}
