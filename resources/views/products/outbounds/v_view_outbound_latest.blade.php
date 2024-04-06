@extends('layouts.default')
@section('title', 'รายการล่าสุด')

@section('content')

<div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
    <div style="height: calc(100vh - 10rem)" class="mt-[5rem] md:mt-0">
        <div class=" w-full h-[3rem] ">
            <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                <a href="{{ url('/product/outbounds') }}">สินค้า > ส่งออก > </a>
                <a href="">&nbsp;รายการล่าสุด</a>
            </div>
        </div>

        <div style="height: calc(100vh - 7.7rem)" class="w-full  mt-2 rounded-md overflow-y-scroll p-2">
            <div class="py-2 w-full sm:rounded-lg">
                <b class="mx-2  mt-2 rounded-md  text-black uppercase text-[1rem]  ">
                    ตารางรายการส่งออกล่าสุด</b>
            </div>
            <div class="relative overflow-x-auto shadow-md rounded-md">
                <table class="w-full text-sm text-left rtl:text-right bg-[#212529] ">
                    <thead class="text-xs text-white uppercase ">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center">
                                ลำดับ
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                หมายเลขรายการส่งออก
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                ผู้ที่สร้าง
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                วันที่สร้าง
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                สถานะ
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lotouts as $index => $LotOut)
                        <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer"
                            onclick="onclick_LotOut_details({{ $LotOut->lot_out_id }})">
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-center">
                                {{ $index + 1 }}
                            </th>

                            <td class="px-6 text-center">
                                {{ $LotOut->lot_out_number }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                {{ $LotOut->users->fname . ' ' . $LotOut->users->lname }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ date('d/m/Y', strtotime($LotOut->created_at)) }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($LotOut->lot_out_status == 'Initialized')
                                <p class="  py-1 text-gray-600">
                                    {{ $LotOut->lot_out_status }}</p>
                                @else
                                <p class=" text-center rounded-3xl py-1 text-red-600 ">
                                    {{ $LotOut }}</p>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-center my-4">
                {{ $lotouts->links('pagination::custom-pagination') }}
            </div>
        </div>
    </div>
</div>
<script>
    const onclick_LotOut_details = (lot_out_id) => {
        const cluster = '{{ env('CLUSTER') }}'
        window.location.href = `${cluster}/product/outbounds/view-outbound-latest/detail/${lot_out_id}`;
    }
</script>
@endsection
