<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Slider]].
 *
 * @see \app\models\Slider
 */
class SliderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Slider[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Slider|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
