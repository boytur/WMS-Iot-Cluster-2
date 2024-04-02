@extends('layouts.default')

@section('title', 'ดูคลังสินค้าอื่น')
@section('content')

    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="">แดชบอร์ด > ดูคลังสินค้าอื่น</a>
                </div>
            </div>
            <div class="w-full p-2">
                <div style="height: calc(100vh - 7.7rem)" class="rounded-sm  bg-white overflow-y-scroll">
                    {{-- table product --}}
                    <div class="w-full mt-2 rounded-t-md">
                        <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                            <b class="mx-2  mt-2 text-lg text-black uppercase   ">
                                ตารางรายการสินค้าในระบบ</b>
                            </div>
                            <table class="w-full text-sm text-left rtl:text-right ">
                                <thead class="text-xs text-white uppercase bg-[#212529]">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            ลำดับ
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            ชื่อสินค้า
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            ตำแหน่ง
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($warehouses as $index => $warehouse)
                                        <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer"
                                            onclick="onclick_product_details('/product/managements/detail/{{ $warehouse->wh_id }}')">
                                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                                {{ $index + 1 }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $warehouse->wh_name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $warehouse->wh_location }}
                                            </td>
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="flex justify-center my-4">
                            {{ $warehouses->links('pagination::custom-pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
