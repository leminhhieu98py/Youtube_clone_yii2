<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%video_watch_later}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%videos}}`
 * - `{{%user}}`
 */
class m210712_141453_create_video_watch_later_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%video_watch_later}}', [
            'id' => $this->primaryKey(),
            'video_id' => $this->string(16)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'type' => $this->integer(1),
            'created_at' => $this->integer(11),
        ]);

        // creates index for column `video_id`
        $this->createIndex(
            '{{%idx-video_watch_later-video_id}}',
            '{{%video_watch_later}}',
            'video_id'
        );

        // add foreign key for table `{{%videos}}`
        $this->addForeignKey(
            '{{%fk-video_watch_later-video_id}}',
            '{{%video_watch_later}}',
            'video_id',
            '{{%videos}}',
            'video_id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-video_watch_later-user_id}}',
            '{{%video_watch_later}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-video_watch_later-user_id}}',
            '{{%video_watch_later}}',
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
            '{{%fk-video_watch_later-video_id}}',
            '{{%video_watch_later}}'
        );

        // drops index for column `video_id`
        $this->dropIndex(
            '{{%idx-video_watch_later-video_id}}',
            '{{%video_watch_later}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-video_watch_later-user_id}}',
            '{{%video_watch_later}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-video_watch_later-user_id}}',
            '{{%video_watch_later}}'
        );

        $this->dropTable('{{%video_watch_later}}');
    }
}
