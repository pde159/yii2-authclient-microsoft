<?php
namespace pde159\authclient;

use Yii;
use yii\authclient\OAuth2;
use pde159\authclient\widgets\MicrosoftStyleAsset;
 
class Microsoft extends OAuth2
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
            $this->scope = implode(' ',[
                "offline_access",
                "openid", 
                "https://graph.microsoft.com/mail.read",
            ]);
        }
        $view = Yii::$app->getView();
        MicrosoftStyleAsset::register($view);
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