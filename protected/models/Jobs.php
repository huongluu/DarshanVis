<?php

Yii::import('application.models._base.BaseJobs');

class Jobs extends BaseJobs {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }


 public static function query_formater($query)
    {
        $query_str='(';
        //base case, there is no subquery in from
        if (!isset($query["from"]["query"]) )
        {
             if ((isset($query["select"])) && strlen($query["select"]) != 0) 
             {
                $query_str .= "select " . $query["select"] . " ";

                if ((isset($query["from"])) ) {
                    $query_str .= " from " . $query["from"] . " ";
                }
                if ((isset($query["where"])) && strlen($query["where"]) != 0) {
                    $query_str .= " where " . $query["where"] . " ";
                }
                if ((isset($query["group"])) && strlen($query["group"]) != 0) {
                    $query_str .= " group by " . $query["group"] . " ";
                }
                if ((isset($query["order"])) && strlen($query["order"]) != 0) {
                    $query_str .= " order by " . $query["order"] . " ";
                }
                if ((isset($query["limit"])) && strlen($query["limit"]) != 0) {
                    $query_str .= " limit " . $query["limit"] . " ";
                }
                $query_str .=')';
                if ((isset($query["alias"])) && strlen($query["alias"]) != 0) {
                    $query_str .= "  " . $query["alias"] . " ";
                }
            }
            else 
            {
            $query_str = $query;
            }



            return $query_str;
        }
        //recursive case
        $from=" from ( ";
        if ((isset($query["select"])) && strlen($query["select"]) != 0) 
             {
                $query_str .= "select " . $query["select"] . " ";

                //deal with from 
                foreach ($query["from"]["query"] as $subquery) 
                {
                    $from .= Jobs:: query_formater($subquery);
                    $from .= ",";
                }

                $from= rtrim($from, ",");
                $from.= ") ";

                $query_str .= $from;



                if ((isset($query["where"])) && strlen($query["where"]) != 0) {
                    $query_str .= " where " . $query["where"] . " ";
                }
                if ((isset($query["group"])) && strlen($query["group"]) != 0) {
                    $query_str .= " group by " . $query["group"] . " ";
                }
                if ((isset($query["order"])) && strlen($query["order"]) != 0) {
                    $query_str .= " order by " . $query["order"] . " ";
                }
                if ((isset($query["limit"])) && strlen($query["limit"]) != 0) {
                    $query_str .= " limit " . $query["limit"] . " ";
                }
            }
            else 
            {
                $query_str = $query;
            }

            $query_str.=' ) ';
            return $query_str;
    }






    public static function execSQLQuery($query) {
        $connection = Yii::app()->db;   // assuming you have configured a "db" connection
        // If not, you may explicitly create a connection:
        // $connection=new CDbConnection($dsn,$username,$password);

        // $query_str = "";
        // if ((isset($query["select"])) && strlen($query["select"]) != 0) {
        //     $query_str .= "select " . $query["select"] . " ";

        //     if ((isset($query["from"])) && strlen($query["from"]) != 0) {
        //         $query_str .= " from " . $query["from"] . " ";
        //     }
        //     if ((isset($query["where"])) && strlen($query["where"]) != 0) {
        //         $query_str .= " where " . $query["where"] . " ";
        //     }
        //     if ((isset($query["group"])) && strlen($query["group"]) != 0) {
        //         $query_str .= " group by " . $query["group"] . " ";
        //     }
        //     if ((isset($query["order"])) && strlen($query["order"]) != 0) {
        //         $query_str .= " order by " . $query["order"] . " ";
        //     }
        //     if ((isset($query["limit"])) && strlen($query["limit"]) != 0) {
        //         $query_str .= " limit " . $query["limit"] . " ";
        //     }
        // } else {
        //     $query_str = $query;
        // }

        $query_str= Jobs::query_formater($query);



    // echo "QQQ:" . $query_str . "";
        $command = $connection->createCommand($query_str);
        // if needed, the SQL statement may be updated as follows:
        // $command->text=$newSQL;
        $rows = $command->queryAll();
        return $rows;
    }










    public static function OrderBy(&$query, $orderby, $mode = "desc") {
        if (isset($orderby) && strlen($orderby) > 0) {
            $query["order"] = $orderby . " " . $mode;
//        $query["order"] = $orderby . " ";
        }
        return $query;
    }

    public static function addSortingLevel(&$query, $orderby, $mode = "desc") {
        if (isset($orderby) && strlen($orderby) > 0) {
            $query["order"] .= " , " . $orderby . " " . $mode;
//        $query["order"] = $orderby . " ";
        }
        return $query;
    }


   public static function addSortingLevel_1(&$query, $orderby, $mode = "desc") 
       {
    

        if (!isset($query["from"]["query"]) )
        {
            if (isset($orderby) && strlen($orderby) > 0) 
            {
                $query["order"] .= " , " . $orderby . " " . $mode;
                //        $query["order"] = $orderby . " ";
            }
            else 
            {
                $query .= " orderby " . $orderby . " " . $mode . " " ;
            }
         return $query;
       }
       //recursive
       foreach ($query["from"]["query"] as $subquery) 
                {
                    $subquery=Jobs:: addSortingLevel_1($subquery, $orderby, $mode = "desc");
                }
       return $query;
    }
     


    public static function Limit(&$query, $limit) {
        $query["limit"] = $limit;
        return $query;
    }



    public static function filter(&$query, $attr, $value, $comparator = "=") {

        if (!isset($query["where"]) || strlen($query["where"]) == 0) {
            $query["where"] = " " . $attr . " " . $comparator . " '" . $value . "' ";
        } else {
            $query["where"] .= " and " . $attr . " " . $comparator . " '" . $value . "' ";
        }

        return $query;
    }



      public static  function filter_1($query, $attr, $value, $comparator = "=") 
        {

        if (!isset($query["from"]["query"]) )
        {
            if (!isset($query["where"]) || strlen($query["where"]) == 0) 
            {
                if(!isset($query["select"]))
                    $query .= " where " . $attr . " " . $comparator . " '" . $value . "' ";
                else
                   $query["where"] = " " . $attr . " " . $comparator . " '" . $value . "' ";
            } 
            else 
            {
                $query["where"] .= " and " . $attr . " " . $comparator . " '" . $value . "' ";
            }
         return $query;
       }
        //recursive
        foreach ($query["from"]["query"] as &$subquery) 
                {
                    $subquery= Jobs:: filter_1($subquery,$attr, $value, $comparator );

                }
        return $query;
    }



}
