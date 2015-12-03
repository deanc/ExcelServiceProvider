# Silex ExcelServiceProvider

## Introduction

This service provider for Silex allows you to quickly generate Excel (*.xls) spreadsheets. Either pass in a query result
set, and a list of headers, or use the Doctrine functionality to convert a table to a spreadsheet.

## Installations

Require the provider using `composer`:

        composer require deanc/excel-service-provider
        
Register the provider in your application somewhere:

        $app->register(new \DC\ExcelServiceProvider\Provider\ExcelServiceProvider());

## Usage

Generate a spreadsheet from a table (if you are using the `DoctrineServiceProvider`):

```php
        $excel = $app['excel']->generateXLSFromTable('tableName');
```        

Generate a spreadsheet manually:

```php
        $headers = array('ID', 'Name', 'Created');
        $data = array(
                0 => array('id' => 1, 'name' => 'Bill Gates', 'created' => '2015-01-01 00:00'),
                1 => array('id' => 2, 'name' => 'Steve Jobs', 'created' => '2015-01-02 00:00'),
                2 => array('id' => 3, 'name' => 'Bill Murray', 'created' => '2015-01-03 00:00')
        );

        $excel = $app['excel']->generateXLS($headers, $results);
```
        
Forcing a download of the spreadsheet:

```php
        $controllers->get('/download', function () use($app) {
        
            $excel = $app['excel']->generateXLSFromTable('tableName');
        
            $xlsName = 'tableName-' . date('Y-m-dhis') . '.xls';
            header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
            header("Content-Disposition: inline; filename=\"" . $xlsName . "\"");
            header("Pragma: no-cache");
            header("Expires: 0");
            echo $excel;
            exit;
                
        })->bind('download');
```