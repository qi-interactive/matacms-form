<?php

namespace matacms\form\models;

use Yii;

/**
 * This is the model class for table "form".
 *
 * @property integer $Id
 * @property string $Name
 * @property string $ReferencedTable
 */
class Form extends \matacms\db\ActiveRecord {
    
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%matacms_form}}';
    }

    public function behaviors() {
      return [
     
      ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Name', 'ReferencedTable'], 'required'],
            [['Name'], 'string', 'max' => 128],
            [['ReferencedTable'], 'string', 'max' => 64],
            [['ReferencedTable'], 'validateReferencedTable'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'Id' => 'ID',
            'Name' => 'Name',
            'ReferencedTable' => 'Referenced Table',
        ];
    }

    /**
     * Validates the [[tableName]] attribute.
     */
    public function validateReferencedTable()
    {
        $formTables = $this->findFormTableNames();
        if (!in_array($this->ReferencedTable, $formTables)) {
            $this->addError('ReferencedTable', "Table '{$this->ReferencedTable}' does not exist.");
        }
    }

    public function findFormTableNames() {
        $db = $this->db;
        if ($db === null) {
            return [];
        }
        $formTableNames = [];
        $tableNames = $db->getSchema()->getTableNames();
        if(!empty($tableNames)) {
            foreach ($tableNames as $tableName) {
                // if(strpos($tableName, 'form_') === 0) {
                    $formTableNames[$tableName] = $tableName;
                // }
            }
        }
        return $formTableNames;
    }

    public function beforeSave($insert) 
    {
        if($insert) {
            $generator = new \matacms\gii\generators\model\Generator;        
            $generator->tableName = $this->ReferencedTable;
            $generator->modelClass = $generator->generateClassName($this->ReferencedTable);

            if ($generator->validate()) {
                $generator->saveStickyAttributes();
                $files = $generator->generate();
                $answers = [];
                foreach($files as $file)
                    $answers[$file->id] = 1;

                if($generator->save($files, $answers, $results)) {
                    $this->Class = $generator->ns . '\\' . $generator->modelClass;                
                } else {
                    $this->addError('Name', $results);
                    return false;
                }
            } else {
                $this->addError('Name', implode(', ', $generator->getErrors()));
                return false;
            }
        }       

        return parent::beforeSave($insert);
    }

    public function afterDelete()
    {
        $reflector = new \ReflectionClass($this->Class);
        $filePath = $reflector->getFileName();
        if(file_exists($filePath)) {
            unlink($filePath);
        }
        return parent::afterDelete();
    }

}