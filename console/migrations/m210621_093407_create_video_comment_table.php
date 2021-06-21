<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%video_comment}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%videos}}`
 * - `{{%user}}`
 */
class m210621_093407_create_video_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%video_comment}}', [
            'id' => $this->primaryKey(),
            'video_id' => $this->string(16)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'content' => $this->string(5000),
            'created_at' => $this->integer(11),
        ]);

        // creates index for column `video_id`
        $this->createIndex(
            '{{%idx-video_comment-video_id}}',
            '{{%video_comment}}',
            'video_id'
        );

        // add foreign key for table `{{%videos}}`
        $this->addForeignKey(
            '{{%fk-video_comment-video_id}}',
            '{{%video_comment}}',
            'video_id',
            '{{%videos}}',
            'video_id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-video_comment-user_id}}',
            '{{%video_comment}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-video_comment-user_id}}',
            '{{%video_comment}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%videos}}`
        $this->dropForeignKey(
            '{{%fk-video_comment-video_id}}',
            '{{%video_comment}}'
        );

        // drops index for column `video_id`
        $this->dropIndex(
            '{{%idx-video_comment-video_id}}',
            '{{%video_comment}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-video_comment-user_id}}',
            '{{%video_comment}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-video_comment-user_id}}',
            '{{%video_comment}}'
        );

        $this->dropTable('{{%video_comment}}');
    }
}
