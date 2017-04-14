<?php

namespace common\models;

use function array_key_exists;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "xmp_countries".
 *
 * @property integer $id
 * @property string  $name
 * @property integer $code
 * @property integer $status
 * @property string  $iso
 * @property integer $priority
 * @property string  $flag
 * @property string  $currency
 */
class Countries extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%countries}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code', 'status', 'iso', 'priority'], 'required'],
            [['code', 'status', 'priority'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['flag'], 'string', 'max' => 64],
            [['iso', 'currency'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'status' => 'Status',
            'iso' => 'Iso',
            'priority' => 'Priority',
        ];
    }

    public function afterSave($insert, $oldAttributes)
    {
        $log = new Logs();
        $log->controller = Yii::$app->requestedAction->controller->id;
        $log->action = Yii::$app->requestedAction->id;
        $ev = [
            'id' => $this->id,
        ];

        if (!$this->isNewRecord) {
            $event = [];
            foreach ($this->attributes as $attribute => $value) {
                if (!array_key_exists($attribute, $oldAttributes)) {
                    continue;
                }

                $valueOld = $oldAttributes[$attribute];
                if ($valueOld === $value) {
                    continue;
                }

                if (is_numeric($valueOld) && $valueOld === (integer)$value) {
                    continue;
                }

                $event[$attribute] = [
                    'from' => $oldAttributes[$attribute],
                    'to' => $value,
                ];
            }

            if (count($event)) {
                $ev['fields'] = $event;
            }
        }

        $log->event = $ev;
        $log->save();

        return parent::afterSave(
            $insert,
            $oldAttributes
        );
    }

}
