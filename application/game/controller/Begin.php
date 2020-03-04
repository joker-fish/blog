<?php

namespace app\game\controller;

use app\common\model\GameAction;
use app\common\model\GameActionUse;
use app\common\model\GameUser;
use think\Controller;
use think\Db;

class Begin extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    public function add()
    {
        if (empty(input('name'))){
            return $this->error('请填写姓名');
        }
        $model = new GameUser;
        $user = $model->get(['name'=>input('name')]);
        if (isset($user->id)){
            $model->save(['status'=>1], ['id'=>$user->id]);
            return input('name').'：'.$user->id;
        }
        $model->save(['create_time'=>date('Y-m-d H:i:s'), 'name'=>input('name'), 'status'=>1]);
        return input('name').'：'.$model->id;
    }
    public function action()
    {
        return $this->fetch();
    }
    public function useAction()
    {
        $num = input('num');
        $actionUseModel = new GameActionUse;
        $actionModel = new GameAction;

        for ($i=1; $i<=$num; $i++){
            $actionUseId = $actionUseModel->column('id');
            $actionId = $actionModel->whereNotIn('id', $actionUseId)->column('id');
            $key = array_rand($actionId, 1);
            Db::name('game_action_use')->insert(['id'=>$actionId[$key]]);
        }
        return '添加完成';
    }
}