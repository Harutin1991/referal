<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\SourceMessage]].
 *
 * @see \app\models\SourceMessage
 */
class SourceMessageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\SourceMessage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\SourceMessage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
