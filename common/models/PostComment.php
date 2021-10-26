<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_comment".
 *
 * @property int $id
 * @property string $post_id
 * @property int $user_id
 * @property string $content
 * @property string $created_at
 *
 * @property User $user
 * @property Posts $post
 */
class PostComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'user_id', 'content', 'created_at'], 'required'],
            [['user_id'], 'integer'],
            [['content'], 'string'],
            [['created_at'], 'safe'],
            [['post_id'], 'string', 'max' => 16],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Posts::class, 'targetAttribute' => ['post_id' => 'post_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'user_id' => 'User ID',
            'content' => 'Content',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\PostsQuery
     */
    public function getPost()
    {
        return $this->hasOne(Posts::class, ['post_id' => 'post_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\PostCommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PostCommentQuery(get_called_class());
    }
}
