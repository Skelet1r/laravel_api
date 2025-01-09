<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class IncomesController extends Controller
{
    public function incomes(){
        $url = 'http://89.108.115.241:6969/api/incomes?dateFrom=2025-01-01&dateTo=2025-01-09&page=1&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie&limit=500';

        $response = Http::get($url);
        $data = $response->json();

        foreach ($data['data'] as $item){
            DB::table('incomes')->insert([
                'income_id' => $item['income_id'],
                'number' => $item['number'],
                'date' => $item['date'],
                'last_change_date' => $item['last_change_date'],
                'supplier_article' => $item['supplier_article'],
                'tech_size' => $item['tech_size'],
                'barcode' => $item['barcode'],
                'quantity' => $item['quantity'],
                'total_price' => $item['total_price'],
                'date_close' => $item['date_close'],
                'warehouse_name' => $item['warehouse_name'],
                'nm_id' => $item['nm_id']
            ]);
        }

        return response()->json([
            'message' => 'Data saved successfully!'
        ]);
    }

    public function incomes_pagination(){
        $url = 'http://89.108.115.241:6969/api/incomes?dateFrom=2025-01-01&dateTo=2025-01-09&page=1&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie&limit=500';

        $response = Http::get($url);
        $data = $response->json();

        $paginationData = $data['meta'];

        $paginationId = DB::table('incomes_pagination')->insertGetId([
            'current_page' => $paginationData['current_page'],
            'last_page' => $paginationData['last_page'],
            'from' => $paginationData['from'],
            'to' => $paginationData['to'],
            'total' => $paginationData['total'],
            'per_page' => $paginationData['per_page'],
            'path' => $paginationData['path'],

        ]);

        foreach ($paginationData['links'] as $link) {
            DB::table('incomes_pagination_links')->insert([
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
