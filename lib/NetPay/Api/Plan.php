<?php
/**
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * Copyright 2018 NetPay. All rights reserved.
 */

namespace NetPay\Api;

use Exception;
use \NetPay\Config;
use \NetPay\Api\Curl;
use \NetPay\Exceptions\HandlerHTTP;
use \NetPay\Handlers\PlanDataHandler;

class Plan
{
    /**
     * Send a post request to Curl to make the cancelled of an order.
     */
    public static function post($jwt, array $input)
    {
        $fields = PlanDataHandler::prepare($input);

        $fields_string = json_encode($fields);

        $curl_result = Curl::post(Config::CREATE_PLAN, $fields_string, $jwt);
        $result = json_decode($curl_result['result'], true);

        if ($curl_result['code'] != 201) {
            throw HandlerHTTP::errorHandler($result, $curl_result['code']);
        }

        return compact('result');
    }

    /**
     * Send a put request to Curl to make the cancelled of an order.
     */
    public static function put($jwt, array $input, $plan_id)
    {
        $fields = PlanDataHandler::update($input);

        $fields_string = json_encode($fields);

        $curl_result = Curl::put(sprintf(Config::UPDATE_PLAN, $plan_id), $fields_string, $jwt);
        $result = json_decode($curl_result['result'], true);

        if ($curl_result['code'] != 200) {
            throw HandlerHTTP::getError($result);
        }

        return compact('result');
    }

    /**
     * Send a post request to Curl to make the cancelled of an order.
     */
    public static function get($jwt)
    {
        $curl_result = Curl::get(Config::GET_PLANS, $jwt);
        $result = json_decode($curl_result['result'], true);

        if ($curl_result['code'] != 200) {
            throw HandlerHTTP::errorHandler($result, $curl_result['code']);
        }

        return compact('result');
    }

}