<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_images".
 *
 * @property int $image_id
 * @property string $post_id
 * @property string $image_name
 * @property string $image_path
 *
 * @property Posts $post
 */
class PostImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'image_name', 'image_path'], 'required'],
            [['post_id'], 'string', 'max' => 16],
            [['image_name', 'image_path'], 'string', 'max' => 512],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Posts::className(), 'targetAttribute' => ['post_id' => 'post_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'image_id' => 'Image ID',
            'post_id' => 'Post ID',
            'image_name' => 'Image Name',
            'image_path' => 'Image Path',
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\PostsQuery
     */
    public function getPost()
    {
        return $this->hasOne(Posts::className(), ['post_id' => 'post_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\PostImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PostImagesQuery(get_called_class());
    }
}
