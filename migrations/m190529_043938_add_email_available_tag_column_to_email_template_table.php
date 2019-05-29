<?php

use yii\db\Migration;

/**
 * Handles adding email_available_tag to table `{{%email_template}}`.
 */
class m190529_043938_add_email_available_tag_column_to_email_template_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%email_template}}', 'email_available_tags', "LONGTEXT");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%email_template}}', 'email_available_tags');
    }
}
