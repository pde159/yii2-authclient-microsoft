<?php

namespace pde159\authclient\widgets;

use yii\web\AssetBundle;

class MicrosoftStyleAsset extends AssetBundle
{
    public $sourcePath = '@vendor/pde159/yii2-authclient-microsoft/src/widgets';
    public $css = [
        'authchoice.css',
    ];
}
