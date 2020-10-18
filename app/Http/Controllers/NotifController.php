<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class NotifController extends Controller
{

    public function f()
    {
        \DB::table('factors')
            ->update([
                'status' => 0,
                'end' => null,
            ]);

    }

    public function tttt()
    {
        $result_array = array();
        $invoice_product_array = array();
        $scheduling_array = array();
        $result = \DB::table('invoices')
            ->where('date', '<', "1399/05/01")
            ->get();
        foreach ($result as $item) {
            $result_array[] = $item->id;
        }

        $invoice_product = \DB::table('invoice_product')
            ->whereIn('invoice_id', $result_array)
            ->get();
        foreach ($invoice_product as $invoice_item) {
            $invoice_product_array[] = $invoice_item->id;
        }
        $schedulings = \DB::table('schedulings')
            ->whereIn('detail_id', $invoice_product_array)
            ->get();
        foreach ($schedulings as $scheduling) {
            $scheduling_array[] = $scheduling->pack;
        }

        dd($scheduling_array);
    }

    public function toChatAPI()
    {
        $data = [
            'phone' => '989199621504', // Receivers phone
            'body' => 'Laravel', // Message
        ];
        $json = json_encode($data); // Encode data to JSON
        $url = 'https://eu105.chat-api.com/instance127679/sendMessage?token=sayx3n8u4b4klakp';
        $options = stream_context_create(['http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/json',
            'content' => $json
        ]
        ]);
        $result = file_get_contents($url, false, $options);
        return $result;
    }
}
