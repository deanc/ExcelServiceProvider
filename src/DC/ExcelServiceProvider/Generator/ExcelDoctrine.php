<?php

namespace DC\ExcelServiceProvider\Generator;

use Doctrine\DBAL\Connection;

class ExcelDoctrine extends Excel {

    private $doctrine = null;

    function __construct(Connection $doctrine = null) {
        $this->doctrine = $doctrine;
    }

    public function generateXLSFromTable($tableName) {
        $results = $this->doctrine->fetchAll("SELECT * FROM $tableName ORDER BY id ASC", array($tableName));

        $databaseName = $this->doctrine->fetchColumn("SELECT DATABASE()");

        $headers = $this->doctrine->fetchAll("
          SELECT COLUMN_NAME
          FROM INFORMATION_SCHEMA.COLUMNS
          WHERE TABLE_SCHEMA=?
          AND TABLE_NAME=?
        ", array($databaseName, $tableName));

        $headers = array_map(
            function ($value) { return ucwords($value); }
            ,array_column($headers, 'COLUMN_NAME')
        );

        return $this->generateXLS($headers, $results);
    }

}