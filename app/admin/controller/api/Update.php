<?php

// +----------------------------------------------------------------------
// | ThinkAdmin
// +----------------------------------------------------------------------
// | 版权所有 2014~2019 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: http://demo.thinkadmin.top
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | gitee 代码仓库：https://gitee.com/zoujingli/ThinkAdmin
// | github 代码仓库：https://github.com/zoujingli/ThinkAdmin
// +----------------------------------------------------------------------

namespace app\admin\controller\api;

use think\admin\Controller;
use think\admin\service\InstallService;

/**
 * 安装服务端支持
 * Class Update
 * @package app\admin\controller\api
 */
class Update extends Controller
{
    /**
     * 获取文件列表
     */
    public function tree()
    {
        $this->rules = unserialize($this->request->post('rules', 'a:0:{}', ''));
        $this->ignore = unserialize($this->request->post('ignore', 'a:0:{}', ''));
        $this->success('获取文件列表成功！', InstallService::instance($this->app)->getList($this->rules, $this->ignore));
    }

    /**
     * 读取线上文件数据
     */
    public function get()
    {
        $this->file = $this->app->getRootPath() . decode(input('encode', '0'));
        file_exists($this->file) ? $this->success('读取文件成功！', [
            'content' => base64_encode(file_get_contents($this->file)),
        ]) : $this->error('读取文件内容失败！');
    }

}
