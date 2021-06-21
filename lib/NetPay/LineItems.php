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

class LineItems {
    /**
     * Prepares the item list information of a order for being send to the checkout.
     */
    public static function format($items)
    {
        $item_list = [];

        foreach ($items as $item_data) {
            $item_list[] = [
                "name" => $item_data['name'],
                "amount" => $item_data['amount'],
                "quantity" => $item_data['quantity'],
                "currency" => $item_data['currency'],
            ];
        }

        return $item_list;
    }
}