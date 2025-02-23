<?php

use yii\db\Migration;

class m250220_053325_create_profile_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%profile}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->unique(),
            'first_name' => $this->string()->notNull(),
            'middle_name' => $this->string()->null(),
            'last_name' => $this->string()->notNull(),
            'suffix' => $this->string(10)->null(),
            'birthdate' => $this->date()->notNull(),
            'gender' => $this->string(10)->notNull(),
            'street' => $this->string()->null(),
            'barangay_id' => $this->integer()->notNull(),
            'city_id' => $this->integer()->notNull(),
            'province_id' => $this->integer()->null(),
            'region_id' => $this->integer()->notNull(),
            'email' => $this->string()->notNull(),
            'contact_number' => $this->string(15)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk-profile-user_id',
            '{{%profile}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-profile-user_id', '{{%profile}}');
        $this->dropTable('{{%profile}}');
    }
}
