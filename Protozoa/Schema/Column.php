<?php
    namespace Protozoa\Schema;

    /**
     *
     */
    class Column
    {
        private $_name;

        private $_isPrimaryKey;
        private $_isForeignKey;

        public function setName($name)
        {
            $this->_name = $name;
        }

        public function getName()
        {
            return $this->_name;
        }

        public function setIsForeignKey($isForeignKey)
        {
            $this->_isForeignKey = $isForeignKey;
        }

        public function isForeignKey()
        {
            return $this->_isForeignKey;
        }

        public function setIsPrimaryKey($isPrimaryKey)
        {
            $this->_isPrimaryKey = $isPrimaryKey;
        }

        public function isPrimaryKey()
        {
            return $this->_isPrimaryKey;
        }
    }
