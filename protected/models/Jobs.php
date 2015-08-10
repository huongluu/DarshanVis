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
        $query_str = "";
        if (isset($query["select"])) {
            $query_str .= "select " . $query["select"] . " ";
            $query_str .= " from " . $query["from"] . " ";
            if (isset($query["where"])) {
                $query_str .= " where " + $query["where"] . " ";
            }
            if (isset($query["order"])) {
                $query_str .= " order by " + $query["order"] . " ";
            }
            if (isset($query["limit"])) {
                $query_str .= " limit " + $query["limit"] . " ";
            }
        } else {
            $query_str = $query;
        }

        $command = $connection->createCommand($query);
        // if needed, the SQL statement may be updated as follows:
        // $command->text=$newSQL;
        $rows = $command->queryAll();
        return $rows;
    }

    public static function OrderBy($query, $orderby, $mode = "desc") {
        $query["order"] = $orderby . " " . $mode;
        return $query;
    }

    public static function Limit($query, $limit) {
        $query["limit"] = $limit;
        return $query;
    }

    public static function filter($query, $attr, $value) {
        if (!isset($query["where"])) {
            $query["where"] = " " . $attr . " = '" . $value + "' ";
        } else {
            $query["where"] = " and " . $attr . " = '" . $value + "' ";
        }
        return $query;
    }

}
