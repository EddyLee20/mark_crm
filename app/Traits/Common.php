<?php


namespace App\Traits;


trait Common
{
    /**
     * 批量更新sql
     * @param array $data
     * @param string $table
     * @param string $byField
     * @param string $toField
     * @return string
     */
    protected static function updateBatch(array $data, string $table, string $byField, string $toField): string
    {
        //拼接批量更新sql语句
        $sql = "UPDATE `".$table."` SET ";
        //合成sql语句
        $sql .= "{$toField} = CASE {$byField} ";
        $toKeys = [];
        foreach ($data as $key=>$val){
            $toKeys[] = $key;
            $sql .= sprintf("WHEN '%s' THEN '%s' ", $key, $val);
        }
        $sql .= "END";
        //拼接sql
        $keys = implode("','", $toKeys);
        $sql .= " WHERE {$byField} IN ('{$keys}')";

        return $sql;
    }
}
