<?php

Yii::import('application.models._base.BaseJobs');

class Jobs extends BaseJobs {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function execSQLQuery($query) {
        $connection = Yii::app()->db;   // assuming you have configured a "db" connection
        // If not, you may explicitly create a connection:
        // $connection=new CDbConnection($dsn,$username,$password);
        $command = $connection->createCommand($query);
        // if needed, the SQL statement may be updated as follows:
        // $command->text=$newSQL;
        $rows=$command->queryAll();
        return $rows;
    }

}
