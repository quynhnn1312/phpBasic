<?php

namespace Model;

use Model\AbstractModel;

class Product extends AbstractModel
{
    protected $tableName = 'products';

    protected $primaryKey = "id";

}