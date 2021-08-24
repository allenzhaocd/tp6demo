<?php

namespace app\admin\controller;

use app\common\model\mysql\Order;
use app\Request;
use app\BaseController;


class Index extends BaseController
{
    public function index(Request $request)
    {
        return '我是默认的控制器和方法';
    }

    public function login(){
        $result = Order::create([
            'order_sn'  =>  20210819,
            'user_id' =>  '56'
        ], ['order_sn', 'user_id'],false);
        echo $result->order_sn."</br>";
        echo $result->user_id."</br>";
        echo $result->id."</br>"; // 获取自增ID
        echo Order::getLastSql();
       // die();
       $result1 = Order::where('id','<',10)->select();
        //$result = Db::table('hw_order')->where("id",1)->fetchSql()->find();
	    dump($result1->toArray());
	    //dump($result);
	}

	public function user(){
        $list = Order::where('status', 11)->limit(3)->order('id', 'asc')->select();
        foreach($list as $key=>$order){
            echo $order->order_sn."</br>";
        }
    }

 public function getOrderByStatus(){
        $model = new Order();
        $results = $model->getDataByStatus($status);
        if (empty($results)){
            return ["数据为空"];
        }
        $categorys = config(name:"category");
        foreach ($results as $key=>$statusList){
            $results[$key]['categoryName'] = $categorys[$statusList["status"]]??"其他";
        }

    }


}
