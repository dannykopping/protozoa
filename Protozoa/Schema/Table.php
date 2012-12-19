<?php
    namespace Protozoa\Schema;

    /**
     *
     */
    /**
     *
     */
    class Table
    {
        /**
         * @var
         */
        private $_name;

        /**
         * @var array
         */
        private $_columns = array();

        /**
         * @param $name
         */
        public function setName($name)
        {
            $this->_name = $name;
        }

        /**
         * @return mixed
         */
        public function getName()
        {
            return $this->_name;
        }

        /**
         * @param $columns
         */
        public function setColumns($columns)
        {
            $this->_columns = $columns;
        }

        /**
         * @return array
         */
        public function getColumns()
        {
            return $this->_columns;
        }
    }
