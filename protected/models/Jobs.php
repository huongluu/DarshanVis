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
        $rows = $command->queryAll();
        return $rows;
    }

    public static function OrderBy($query, $orderby, $mode = "desc") {
        return $query . " order by " . $orderby . " " . $mode;
//        return Jobs::execSQLQuery($query);
    }

    public static function Limit($query, $limit) {
        return $query . " limit " . $limit;
//        return Jobs::execSQLQuery($query);
    }

    public static function filter($query, $attr, $value) {
        $where_pos = strrpos($query, "where");
        $where_clause = substr($query, $where_pos);
        $new_where_clause = $where_clause . " and " . $attr . " = '" . $value + "' ";
        return $query . " where " . $limit;
//        return Jobs::execSQLQuery($query);
    }

}
