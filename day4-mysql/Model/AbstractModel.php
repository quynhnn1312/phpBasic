<?php
namespace Model;

use Database\Database;

class AbstractModel
{
    /**
     * @var AbstractDatabase
     */
    protected $abstractDb;

    protected $tableName = null;

    protected $primaryKey = null;

    protected $data = [];

    public function __construct()
    {
        //Todo Inject abstractDb tại đây
        $this->abstractDb = new Database();
    }

    /**
     * @return string
     */
    public function getTableName() {
        return $this->tableName;
    }

    public function getPrimaryKey() {
        return $this->primaryKey;
    }

    /**
     * @return array
     */
    public function fetchAll() {
        return $this->abstractDb->fetch($this->getTableName());
    }

    /**
     * @param $id
     * @return $this
     */
    public function load($id) {
        //Todo
        // Build condition
        $condition = $this->getPrimaryKey() . "= $id";
        $result = $this->abstractDb->fetch($this->getTableName(), $condition);
        // Check result va tra ket qua
        if(!$result) return false;
        return $result;
    }

    public function save() {
        $data = $this->prepareDataBeforeSave();
        if ($this->isNew()) {
            $result = $this->abstractDb->insert($this->getTableName(), $data);
        } else {
            //Todo
            // Build condition update
            $condition = $this->getData($this->getPrimaryKey());
            $result = $this->abstractDb->update($this->getTableName(), $data, $condition);
        }
        $this->prepareDataAfterSave($result);
        // Todo check result set data and return

        return $this;
    }

    public function delete() {
        //Todo delete
        $id = $this->getData($this->getPrimaryKey());
        $result = $this->abstractDb->delete($this->getTableName(),$id);
        return $result;
    }

    /**
     * @return array
     */
    protected function prepareDataBeforeSave() {
        //Todo build data for save
        return $this->data;
    }

    protected function prepareDataAfterSave($result) {
        //Todo check result and set to $data
    }

    /**
     * @return bool
     */
    public function isNew() {
        //Todo
        // Logic check có tồn tại giá trị của primary key
        $key = $this->load($this->getData($this->getPrimaryKey()));

        if($key) return false;
        return true;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function setData($key=null, $value=null) {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * @param $key
     * @return string
     */
    public function getData($key=null) {
        //Todo check key co tồn tại hay không ra trả giá trị
        if (!$key) {
            echo "Key does not exist !";
            return;
        }
        return $this->data[$key];
    }
}