<?php

declare(strict_types=1);

namespace Pumukit\OAuth2Bundle\Provider;

use League\OAuth2\Client\Provider\GenericProvider as BaseGenericProvider;

/**
 * Represents a generic service provider that may be used to interact with any OAuth 2.0 service provider, using Bearer token authentication.
 */
class Oam extends BaseGenericProvider
{
    public $defaultSeparatorScope = ' ';

    /**
     * Builds request options used for requesting an access token.
     */
    protected function getAccessTokenOptions(array $params): array
    {
        $options = ['headers' => [
            'content-type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Basic '.base64_encode($params['client_id'].':'.$params['client_secret']),
        ],
        ];

        if (self::METHOD_POST === $this->getAccessTokenMethod()) {
//            $options['body'] = $this->getAccessTokenQuery($params);
            $options['body'] = $this->getAccessTokenBody($params);
        }

        return $options;
    }

    protected function getScopeSeparator(): string
    {
        return $this->defaultSeparatorScope;
    }
}
