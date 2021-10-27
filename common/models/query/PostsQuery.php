<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Posts]].
 *
 * @see \common\models\Posts
 */
class PostsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Posts[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Posts|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function creator($userID){
        return $this->andWhere(['created_by' => $userID]);
    }

    public function latest(){
        return $this->orderBy(['created_at' => SORT_DESC]);
    }
}
