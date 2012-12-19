<?php
    namespace Protozoa\Schema;

    class Column
    {
        public $name;
        public $comment;
        public $type;
        public $length = null;
        public $precision = 10;
        public $scale = 0;
        public $unsigned = false;
        public $fixed = false;
        public $notnull = true;
        public $default = null;
        public $autoincrement = false;
        public $relatedTable;
        public $isPrimary = false;
        public $isForeign = false;
    }
