<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.09.2016
 * Time: 3:13
 */

namespace app\models\traits;


use yii\base\ModelEvent;

trait SafeDeleteTrait
{
    public function init(){
        $this->deleted = 0;
        $this->deleted_at = null;
    }

    /**
     * @return bool
     */
    public function beforeSafeDelete(){
        $event = new ModelEvent();
        $this->trigger('beforeSafeDelete', $event);

        return $event->isValid;
    }

    /**
     * @return bool|int
     * @throws \yii\db\Exception
     */
    public function safeDelete(){
        if (!$this->beforeSafeDelete()) {
            return false;
        }

        $date = new \DateTime('now', new \DateTimeZone('Europe/Moscow'));

        $this->deleted_at = $date->format('Y-m-d H:i:s');
        $this->deleted = 1;

        $connection = \Yii::$app->db;
        $result = $connection ->createCommand()
            ->update(
                $this->tableName(),
                [
                    'deleted_at' => $this->deleted_at,
                    'deleted' => $this->deleted,
                ],
                ['id' => $this->id]
            )
            ->execute();

        $this->afterSafeDelete();
        return $result;
    }

    /**
     *
     */
    public function afterSafeDelete(){
        $this->trigger('afterSafeDelete');
    }

}