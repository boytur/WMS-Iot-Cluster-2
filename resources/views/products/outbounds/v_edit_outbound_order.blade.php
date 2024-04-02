@extends('layouts.default')
@section('title', 'แก้ไขรายการสินค้าออก')

@section('content')
    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="{{ url('/product/outbounds') }}">สินค้า > ส่งออก > </a>
                    <a href="">&nbsp;แก้ไขรายการสินค้าออก</a>
                </div>
            </div>
        </div>
        <div style="height: calc(100vh - 8rem)" class="bg-[#F6F9FC] overflow-y-scroll flex flex-col w-full">
            <div class="flex justify-end">
                <div class=" lg:pt-0">
                    <a class="btn-primary px-4 flex items-center h-[3rem] gap-1"
                        href="{{ url('product/inbounds/create-inbound-order') }}">
                        <div>
                            <div class="flex items-center gap-1">
                                <i class="fa-solid fa-circle-plus text-[0.8rem] "></i>
                                <div>
                                    <p class="lg:text-sm lg:block hidden">เพิ่มสินค้า</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="w-full mt-1 rounded-t-md mx-3">
                <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                    <b class="mx-2  mt-2 text-lg text-black   ">
                        รายละเอียด</b>
                </div>
                <div class="relative overflow-x-auto shadow-md">
                    <p class="mx-2  mt-2"></p>
                    <p class="mx-2  mt-1">
                        <b>วันที่เพิ่ม: </b>
                        {{ date('d/m/Y', strtotime($lot_out->created_at)) }}
                    </p>
                    <p class="mx-2  mt-1">
                        <b>เพิ่มโดย: </b>
                        {{ $lot_out->users->fname . ' ' . $lot_out->users->lname }}

                    </p>
                    <p class="mx-2  mt-1">
                        <b>หมายเลขล็อต: </b>
                        {{ $lot_out->lot_out_number }}

                    </p>
                    <p class="mx-2  mt-2"></p>
                </div>
            </div>

            <div class="w-full mt-2 rounded-t-md mx-3">
                <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                    <b class="mx-2  mt-2 text-lg text-black   ">
                        ตารางรายการสินค้า</b>
                </div>
                <div class="relative overflow-x-auto shadow-md">
                    <table class="w-full text-sm text-left rtl:text-right ">
                        <thead class="text-xs text-white uppercase bg-[#000000]">
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
                                    ประเภท
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    จำนวน
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    การกระทำ
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lot_out_prod as $index => $OutBoundOrder)
                                <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">

                                    <td class="px-6 py-4 font-medium whitespace-nowrap">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $OutBoundOrder->master_products->mas_prod_image }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $OutBoundOrder->master_products->mas_prod_name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $OutBoundOrder->master_products->mas_prod_barcode }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{-- {{ $OutBoundOrder->master_products->cat_id }} --}}
                                        {{ $OutBoundOrder->master_products->categories->cat_name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $OutBoundOrder->outbound_amount }}
                                    </td>

                                    <td class="px-6 py-4 flex gap-3 text-gray-500 justify-center">
                                        <a>
                                            <i
                                                class="fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105"></i></a>
                                        |

                                        <i
                                            class="fa-solid fa-trash-can text-[1.5rem] hover:text-red-500 hover:scale-105"></i></a>
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex justify-center my-4">
                {{ $lot_out_prod->links('pagination::custom-pagination') }}
            </div>
        </div>

    </div>
@endsection
