<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%email_template}}`.
 */
class m190903_060614_add_text_version_column_to_email_template_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%email_template}}', 'text_version', "LONGTEXT NULL");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%email_template}}', 'text_version');
    }
}
