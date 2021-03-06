<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m160905_175106_create_wagon extends Migration
{
    public $tableName = '{{%wagon}}';

    public function up()
    {
        try {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
            }

            $this->createTable($this->tableName, [
                'id' => 'INT(11) PRIMARY KEY AUTO_INCREMENT',
                'number_wagon' => $this->string(8)->unique() . ' NOT NULL',
                'type_id' => 'INT(11) NOT NULL',
                'created_at' => Schema::TYPE_DATETIME . " NOT NULL DEFAULT '0000-00-00 00:00:00'",
                'img_path' => $this->string(255),
                'enabled' => $this->boolean()->notNull()->defaultValue('1'),
                'deleted' => $this->boolean()->notNull()->defaultValue('0'),
                'deleted_at' => Schema::TYPE_DATETIME . " NOT NULL DEFAULT '0000-00-00 00:00:00'",
            ], $tableOptions);

            return true;
        } catch (Exception $e) {
            echo 'Exception: ', $e->getMessage(), "\n";
            $this->down();

            return false;
        }
    }

    public function down()
    {
        try {
            $tableToCheck = Yii::$app->db->schema->getTableSchema($this->tableName);

            if (is_object($tableToCheck)) {
                $this->dropTable($this->tableName);
            }
        } catch (Exception $e) {
            echo 'Exception while down ', $e->getMessage(), "\n";
        }
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
