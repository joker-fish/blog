<?php

namespace app\frontend\controller;

class Diary extends Frontend
{
    public function _initialize()
    {

    }
    public function index()
    {
        $data = $this->Diary->paginate(4)->each(function($value, $k){
            $value->images = explode(',', $value->image);
        });
        $this->assign('data', $data);
        return $this->fetch();
    }
    public function detalis()
    {
        return $this->fetch();
    }
}