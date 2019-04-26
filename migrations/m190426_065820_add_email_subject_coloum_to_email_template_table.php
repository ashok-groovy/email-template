<?php

use yii\db\Migration;

/**
 * Class m190426_065820_add_email_subject_coloum_to_email_template_table
 */
class m190426_065820_add_email_subject_coloum_to_email_template_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%email_template}}', 'email_subject', $this->string(255)->Null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%email_template}}', 'email_subject');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190426_065820_add_email_subject_coloum_to_email_template_table cannot be reverted.\n";

        return false;
    }
    */
}
