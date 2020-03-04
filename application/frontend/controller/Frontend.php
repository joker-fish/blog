<?php

namespace app\frontend\controller;

use think\Controller;

class Frontend extends Controller
{
    protected $Classify = null;
    protected $About = null;
    protected $Artice = null;
    protected $Message = null;
    protected $Ip = null;
    protected $Comment = null;
    protected $Link = null;
    protected $Diary = null;

    public function _initialize()
    {
        parent::_initialize();

        $this->Classify = new \app\admin\model\Classify;
        $this->About = new \app\admin\model\About\Erwei;
        $this->Artice = new \app\admin\model\Artice;
        $this->Message = new \app\admin\model\Message;
        $this->Ip = new \app\admin\model\Disip;
        $this->Comment = new \app\admin\model\Comment;
        $this->Link = new \app\admin\model\Link;
        $this->Diary = new \app\admin\model\Diary;

//        分类
        $this->assign('classify', $this->Classify->withCount('artice')->select());
//        个人介绍
        $this->assign('about', $this->About->select());
//        友情链接
        $this->assign('link', $this->Link->all());
    }
}