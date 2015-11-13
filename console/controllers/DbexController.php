<?php

namespace mirkhamidov\console\controllers;

use Yii;
use yii\helpers\Console;

class DbexController extends \yii\console\Controller
{
    private $db=null;

    public $interactive = true;

    /**
     * Drop all tables in existing DB
     * Use it before Migration
     * @access public
     */
    public function actionDropAllTables()
    {
        if($this->interactive)
        {
            if(!Console::confirm('Sure that all tables will be dropped?', false))
            {
                $this->stdout("# Canceled. Nothing happened\n", Console::FG_YELLOW);
                return 1;
            }
        }

        $this->_dropTables();
    }

    /**
     * extending parent
     * @access public
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) 
        {
            if($this->db===null)  $this->db = Yii::$app->db;
            return 1;
        }
        else
        {
            return 0;
        }
    }

    /**
     * deleting all tables
     * @access private
     */
    private function _dropTables()
    {
        $tables = $this->db->schema->getTableNames();
        $tablesCount = count($tables);

        if($tablesCount>0)
        {
            $this->stdout("# Srart dropping tables ...\n", Console::FG_GREEN);

            $this->stdout("# Detected tables count: ".($tablesCount)."\n", Console::FG_YELLOW);
            $this->stdout("# Foreign keys check disabling ... ", Console::FG_YELLOW);
            $this->db->createCommand('SET FOREIGN_KEY_CHECKS=0')->execute();
            $this->stdout("done!\n", Console::FG_GREEN);
            
            for($i=0; $i<$tablesCount; ++$i)
            {
                $this->stdout("#   Deleteting table \"".$tables[$i]."\" ... ", Console::FG_YELLOW);
                $_sql = 'DROP TABLE ' . $this->db->quoteTableName($tables[$i]);
                $this->db->createCommand($_sql)->execute();
                $this->stdout("done!\n", Console::FG_GREEN);
            }
            

            $this->stdout("# Foreign keys check enabling ... ", Console::FG_YELLOW);
            $this->db->createCommand('SET FOREIGN_KEY_CHECKS=1')->execute();
            $this->stdout("done!\n", Console::FG_GREEN);

            $this->stdout("# Finish truncating ...\n", Console::FG_GREEN);
        }
        else
        {
            $this->stdout("# No tables found.\n", Console::FG_YELLOW);
        }

        return 1;
    }
}