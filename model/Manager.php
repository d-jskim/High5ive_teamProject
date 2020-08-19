<?php

class Manager {
    // protected $_db;

    // protected function __construct() {
    //     $this->_db = new PDO('mysql:host=localhost;dbname=Projects;charset=utf8', 'root', 'root');
    // }

    protected function dbConnect() {
        return new PDO('mysql:host=localhost;dbname=Projects;charset=utf8', 'root', 'root');
    }
}
