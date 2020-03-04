<?php

namespace app\game\controller;

use app\common\model\GameAction;
use app\common\model\GameActionToUser;
use app\common\model\GameActionUse;
use app\common\model\GameUser;
use think\Controller;

class Actiondata extends Controller
{
    public function action()
    {
        $actionUseModel = new GameActionUse();
        $actionModel = new GameAction();

        $actionUse = $actionUseModel->all();

        foreach ($actionUse as $value){
            $action = $actionModel->get($value->id);
            echo $action->content;
            echo '<br />';
            echo '<br />';
        }
    }
    public function team()
    {
        $evenModel = new GameActionToUser();
        $actionUseModel = new GameActionUse();
        $actionModel = new GameAction();
        $userModel = new GameUser();

        $even = $evenModel->column('action_id');
        $even = array_unique($even);
        foreach ($even as $value){
            $action = $actionModel->get($value);
            echo $action->content.'：<br /><br />';
            $newEven = $evenModel->all(['action_id'=>$value]);
            foreach ($newEven as $val){
                $user = $userModel->get($val->user_id);
                echo '&nbsp;&nbsp;&nbsp;昵称：'.$user->name.'&nbsp;编号：'.$user->id.'<br /><br />';
            }
            echo '<br /><br />';
        }
//        dump($even);
    }
}