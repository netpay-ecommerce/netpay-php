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

namespace NetPay;

class Config
{
    //-- Account settings
    public static $API_URL;
    public static $USER_NAME;
    public static $PASS;
    public static $STORE_ID_ACQ;

    //-- General settings
    public static $CURLOPT_TIMEOUT; //Timeout in seconds

    public static $AUTH_LOGIN_URL;
    public static $CHECKOUT_URL;
    public static $TRANSACTION_URL;
    public static $CANCELLED_URL;
    public static $CHARGE_URL;
    public static $CREATE_API_KEY;
    public static $CREATE_TOKEN_CARD;
    public static $CUSTOMER_CARDS;
    public static $RISK_MANAGER;
    public static $DELETE_TOKEN_CARD;
    public static $CREATE_PLAN;
    public static $ADD_SUBSCRIPTION;
    public static $ADD_CLIENT;
    public static $ADD_WEBHOOK;
    public static $UPDATE_PLAN;
    public static $STOP_PLAN;
    public static $GET_PLANS;
    public static $GET_PLAN;
    public static $GET_SUBSCRIPTIONS;
    public static $GET_SUBSCRIPTION;
    public static $STOP_SUBSCRIPTION;
    public static $UPDATE_CLIENT;
    public static $GET_CLIENTS;
    public static $GET_CLIENT;
    public static $UPDATE_WEBHOOK;
    public static $URL_PORT = null;
    public static $CARD_TYPES = [];

    public static function init() {
        self::$API_URL = "https://ecommerce.netpay.com.mx/gateway-ecommerce";
        self::$USER_NAME = 'ecommerce@netpay.com.mx';
        self::$PASS = 'ec0m12';
        self::$STORE_ID_ACQ = '483131';

        //-- General settings
        self::$CURLOPT_TIMEOUT = 40; //Timeout in seconds
    
        self::$AUTH_LOGIN_URL = self::$API_URL . "/v1/auth/login";
        self::$CHECKOUT_URL = self::$API_URL."/v2/checkout";
        self::$TRANSACTION_URL = self::$API_URL."/v1/transaction-report/transaction/%s/%s";
        self::$CANCELLED_URL = self::$API_URL."/v1/transaction/refund";
        self::$CHARGE_URL = self::$API_URL."/v1/transaction/charge";
        self::$CREATE_API_KEY = self::$API_URL."/v1/store/store-api-key";
        self::$CREATE_TOKEN_CARD = self::$API_URL."/v1/token-card";
        self::$CUSTOMER_CARDS = self::$API_URL."/v1/token-card/customer-tokens";
        self::$RISK_MANAGER = self::$API_URL."/v1/risk-manager/token-card";
        self::$DELETE_TOKEN_CARD = self::$API_URL."/v1/token-card/delete";
        self::$CREATE_PLAN = self::$API_URL."/v1/store/plans";
        self::$ADD_SUBSCRIPTION = self::$API_URL."/v1/store/subscriptions";
        self::$ADD_CLIENT = self::$API_URL."/v1/store/clients";
        self::$ADD_WEBHOOK = self::$API_URL."/v1/store/webhooks";
        self::$UPDATE_PLAN = self::$API_URL."/v1/store/plans/%s";
        self::$STOP_PLAN = self::$API_URL."/v1/store/plans/%s/%s";
        self::$GET_PLANS = self::$API_URL."/v1/store/plans";
        self::$GET_PLAN = self::$API_URL."/v1/store/plans/%s";
        self::$GET_SUBSCRIPTIONS = self::$API_URL."/v1/store/subscriptions";
        self::$GET_SUBSCRIPTION = self::$API_URL."/v1/store/subscriptions/%s";
        self::$STOP_SUBSCRIPTION = self::$API_URL."/v1/store/subscriptions/%s/pause";
        self::$UPDATE_CLIENT = self::$API_URL."/v1/store/clients";
        self::$GET_CLIENTS = self::$API_URL."/v1/store/clients";
        self::$GET_CLIENT = self::$API_URL."/v1/store/clients/%s";
        self::$UPDATE_WEBHOOK = self::$API_URL."/v1/store/webhooks/%s";
        self::$URL_PORT = null;
        self::$CARD_TYPES = array(
            '001' => 'Visa',
            '002' => 'MasterCard',
            '003' => 'American Express',
        );
    }

}
