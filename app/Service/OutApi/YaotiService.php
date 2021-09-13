<?php


namespace App\Service\OutApi;


use App\CacheKey\SystemCache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class YaotiService
{
    const FIVE_POLT = 'five_polt'; // 五策
    const NEW_2021 = 'new_2021'; // 2021公考上岸养成计划

    const API_YAOTI = [
        'dev' => 'http://gk.buzhi.com',
        'production' => 'http://gk.buzhi.com',
    ];

    protected const REQUEST_URL = [
        'five_polt' => '/Api/OpenApi/getWxRobot',
        'new_2021' => '/Api/OpenApi/getNewWxRobot',
    ];

    public static function getWxRobot(string $type): array
    {
        try {
            $uri = self::API_YAOTI[cur_env()] . self::REQUEST_URL[$type];
            $data = cache_remember(SystemCache::YAOTI_WX_ROBOT, function () use ($uri){
                $resp = Http::get($uri);
                $response = json_decode($resp, true);
                if ($response['status'] == 200){
                    $robots = array_keys($response['data']);
                    $robots = array_filter($robots);
                    $robots = array_values($robots);
                    return $robots;
                }
            });
            return !is_null($data) ? $data : [];
        }catch (\Exception $e){
            Log::channel('error')->info($e->getMessage());
            return [];
        }
    }

    public static function queryYaotiUserGroup($phone)
    {
        try{
            $uri = self::API_YAOTI[cur_env()] . "/Api/OpenApi/getWcQunId?phone={$phone}";
            $data = cache_remember(sprintf(SystemCache::YAOTI_USER_GROUP, $phone),
                function () use ($uri){
                    $resp = Http::get($uri);
                    if ($resp['status'] == 200){
                        return $resp['data'];
                    }
                    throw new \Exception(sprintf("[phone_query_fail] %s %s", $uri, json_encode($resp)));
                },
            86400);
            return self::isValidGroup($data) ? $data : 0;
        }catch(\Exception $e){
            Log::channel('error')->info($e->getMessage());
            return 0;
        }
    }

    private static function isValidGroup($yaoti_group_id)
    {
        return $yaoti_group_id >= 73;
    }
}
