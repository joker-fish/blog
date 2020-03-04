<?php

namespace app\frontend\controller;

use think\Db;

class Index extends Frontend
{

    public function index()
    {
        $data = $this->Artice->where(function($query){
            if (!empty(input('class_id'))){
                $query->where('class_id', input('class_id'));
            }
            if (!empty(input('search'))){
                $query->where('title', 'like', '%'.input('search').'%')->whereOr('content', 'like', '%'.input('search').'%');
            }
        })->order('create_time desc')->paginate(13);
        $this->assign('data', $data);
        return $this->fetch();
    }
    public function detalis()
    {
        $this->Artice->where('id', input('id'))->setInc('read', 1);
        $data = $this->Artice->with('classify')->where('id', input('id'))->find();
        $next = $this->Artice->order('create_time desc')->where('create_time', '<', $data->create_time)->find();
        $prev = $this->Artice->order('create_time desc')->where('create_time', '>', $data->create_time)->find();
        $this->assign('next', isset($next->id)?$next->toArray():NULL);
        $this->assign('prev', isset($prev->id)?$prev->toArray():NULL);
        $this->assign('data', $data);

        $comment = $this->Comment->order('create_time desc')->where('artice_id', input('id'))->select();
        $this->assign('comment', $comment);
        $this->assign('comment_count', count($comment));
        return $this->fetch();
    }
    public function click()
    {
        $click = Db::name('click_ip')->where(['artice_id'=>input('id'), 'ip'=>$_SERVER['REMOTE_ADDR']])->find();
        if (!empty($click)){
            return ['code'=>101, 'msg'=>'谢谢你哦！可是这篇文章你已经点过赞了呢，去看看其他文章吧'];
        }
        Db::name('click_ip')->insert(['ip'=>$_SERVER['REMOTE_ADDR'], 'artice_id'=>input('id')]);
        $this->Artice->where('id', input('id'))->setInc('click', 1);
        return ['code'=>200, 'msg'=>'谢谢大大的点赞哦！'];
    }
    public function addcomment()
    {
        $data = [
            'name' => htmlspecialchars(input('username')),
            'content' => htmlspecialchars(input('content')),
            'ip' => $_SERVER['REMOTE_ADDR'],
            'create_time' => time(),
            'avatar' => '/avatar/'.rand(1, 126).'.jpg',
            'artice_id' => input('id')
        ];
        $ip = Db::name('disip')->column('ip');
        if (in_array($data['ip'], $ip)){
            $this->success('你ip都被封了，煞笔');
        }
        $comment = $this->Comment->get(['ip'=>$data['ip']]);
        if (isset($comment->id)){
            $data['name'] = $comment->name;
            $data['avatar'] = $comment->avatar;
        }
        $this->Comment->save($data);
        $this->redirect('/articeinfo.html?id='.$data['artice_id']);
    }
}