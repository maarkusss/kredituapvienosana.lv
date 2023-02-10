<?php

namespace Goodday\Goodwall\Http\Middleware;

use Goodday\Goodwall\Models\GoodwallHeader;
use Goodday\Goodwall\Services\GoodwallService;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Closure;

/**
 * Middleware to be put around API routes which are modifying IP whitelist of the Goodwall
 */
class CanModifyGoodwall
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (config('goodwall.enabled')) {
            $is_valid = true;
            if ($request->method() === 'GET') {
                $is_valid = $this->validateGet($request);
            } elseif ($request->method() === 'POST') {
                $is_valid = $this->validatePost($request);
            }

            if ($is_valid === false) {
                $response_code = $request->hasHeader(GoodwallHeader::API_KEY)
                    ? config('goodwall.forbidden_response_code')
                    : config('goodwall.restricted_response_code');

                if ($request->method() === 'POST' &&
                    $this->hasValidApiKey($request) &&
                    !$this->hasValidSignature($request)) {
                    $response_code = config('goodwall.bad_request_response_code');
                }

                if ($request->expectsJson()) {
                    return response()
                        ->json(null, $response_code);
                }

                return abort($response_code);
            }
        }

        return $next($request);
    }

    protected function validateGet(Request $request): bool
    {
        return $this->hasValidApiKey($request);
    }

    protected function validatePost(Request $request): bool
    {
        return $this->hasValidApiKey($request) && $this->hasValidSignature($request);
    }

    protected function hasValidApiKey(Request $request): bool
    {
        return !empty(config('goodwall.api_key')) &&
            $request->hasHeader(GoodwallHeader::API_KEY) &&
            $request->header(GoodwallHeader::API_KEY) === config('goodwall.api_key');
    }

    public function hasValidSignature(Request $request): bool
    {
        $service = App::make(GoodwallService::class);
        /** @var GoodwallService $service */
        $signature = $service->sign($request->toArray());

        return config('goodwall.enabled') === true &&
            $request->hasHeader(GoodwallHeader::SIGNATURE) &&
            $request->header(GoodwallHeader::SIGNATURE) === $signature;
    }
}
