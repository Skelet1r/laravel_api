<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
    public function warehouses(Request $request){

        $url = 'http://89.108.115.241:6969/api/stocks?dateFrom=2024-12-17&dateTo=&page=9&limit=100&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie';

        $response = Http::get($url);
        $data = $response->json();

        foreach ($data['data'] as $item){
            DB::table('warehouses')->insert([
                'date' => $item['date'],
                'last_change_date' => $item['last_change_date'],
                'supplier_article' => $item['supplier_article'],
                'tech_size' => $item['tech_size'],
                'barcode' => $item['barcode'],
                'quantity' => $item['quantity'],
                'is_supply' => $item['is_supply'],
                'is_realization' => $item['is_realization'],
                'quantity_full' => $item['quantity_full'],
                'warehouse_name' => $item['warehouse_name'],
                'in_way_to_client' => $item['in_way_to_client'],
                'in_way_from_client' => $item['in_way_from_client'],
                'nm_id' => $item['nm_id'],
                'subject' => $item['subject'],
                'category' => $item['category'],
                'brand' => $item['brand'],
                'sc_code' => $item['sc_code'],
                'price' => $item['price'],
                'discount' => $item['discount']
            ]);
        }

        return response()->json([
            'message' => 'Data saved successfully!'
        ]);
    }
}