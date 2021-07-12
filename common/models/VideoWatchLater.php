<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%video_watch_later}}".
 *
 * @property int $id
 * @property string $video_id
 * @property int $user_id
 * @property int|null $type
 * @property int|null $created_at
 *
 * @property User $user
 * @property Videos $video
 */
class VideoWatchLater extends \yii\db\ActiveRecord
{

    const TYPE_WATCH_LATER = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%video_watch_later}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['video_id', 'user_id'], 'required'],
            [['user_id', 'type', 'created_at'], 'integer'],
            [['video_id'], 'string', 'max' => 16],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['video_id'], 'exist', 'skipOnError' => true, 'targetClass' => Videos::class, 'targetAttribute' => ['video_id' => 'video_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'video_id' => 'Video ID',
            'user_id' => 'User ID',
            'type' => 'Type',
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
     * Gets query for [[Video]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\VideosQuery
     */
    public function getVideo()
    {
        return $this->hasOne(Videos::class, ['video_id' => 'video_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\VideoWatchLaterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VideoWatchLaterQuery(get_called_class());
    }
}
