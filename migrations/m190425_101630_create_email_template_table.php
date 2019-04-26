<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%email_template}}`.
 */
class m190425_101630_create_email_template_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%email_template}}', [
            'id' => $this->primaryKey(),
            'emai_template_name' => $this->string(100)->notNull(),
            'email_status' => "ENUM('active', 'deactive') DEFAULT 'active'",
            'email_slug' => $this->string(100)->notNull(),
            'email_content' => "LONGTEXT",
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%email_template}}');
    }
}
