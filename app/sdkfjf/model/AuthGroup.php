<?php
namespace app\sdkfjf\model;
use think\Model;
class AuthGroup extends Model
{
    protected $type       = [
        // 设置addtime为时间戳类型（整型）
        'addtime' => 'timestamp:Y-m-d H:i:s',
    ];
}