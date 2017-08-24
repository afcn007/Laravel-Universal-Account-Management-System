<?php
namespace App\Http\Controllers\Common;

use App\Region;
use Request;
use Response;

trait RegionController
{

    /**
     * 返回省份列表
     * @return array|mixed
     */
    protected function getRegionProvinces()
    {
        $result = (new Region)->getProvinces();
        view()->share('provinces', $result);
        return $result;
    }

    public function getRegion()
    {
        $type = intval(Request::get('type', 0));
        $pid = intval(Request::get('pid', 0));
        if ($pid <= 0) {
            return Response::json(array(
                'status' => -1,
                'error' => 'param pid is not found'
            ));
        }
        return Response::json(array(
            'status' => 0,
            'list' => (new Region())->getByPid($pid, $type)
        ));

    }
}
