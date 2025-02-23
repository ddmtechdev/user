<?php

use yii\db\Migration;

class m250223_045822_location_tables extends Migration
{
    public function safeUp()
    {
        // Regions Table
        $this->createTable('{{%regions}}', [
            'id' => $this->primaryKey(),
            'region_code' => $this->string(10)->notNull()->unique(),
            'region_name' => $this->string(255)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // Provinces Table
        $this->createTable('{{%provinces}}', [
            'id' => $this->primaryKey(),
            'region_id' => $this->integer()->notNull(),
            'province_name' => $this->string(255)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->addForeignKey('fk_province_region', '{{%provinces}}', 'region_id', '{{%regions}}', 'id', 'CASCADE', 'CASCADE');

        // Cities/Municipalities Table
        $this->createTable('{{%cities}}', [
            'id' => $this->primaryKey(),
            'region_id' => $this->integer()->notNull(),
            'province_id' => $this->integer()->null(),
            'city_name' => $this->string(255)->notNull(),
            'category_class' => $this->string(50)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->addForeignKey('fk_city_province', '{{%cities}}', 'province_id', '{{%provinces}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_city_region', '{{%cities}}', 'region_id', '{{%regions}}', 'id', 'CASCADE', 'CASCADE');

        // Barangays Table
        $this->createTable('{{%barangays}}', [
            'id' => $this->primaryKey(),
            'region_id' => $this->integer()->notNull(),
            'province_id' => $this->integer()->null(),
            'city_id' => $this->integer()->notNull(),
            'barangay_name' => $this->string(255)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->addForeignKey('fk_barangay_city', '{{%barangays}}', 'city_id', '{{%cities}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_barangay_province', '{{%barangays}}', 'province_id', '{{%provinces}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_barangay_region', '{{%barangays}}', 'region_id', '{{%regions}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_barangay_region', '{{%barangays}}');
        $this->dropForeignKey('fk_barangay_province', '{{%barangays}}');
        $this->dropForeignKey('fk_barangay_city', '{{%barangays}}');
        $this->dropForeignKey('fk_city_province', '{{%cities}}');
        $this->dropForeignKey('fk_city_region', '{{%cities}}');
        $this->dropForeignKey('fk_province_region', '{{%provinces}}');

        $this->dropTable('{{%barangays}}');
        $this->dropTable('{{%cities}}');
        $this->dropTable('{{%provinces}}');
        $this->dropTable('{{%regions}}');
    }
}
