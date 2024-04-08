@extends('layouts.default')
@section('title', 'รายการล่าสุด')

@section('content')

    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="{{ url('/product/inbounds') }}">สินค้า > รับเข้า > </a>
                    <a href="">&nbsp;รายการล่าสุด</a>
                </div>
            </div>
            <div style="height: calc(100vh - 7.7rem)" class="w-full mt-2 rounded-md overflow-y-scroll p-2">


                {{-- table product --}}
                <div class="w-full bg-black/20 mt-2 rounded-md">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right ">
                            <thead class="text-xs text-white uppercase bg-[#212529]">
                                <tr>
                                    <div class=" gap-2 my-2 mx-3">
                                        <b class=" text-[1rem]">ตารางรายการรับเข้าล่าสุด</b>
                                    </div>
                                </tr>
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        ลำดับ
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        หมายเลขล็อต
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        วันรับเข้า
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        สถานะ
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lot_in_products as $index => $lot_in)
                                    <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer"
                                        onclick="onclick_inbound_lastest_detail_details({{ $lot_in->lot_in_id }})">
                                        <th scope="row" class="text-center px-6 py-4 font-medium whitespace-nowrap">
                                            {{ $index + 1 }}
                                        </th>
                                        <td class="px-6 py-4 text-center">
                                            {{ $lot_in->lot_in_number }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ date('d/m/Y', strtotime($lot_in->created_at)) }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if ($lot_in->lot_in_status == 'Initialized')
                                                <p class=" text-gray-600"> รอดำเนินการ </p>
                                            @else
                                                <p class=" text-red-600"> ปิดล็อต </p>
                                            @endif
                                        </td>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex justify-center my-4">
                    {{ $lot_in_products->links('pagination::custom-pagination') }}
                </div>
            </div>
        </div>
    </div>
    <script>
        const onclick_inbound_lastest_detail_details = (lot_in_id) => {
            const cluster = '{{ env('CLUSTER') }}'
            window.location.href = `${cluster}/product/inbounds/view-inbound-latest/detail/${lot_in_id}`;
        }
    </script>
@endsection
