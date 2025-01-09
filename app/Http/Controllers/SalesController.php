<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function sales(){
        $url = 'http://89.108.115.241:6969/api/sales?dateFrom=2025-01-01&dateTo=2025-01-09&page=7&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie&limit=500';

        $response = Http::get($url);
        $data = $response->json();

        foreach ($data['data'] as $item) {
            DB::table('sales')->insert([
                'g_number' => $item['g_number'],
                'date' => $item['date'],
                'last_change_date' => $item['last_change_date'],
                'supplier_article' => $item['supplier_article'],
                'tech_size' => $item['tech_size'],
                'barcode' => $item['barcode'],
                'total_price' => $item['total_price'],
                'discount_percent' => $item['discount_percent'],
                'is_supply' => $item['is_supply'],
                'is_realization' => $item['is_realization'],
                'promo_code_discount' => $item['promo_code_discount'],
                'warehouse_name' => $item['warehouse_name'],
                'country_name' => $item['country_name'],
                'oblast_okrug_name' => $item['oblast_okrug_name'],
                'region_name' => $item['region_name'],
                'income_id' => $item['income_id'],
                'sale_id' => $item['sale_id'],
                'odid' => $item['odid'],
                'spp' => $item['spp'],
                'for_pay' => $item['for_pay'],
                'finished_price' => $item['finished_price'],
                'price_with_disc' => $item['price_with_disc'],
                'nm_id' => $item['nm_id'],
                'subject' => $item['subject'],
                'category' => $item['category'],
                'brand' => $item['brand'],
                'is_storno' => $item['is_storno']
            ]);
        }

        return response()->json([
            'message' => 'Data saved successfully!'
        ]);
    }

    public function sales_pagination(){
        $url = 'http://89.108.115.241:6969/api/sales?dateFrom=2025-01-01&dateTo=2025-01-09&page=1&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie&limit=500';

        $response = Http::get($url);
        $data = $response->json();

        $paginationData = $data['meta'];


        $paginationId = DB::table('sales_pagination')->insertGetId([
            'current_page' => $paginationData['current_page'],
            'last_page' => $paginationData['last_page'],
            'from' => $paginationData['from'],
            'to' => $paginationData['to'],
            'total' => $paginationData['total'],
            'per_page' => $paginationData['per_page'],
            'path' => $paginationData['path'],

        ]);

        foreach ($paginationData['links'] as $link) {
            DB::table('sales_pagination_links')->insert([
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
