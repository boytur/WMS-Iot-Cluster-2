<?php

namespace App\Http\Controllers\Products\Inbounds;

use App\Http\Controllers\Controller;
use App\Models\LotOut;
use App\Models\User;
use App\Models\MasterProduct;
use App\Models\InboundOrder;
use Database\Seeders\OutboundOrderSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\OutBoundOrder;
use DateTime;
use Illuminate\Support\Facades\Date;

class EditByAddProductLotInOrder extends Controller
{


    public function add_product_to_lot_in(Request $request)
    {

        try {
            $inbound = InboundOrder::create([
                'inbound_amount' => $request->amount_product,
                'inbound_status' => 'Initialized',
                'inbound_exp' => date('Y-m-d H:i:s'), // จะเป็นวันที่และเวลาปัจจุบัน
                'mas_prod_id' => $request->selectedProduct,
                'lot_in_id' => $request->lot_in,
            ]);

            // เมื่อเสร็จสิ้นการเพิ่มสินค้าเข้า Lot in สามารถส่งข้อมูลการตอบกลับได้
            return response()->json(['success' => true, 'message' => 'Product added to Lot In successfully'], 200);
        } catch (\Exception $e) {
            // หากเกิดข้อผิดพลาดในการเพิ่มสินค้าเข้า Lot Out
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
