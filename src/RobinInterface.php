<?php
/**.-------------------------------------------------------------------------------------------------------------------
 * |  Github: https://github.com/Tinywan
 * |  Blog: http://www.cnblogs.com/Tinywan
 * |--------------------------------------------------------------------------------------------------------------------
 * |  Author: Tinywan(ShaoBo Wan)
 * |  DateTime: 2019/1/15 15:51
 * |  Mail: 756684177@qq.com
 * |  Desc: 调度算法接口
 * '------------------------------------------------------------------------------------------------------------------*/

namespace Robin;

interface RobinInterface
{
    /**
     * 初始化服务权重
     *
     * @param array $services
     */
    public function init(array $services);

    /**
     * 获取一个服务
     *
     * @return string
     */
    public function next();

}
