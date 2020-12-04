<?php

    namespace CAMAGRU\Models;
    
    class AbstractModel
    {
        const DATA_TYPE_STR = \PDO::PARAM_STR;
        const DATA_TYPE_INT = \PDO::PARAM_INT;


        public function create()
        {
            $sql = 'INSERT INTO ' . static::$tableName . ' SET ';
            foreach(static::$tableSchema as $columName => $type)
            {
                $sql .= $columName . '= :' . $columName . ', ';
            }
        }
    }
?>