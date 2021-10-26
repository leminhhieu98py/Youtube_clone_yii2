<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property string $post_id
 * @property string $post_description
 * @property int $post_status
 * @property string $created_at
 * @property int $created_by
 *
 * @property PostComment[] $postComments
 * @property PostImages[] $postImages
 * @property PostLike[] $postLikes
 * @property User $createdBy
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'post_description', 'post_status', 'created_at', 'created_by'], 'required'],
            [['post_description'], 'string'],
            [['post_status', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['post_id'], 'string', 'max' => 16],
            [['post_id'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'post_description' => 'Post Description',
            'post_status' => 'Post Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[PostComments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\PostCommentQuery
     */
    public function getPostComments()
    {
        return $this->hasMany(PostComment::class, ['post_id' => 'post_id']);
    }

    /**
     * Gets query for [[PostImages]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\PostImagesQuery
     */
    public function getPostImages()
    {
        return $this->hasMany(PostImages::class, ['post_id' => 'post_id']);
    }

    /**
     * Gets query for [[PostLikes]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\PostLikeQuery
     */
    public function getPostLikes()
    {
        return $this->hasMany(PostLike::class, ['post_id' => 'post_id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\PostsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PostsQuery(get_called_class());
    }
}
