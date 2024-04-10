@extends('layouts.default')
@section('title', 'แก้ไขรายการสินค้าออก')

@section('content')

    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem]">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="{{ url('/product/outbounds') }}">สินค้า > ส่งออก > </a>
                    <a href="">&nbsp;รายละเอียดรายการสินค้าส่งออก</a>
                </div>
            </div>
            <div class="w-full p-2">
                <div style="height: calc(100vh - 7.7rem)" class="bg-[#F6F9FC] flex flex-col overflow-y-scroll">
                    <div class="w-full-1 bg-black/20 mt-2 mx-2 rounded-md ">
                        <div class="py-2 w-full bg-[#D9D9D9] rounded-t-lg ">
                            <b class=" bg mx-2  mt-2 rounded-md text-black text-lg" id="lot_out_detail">
                                รายละเอียดรายการส่งออก</b>
                        </div>
                        <div class="w-full">
                            <div class="w-full  bg-white">
                                <div class="w-full flex">
                                    <div class="gap-2 py-3 px-6 ">
                                        <div>
                                            <p><b>ผู้ที่สร้าง :&nbsp;</b>{{ $user }}</p>
                                        </div>
                                        <div>
                                            <p><b>วันที่สร้าง
                                                    :&nbsp;</b>{{ date('d/m/Y', strtotime($lot_out->created_at)) }}
                                            </p>
                                        </div>
                                        <div>
                                            <p><b>หมายเลขใบสั่งซื้อ :&nbsp;</b>{{ $lot_out->lot_out_number }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- แสดงตาราง --}}
                    <div class="w-full-1  mt-2 mx-2 rounded-md">
                        <div class="py-2 w-full bg-[#D9D9D9] rounded-t-lg">
                            <b class=" bg mx-2  mt-2 rounded-md text-black text-lg" id="lot_out_count">
                                ตารางรายการสินค้า</b>
                        </div>
                        <div class="relative overflow-x-auto shadow-md bg-white">
                            <table class="w-full text-sm text-left rtl:text-right">
                                <thead class="text-xs text-white uppercase bg-[#212529]">
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
                                            คลัง
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            พื้นที่
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            สถานะ
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white" id="">
                                    @foreach ($outbound_details as $index => $outbound_detail)
                                        <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">
                                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                                {{ $index + 1 }}
                                            </th>

                                            <td class="px-6 py-4 flex justify-center">
                                                <div class=" w-[3rem] h-[2rem] border">
                                                    <img class="object-cover w-full h-full"
                                                        src="{{ $outbound_detail->master_products->mas_prod_image }}"
                                                        alt="">
                                                </div>
                                            </td>


                                            <td class="px-6 py-4 text-center">
                                                น้ำตาลถุง
                                            </td>

                                            <td class="px-6 py-4 text-center">
                                                123456789
                                            </td>

                                            <td class="px-6 py-4 text-center">
                                                5
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $outbound_detail->master_products->categories->cat_name }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                A{{ $index }}-1
                                            </td>

                                            <td class="px-6 py-4 text-center">
                                                wh-1
                                            </td>

                                            <td class="px-6 py-4 text-center">
                                                <div>
                                                    <p class="border text-center bg-[#AB7408] rounded-3xl py-1 text-white">
                                                        กำลังขนส่ง
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="flex justify-center my-4">
                            {{ $outbound_details->links('pagination::custom-pagination') }}
                        </div>
                        <div class="card-footer pr-11">
                            <button class="btn btn-primary float-right h-[3rem] w-[10rem] justify-bottom">ยืนยันการส่งออก</button>
                            <a href="#" id="printButton"><button
                                    class="btn btn-secondary float-right mr-2 h-[3rem] w-[10rem] justify-bottom">พิมพ์ใบส่งสินค้า</button></a>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.getElementById('printButton').addEventListener('click', function() {
        Swal.fire({

            html: `
            <div class="flex h-[34rem] w-[60rem] p-2">
                <div class=" w-3/5 p-3 flex items-center justify-center  h-full bg-gray-300">
                    <img class"" src="https://scontent.fbkk20-1.fna.fbcdn.net/v/t39.30808-6/434751076_1796243624207178_3506995629515680686_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=5f2048&_nc_ohc=2eGBH_ogJYkAb7H-Bfj&_nc_ht=scontent.fbkk20-1.fna&oh=00_AfBPUq6kQWpEe5AKAuL2A5-h-si_Z8YL8ysKcBDfJ3ZoQQ&oe=661C9362" class="max-h-full max-w-full" alt="รูปภาพ">

                </div>
                <div class="w-2/5 h-full bg-white " >
                    <div class="">
                        <b class=" text-xl">
                            พิมพ์ใบขาย
                        </b>
                    </div>
                    <div class="text-left mt-3 m-10 ">
                        <br>
                        <h2 class="text-left">
                            พิมพ์
                        </h2>
                        <select name="" id="" class="mt-3 border border-gray-300 rounded-md w-full px-2 py-1">
                            <option value="1">แผนงานปัจจุบัน</option>
                        </select>
                        
                        <h2 class="text-left mt-3">
                            ขนาดกระดาษ
                        </h2>
                        <select name="" id="" class="mt-3 border border-gray-300 rounded-md w-full px-2 py-1">
                            <option value="1">A4(21.0cm x 29.7cm)</option>
                        </select>
                        <br>
                        <h2 class="text-left mt-3">
                            การวางแนวของหน้า
                        </h2>
                        <div class="mt-4 text-center w-full">
                            <input type="radio" id="horizontal" name="layout" value="horizontal" style="margin-right:0rem;">
                            <label for="horizontal">แนวนอน</label>
                            <input type="radio" id="vertical" name="layout" value="vertical" style="margin-left:4rem;">
                            <label for="vertical">แนวตั้ง</label>
                        </div>

                        <h2 class="text-left mt-3">
                            สเกล
                        </h2>
                        <select name="" id="" class="mt-3 border border-gray-300 rounded-md w-full px-2 py-1">
                            <option value="1">พอดีกับความกว้าง</option>
                        </select>
                        <br>
                        <h2 class="text-left mt-3">
                            ขอบ
                        </h2>
                        <select name="" id="" class="mt-3 border border-gray-300 rounded-md w-full px-2 py-1">
                            <option value="1">ปกติ</option>
                        </select>
                        <br>
                        <h4 class="text-left mt-3 text-blue-500">
                            ตั้งค่าตัวแบ่งหน้าแบบกำหนดเอง
                        </h4>
                    </div>

                </div>
            </div>


            `,
            showCancelButton: true,
            confirmButtonText: 'พิมพ์',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                // ตรวจสอบว่าปุ่ม OK ถูกคลิก
                console.log('Print button clicked');
                // ทำสิ่งที่ต้องการเมื่อปุ่ม OK ถูกคลิก
            }
        });
    });
</script>
<style>
    .swal2-popup {
        width: auto !important;
        max-width: 80vw;
        padding: 0 !important;
    }

    .swal2-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
    }

    .swal2-image {
        margin-top: 20px;
        max-height: 80vh;
        max-width: 80vw;
    }

    /* เพิ่ม CSS เพื่อให้รูปภาพแสดงกึ่งกลางทั้งด้านบนและด้านข้าง */
    .swal2-popup .swal2-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 0;
    }

    .swal2-popup .swal2-content > div {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .swal2-popup .swal2-content > div:first-child {
        margin-bottom: 20px;
    }

    /* เพิ่ม CSS เพื่อสร้างเส้นขอบของ select */
    .swal2-select {
        position: relative;
        display: inline-block;
        width: 100%;
        margin-top: 0.5rem;
    }

    .swal2-select select {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        appearance: none; /* ลบลักษณะเดิมของ select */
        background-color: #fff;
        background-image: none;
    }

    .swal2-select::after {
        content: '\25bc'; /* ลูกศรลง */
        position: absolute;
        top: 50%;
        right: 0.75rem;
        transform: translateY(-50%);
        pointer-events: none;
    }
    </style>



@endsection
