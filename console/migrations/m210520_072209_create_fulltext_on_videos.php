<?php

use yii\db\Migration;

/**
 * Class m210520_072209_create_fulltext_on_videos
 */
class m210520_072209_create_fulltext_on_videos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE {{%videos}} ADD FULLTEXT(title, description, tags)");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210520_072209_create_fulltext_on_videos cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210520_072209_create_fulltext_on_videos cannot be reverted.\n";

        return false;
    }
    */
}
