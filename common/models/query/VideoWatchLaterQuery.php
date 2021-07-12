<?php

namespace common\models\query;

use common\models\VideoWatchLater;

/**
 * This is the ActiveQuery class for [[\common\models\VideoWatchLater]].
 *
 * @see \common\models\VideoWatchLater
 */
class VideoWatchLaterQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\VideoWatchLater[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\VideoWatchLater|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function userIDvideoID($userID, $videoID)
    {
        return $this->andWhere([
            'video_id' => $videoID,
            'user_id' => $userID,
        ]);
    }
    public function watchlater()
    {
        return $this->andWhere([
            'type' => VideoWatchLater::TYPE_WATCH_LATER,
        ]);
    }
}
