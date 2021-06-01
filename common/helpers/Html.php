<?php

namespace common\helpers;

use yii\helpers\Url;

class Html
{
    public static function channelLink($user)
    {
        return \yii\helpers\Html::a(
            $user->username,
            Url::to([
                '/channel/view',
                'username' => $user->username,
            ]),
            [
                'class' => 'text-dark',
                'style' => 'text-decoration: none;'
            ]
        );
    }
}
