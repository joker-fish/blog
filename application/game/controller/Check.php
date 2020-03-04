<?php

namespace app\game\controller;

use app\common\model\GameActionToUser;
use app\common\model\GameActionUse;
use think\Controller;

class Check extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    public function add()
    {
        $actionUseModel = new GameActionToUser();
        $even = $actionUseModel->get(['user_id'=>input('num1')]);
        $arrId = $actionUseModel->where(['action_id'=>$even->action_id])->column('user_id');
        if (in_array(input('num'), $arrId)){
            return '是队友';
        }
        return '不是';
    }
}