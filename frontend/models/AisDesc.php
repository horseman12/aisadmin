<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ais_article".
 *
 * @property integer $art_id
 * @property string $art_title
 * @property string $art_content
 * @property string $art_starttime
 * @property string $art_img
 */
class AisDesc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ais_desc';
    }
}
