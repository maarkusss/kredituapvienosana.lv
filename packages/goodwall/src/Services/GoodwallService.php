<?php

namespace Goodday\Goodwall\Services;

use Goodday\Goodwall\Models\GoodwallWhitelist;

class GoodwallService
{
    public function validIps(): array
    {
//        $this->addToWhitelist('127.0.0.1'); // Localhost

        return GoodwallWhitelist::query()
            ->orderBy('ip_address', 'ASC')
            ->pluck('ip_address')
            ->toArray();
    }

    public function addToWhitelist(string $ip_address): void
    {
        GoodwallWhitelist::updateOrCreate([
            'ip_address' => $ip_address,
        ]);
    }

    public function deleteFromWhitelist(string $ip_address): void
    {
        GoodwallWhitelist::query()
            ->where('ip_address', $ip_address)
            ->delete();
    }

    public function sign($data): string
    {
        $prepared_data = json_encode($data);

        return hash_hmac(
            config('goodwall.signature_algo'),
            $prepared_data,
            config('goodwall.secret_key')
        );
    }

    public function isEnabled(): bool
    {
        return config('goodwall.enabled') === true;
    }

    public function isIpWhitelisted(string $ip_address, array $valid_ips = null): bool
    {
        if (is_null($valid_ips)) {
            $valid_ips = $this->validIps();
        }

        if (empty($valid_ips)) {
            return true;
        }

        return in_array($ip_address, $valid_ips);
    }
}
