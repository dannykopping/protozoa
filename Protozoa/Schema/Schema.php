<?php
    namespace Protozoa\Schema;

    use Doctrine\DBAL\Configuration;
    use Doctrine\DBAL\DriverManager;

    /**
     *
     */
    class Schema
    {
        /**
         * @var \Doctrine\DBAL\Connection
         */
        private $_connection;

        /**
         * @var
         */
        private $_tables;

        /**
         * @param \Doctrine\DBAL\Configuration $config
         * @param array                        $connectionParams
         */
        public function __construct(Configuration $config, array $connectionParams)
        {
            $this->_connection = DriverManager::getConnection($connectionParams, $config);
            $this->_connection->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
            $this->_connection->connect();
        }

        /**
         * @return \Doctrine\DBAL\Connection
         */
        public function getConnection()
        {
            return $this->_connection;
        }

        /**
         *
         */
        public function analyze()
        {
            $tables        = $this->_connection->getSchemaManager()->listTables();
            $this->_tables = array();

            foreach ($tables as $table) {
                $this->_tables[] = $this->parseTable($table);
            }
        }

        /**
         * @param \Doctrine\DBAL\Schema\Table $table
         *
         * @return Table
         */
        private function parseTable(\Doctrine\DBAL\Schema\Table $table)
        {
            $t = new Table();
            $t->setName($table->getName());

            $columnDetails = $table->getColumns();
            $columns       = array();
            foreach ($columnDetails as $column) {
                $columns[] = $this->parseColumn($table, $column);
            }

            $t->setColumns($columns);

            return $t;
        }

        /**
         * @param \Doctrine\DBAL\Schema\Table  $table
         * @param \Doctrine\DBAL\Schema\Column $column
         *
         * @return Column
         */
        private function parseColumn(\Doctrine\DBAL\Schema\Table $table, \Doctrine\DBAL\Schema\Column $column)
        {
            $c = new Column();
            $c->setName($column->getName());
            $c->setIsPrimaryKey($this->isPrimaryKey($table, $column->getName()));
            $c->setIsForeignKey($this->isForeignKey($table, $column->getName()));

            print_r($c);

            return $c;
        }

        /**
         * @param \Doctrine\DBAL\Schema\Table $table
         * @param                             $columnName
         *
         * @return bool
         */
        private function isPrimaryKey(\Doctrine\DBAL\Schema\Table $table, $columnName)
        {
            $primaryKeys = $table->getPrimaryKeyColumns();

            if (empty($primaryKeys) || count($primaryKeys) <= 0) {
                return false;
            }

            return in_array($columnName, $primaryKeys);
        }

        /**
         * @param \Doctrine\DBAL\Schema\Table $table
         * @param                             $columnName
         *
         * @return bool
         */
        private function isForeignKey(\Doctrine\DBAL\Schema\Table $table, $columnName)
        {
            $foreignKeys = $table->getForeignKeys();

            if (empty($foreignKeys) || count($foreignKeys) <= 0) {
                return false;
            }

            foreach($foreignKeys as $foreignKey)
            {
                if(in_array($columnName, $foreignKey->getLocalColumns()))
                    return true;
            }

            return false;
        }

        /**
         * @return mixed
         */
        public function getTables()
        {
            return $this->_tables;
        }
    }
