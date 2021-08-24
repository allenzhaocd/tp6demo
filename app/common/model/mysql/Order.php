<?php
namespace app\common\model\mysql;

use think\Model;

class Order extends Model{
    public function getDataByStatus($status,$limit = 5){
        if (empty($status)){
            return [];
        }
        $statusList = $this->where("$status",$status)
            ->limit($limit)
            ->order(field:"id",order:"desc")
            ->select()
            ->toArray();
        return $statusList;

    }
}


