@extends('layouts.default')
@section('title', 'รายละเอียดสินค้าเข้าล่าสุด')

@section('content')

    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0 ">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="{{ url('/product/inbounds') }}">สินค้า > รับเข้า ></a>
                    <a href="{{ url('/product/inbounds/view-inbound-latest') }}">&nbsp;รายการล่าสุด > </a>
                    <a href="">&nbsp;รายละเอียด</a>
                </div>
            </div>

            {{-- <div class="w-full p-2">
            <h1>รายละเอียดสินค้าเข้า</h1>
            <p>{{ $InboundOrder->lot_in_number }}</p>
            </p>
        </div> --}}

        <div class=" mt-1 rounded-t-md mx-2">
            <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                <b class="mx-2  mt-2 text-lg text-black   ">
                    รายละเอียด</b>
            </div>
            <div class="relative overflow-x-auto shadow-md">
                <p class="mx-2  mt-2"></p>
                <p class="mx-2  mt-1">
                    <b>วันที่เพิ่ม: </b>
                    {{ date('d/m/Y', strtotime($lot_in->created_at)) }}
                </p>
                <p class="mx-2  mt-1">
                    <b>เพิ่มโดย: </b>
                    {{ $lot_in->users->fname . ' ' . $lot_in->users->lname }}

                </p>
                <p class="mx-2  mt-1">
                    <b>หมายเลขล็อต: </b>
                    {{ $lot_in->lot_in_number }}

                </p>
                <p class="mx-2  mt-2"></p>
            </div>
        </div>

            <div class=" mt-2 rounded-t-md mx-3">
                <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                    <b class="mx-2  mt-2 text-lg text-black   ">
                        ตารางรายการสินค้า</b>
                </div>
                <div class="relative overflow-x-auto shadow-md">
                    <table class="w-full text-sm text-left rtl:text-right ">
                        <thead class="text-xs text-white inbound_prod bg-[#000000]">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">
                                    ลำดับ
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    รูปภาพ
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    ชื่อ
                                </th>

                                <th scope="col" class="px-6 py-3 text-center">
                                    บาร์โคด
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    จำนวน
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    ประเภท
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    วันหมดอายุ
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    สถานะ
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($inbound_prod as $index => $InboundOrder)
                                <tr class="bg-white border-b ">

                                    <td class="text-center px-6 py-4 font-medium whitespace-nowrap">
                                        {{ ($index)+ 1 }}
                                    </td>

                                    <td class="text-center px-6 py-4 w-20">
                                        <img src="{{ $InboundOrder->master_products->mas_prod_image }}" alt="">
                                    </td>

                                    <td class="text-center px-6 py-4">
                                        {{ $InboundOrder->master_products->categories->cat_name }}
                                    </td>

                                    <td class="text-center px-6 py-4">
                                        {{ $InboundOrder->master_products->mas_prod_barcode }}
                                    </td>

                                    <td class="text-center px-6 py-4">
                                        {{ $InboundOrder->inbound_amount }}
                                    </td>
                                    <td class="text-center px-6 py-4">
                                        {{ $InboundOrder->master_products->categories->cat_name }}
                                    </td>
                                    <td class=" text-center px-6 py-4">
                                        {{ date('d/m/Y', strtotime($InboundOrder->inbound_exp)) }}
                                    </td>

                                    <td class="text-center px-6 py-4 flex gap-3 text-gray-500 justify-center">
                                        @if ($InboundOrder->inbound_status == 'Initialized')
                                        <button class="bg-green-700 text-white font-bold py-2 px-5 rounded-full ">จัดเก็บ</button>
                                        @else
                                        <button class="bg-red-700 text-white font-bold py-2 px-5 rounded-full ">จัดเก็บไม่สำเร็จ</button>
                                        @endif
                                    </td>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                <div class="flex justify-center my-4">
                    {{ $inbound_prod->links('pagination::custom-pagination') }}
                </div>
            </div>


        </div>
    </div>

@endsection
