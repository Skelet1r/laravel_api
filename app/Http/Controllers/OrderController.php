<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function orders(){
        $url = 'http://89.108.115.241:6969/api/orders?dateFrom=2024-11-01&dateTo=2024-11-15&page=10&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie&limit=500';

        $response = Http::get($url);
        $data = $response->json();

        foreach ($data['data'] as $item){
            DB::table('orders')->insert([
                'g_number' => $item['g_number'],
                'date' => $item['date'],
                'last_change_date' => $item['last_change_date'],
                'supplier_article' => $item['supplier_article'],
                'tech_size' => $item['tech_size'],
                'barcode' => $item['barcode'],
                'total_price' => $item['total_price'],
                'discount_percent' => $item['discount_percent'],
                'warehouse_name' => $item['warehouse_name'],
                'oblast' => $item['oblast'],
                'income_id' => $item['income_id'],
                'odid' => $item['odid'],
                'nm_id' => $item['nm_id'],
                'subject' => $item['subject'],
                'category' => $item['category'],
                'brand' => $item['brand'],
                'is_cancel' => $item['is_cancel'],
                'cancel_dt' => $item['cancel_dt']
            ]);
        }

        return response()->json([
            'message' => 'Data saved successfully!'
        ]);
    }

    public function orders_pagination(){
        $url = 'http://89.108.115.241:6969/api/orders?dateFrom=2024-11-01&dateTo=2024-11-15&page=10&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie&limit=500';

        $response = Http::get($url);
        $data = $response->json();


        $paginationData = $data['meta'];

        $paginationId = DB::table('orders_pagination')->insertGetId([
            'current_page' => $paginationData['current_page'],
            'last_page' => $paginationData['last_page'],
            'from' => $paginationData['from'],
            'to' => $paginationData['to'],
            'total' => $paginationData['total'],
            'per_page' => $paginationData['per_page'],
            'path' => $paginationData['path'],

        ]);

        foreach ($paginationData['links'] as $link) {
            DB::table('orders_pagination_links')->insert([
                'url' => $link['url'],
                'label' => $link['label'],
                'active' => $link['active'],
                'pagination_id' => $paginationId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return response()->json([
            'message' => 'Data saved successfully!'
        ]);
    }
}
