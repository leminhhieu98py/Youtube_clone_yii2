<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\VideoComment]].
 *
 * @see \common\models\VideoComment
 */
class VideoCommentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\VideoComment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\VideoComment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function videoID($videoID)
    {
        return $this->andWhere([
            'video_id' => $videoID,
        ]);
    }
    public function latest()
    {
        return $this->orderBy(['created_at' => SORT_DESC]);
    }
}
