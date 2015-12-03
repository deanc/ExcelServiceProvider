<?php

namespace DC\ExcelServiceProvider\Generator;

use Doctrine\DBAL\Connection;

class ExcelDoctrine extends Excel {

    private $doctrine = null;

    function __construct(Connection $doctrine = null) {
        $this->doctrine = $doctrine;
    }

    public function generateXLSFromTable($dbName, $tableName) {
        $results = $this->doctrine->fetchAll("SELECT * FROM ? ORDER BY id ASC", array($tableName));

        $databaseName = $this->doctrine->fetchColumn("SELECT DATABASE()");
        $headers = $this->doctrine->fetchAll("
          SELECT COLUMN_NAME
          FROM INFORMATION_SCHEMA.COLUMNS
          WHERE TABLE_SCHEMA=?
          AND TABLE_NAME=?
        ", array($dbName, $tableName));

        return $this->generateXLS($headers, $results);
    }

}