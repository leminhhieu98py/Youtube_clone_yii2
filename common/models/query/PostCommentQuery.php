<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\PostComment]].
 *
 * @see \common\models\PostComment
 */
class PostCommentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\PostComment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\PostComment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
