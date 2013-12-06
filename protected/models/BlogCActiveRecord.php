<?php

abstract class BlogCActiveRecord extends CActiveRecord {
    protected function beforeValidate() {
        if ($this->isNewRecord) {
            $this->add_time = $this->update_time = new CDbExpression('NOW()');
        } else {
            $this->update_time = new CDbExpression('NOW()');
        }
        return parent::beforeValidate();
    }
}