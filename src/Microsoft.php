<?php
namespace pde159\authclient;

/**
 * Microsoft allows authentication via Microsoft Graph API.
 *
 * @author Pierre DEPREY
 */

class Microsoft extends \yii\authclient\OAuth2
{
    
    /**
     * {@inheritdoc}
     */
    public $authUrl = 'https://login.microsoftonline.com/common/oauth2/v2.0/authorize';
    /**
     * {@inheritdoc}
     */
    public $tokenUrl = 'https://login.microsoftonline.com/common/oauth2/token';
    /**
     * {@inheritdoc}
     */
    public $apiBaseUrl = 'https://graph.microsoft.com';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if ($this->scope === null) {
            $this->scope = implode(',', [
                "offline_access",
                "openid", 
                "https://graph.microsoft.com/mail.read",
            ]);
        }
    }
    
    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'microsoft';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Microsoft';
    }

  /**
   * @inheritdoc
   */
	protected function initUserAttributes()
	{
		return $this->api('me', 'GET');
	}

  /**
   * @inheritdoc
   */
  public function applyAccessTokenToRequest($request, $accessToken)
  {
    $request->addHeaders(['Authorization' => sprintf("Bearer %s", $accessToken->getToken())]);
  }

  /**
   * @inheritdoc
   */
  public function getEmail()
  {
		return isset($this->getUserAttributes()['email'])
			? $this->getUserAttributes()['email']
			: null;
  }

  /**
   * @inheritdoc
   */
  public function getUsername()
  {
		return isset($this->getUserAttributes()['username'])
			? $this->getUserAttributes()['username']
			: null;
  }
}