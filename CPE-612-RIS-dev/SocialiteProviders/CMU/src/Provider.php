<?php

namespace SocialiteProviders\CMU;

use Laravel\Socialite\Two\ProviderInterface;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

class Provider extends AbstractProvider implements ProviderInterface
{
    /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'CMU';

    /**
     * {@inheritdoc}
     */
    protected $scopes = ['cmuitaccount.basicinfo'];

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://oauth.cmu.ac.th/v1/Authorize.aspx', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://oauth.cmu.ac.th/v1/GetToken.aspx';
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get('https://misapi.cmu.ac.th/cmuitaccount/v1/api/cmuitaccount/basicinfo', [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'cmu_it_account'       => $user['cmuitaccount'],
            'prename_id' => $user['prename_id'],
            'prename_TH'     => $user['prename_TH'],
            'prename_EN'    => $user['prename_EN'],
            'firstname_TH'   => $user['firstname_TH'],
            'firstname_EN'   => $user['firstname_EN'],
            'lastname_TH'   => $user['lastname_TH'],
            'lastname_EN'   => $user['lastname_EN'],
            'organization_code'   => $user['organization_code'],
            'organization_name_TH'   => $user['organization_name_TH'],
            'organization_name_EN'   => $user['organization_name_EN'],
            'itaccounttype_id'   => $user['itaccounttype_id'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code'
        ]);
    }
}
