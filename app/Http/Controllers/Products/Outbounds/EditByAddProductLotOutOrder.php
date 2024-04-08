<?php

namespace App\Http\Controllers\Products\Outbounds;

use App\Http\Controllers\Controller;
use App\Models\LotOut;
use App\Models\User;
use App\Models\MasterProduct;
use Database\Seeders\OutboundOrderSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\OutBoundOrder;
use DateTime;
use Illuminate\Support\Facades\Date;

class EditByAddProductLotOutOrder extends Controller
{

    public function add_product_to_lot_out(Request $request)
    {

        try {

            $outbound = OutBoundOrder::create([
                'outbound_amount' => $request->amount_product,
                'outbound_status' => 'Initialized',
                'outbound_exp' => date('Y-m-d H:i:s'), // จะเป็นวันที่และเวลาปัจจุบัน
                'mas_prod_id' => $request->selectedProduct,
                'lot_out_id' => $request->lot_out,
            ]);

            // เมื่อเสร็จสิ้นการเพิ่มสินค้าเข้า Lot Out สามารถส่งข้อมูลการตอบกลับได้
            return response()->json(['success' => true, 'message' => 'Product added to Lot Out successfully'], 200);
        } catch (\Exception $e) {
            // หากเกิดข้อผิดพลาดในการเพิ่มสินค้าเข้า Lot Out
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
