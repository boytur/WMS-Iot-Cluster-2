@extends('layouts.default')
@section('title', 'รายละเอียดสินค้าเข้า')

@section('content')

    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="{{ url('/product/inbounds') }}">สินค้า > รับเข้า > </a>
                    <a href="">&nbsp;รายละเอียด</a>
                </div>
            </div>
            <div class="w-full p-2">

                <div style="height: calc(100vh - 7.7rem)" class="rounded-sm  overflow-y-scroll">

                    <div class="w-full bg-black/20 mt-2 rounded-md">
                        <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                            <b class="mx-2  mt-2 text-lg text-black uppercase   ">
                                รายละเอียด</b> {{-- title --}}
                        </div>

                        <div class="bg-white" id="lot_in_detail">
                            <div class=" px-5 py-3">
                                <b>วันที่เพิ่ม : </b> {{ date('d/m/Y', strtotime($lot_in->created_at)) }} <br>
                                <b>เพิ่มโดย : </b> {{ $lot_in->users->fname . ' ' . $lot_in->users->lname }} <br>
                                <b>หมายเลขล็อต : </b> {{ $lot_in->lot_in_number }} <br>
                            </div>
                        </div>
                    </div>

                    {{-- table --}}
                    @if ($type == 'inbound')
                        <div class="w-full bg-black/20 mt-2 rounded-md">
                            <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                                <b class="mx-2  mt-2 text-lg text-black uppercase   ">
                                    ตารางรายการสินค้า </b> {{-- title --}}
                            </div>
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                                                บาร์โค้ด
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
                                    <tbody id="lot_in_detail">
                                        @foreach ($product as $index => $inbound_product)
                                            <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">
                                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                                    {{ (int) $index + 1 }}
                                                </th>

                                                <td class="px-6 py-4 flex justify-center">
                                                    <div class=" w-[3rem] h-[2rem] border">
                                                        <img class="object-cover w-full h-full"
                                                            src="{{ $inbound_product->master_products->mas_prod_image }}"
                                                            alt="">
                                                    </div>
                                                </td>


                                                <td class="px-6 py-4 text-center">
                                                    {{ $inbound_product->master_products->mas_prod_name }}
                                                </td>

                                                <td class="px-6 py-4 text-center">
                                                    {{ $inbound_product->master_products->mas_prod_barcode }}
                                                </td>

                                                <td class="px-6 py-4 text-center">
                                                    {{ $inbound_product->inbound_amount }}
                                                </td>

                                                <td class="px-6 py-4 text-center">
                                                    {{ $inbound_product->master_products->categories->cat_name }}
                                                </td>

                                                <td class="px-6 py-4 text-center">
                                                    {{ date('d/m/Y', strtotime($inbound_product->inbound_exp)) }}
                                                </td>

                                                <td class="px-6 py-4 text-center">
                                                    @if ($inbound_product->inbound_status === 'Initialized')
                                                        <div>
                                                            <p
                                                                class="border text-center bg-[#666666] rounded-3xl py-1 text-white">
                                                                นำเข้าระบบ
                                                            </p>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <p
                                                                class="border text-center bg-green-700 rounded-3xl py-1 text-white ">
                                                                จัดเก็บ
                                                            </p>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- เลือกแสดงตาราง --}}
                        <div class="flex justify-center my-4">
                            {{ $product->links('pagination::custom-pagination') }}

                        </div>
                        {{-- ปุ่มค้นหา --}}
                        <div class="mt-3 flex items-end justify-end pb-3">
                            <button onclick="onclick_find_lot_in_spaces({{ $lot_in->lot_in_id }})" id="search_wh"
                                class="w-[10rem] h-[3rem] gap-2 btn-primary flex items-center justify-center mx-2">
                                <div>
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                                <div type="submit">
                                    <p>หาพื้นที่จัดเก็บ</p>
                                </div>
                            </button>
                        </div>
                    @elseif ($type == 'onshelf')
                        <div class="w-full bg-black/20 mt-2 rounded-md">
                            <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                                <b class="mx-2  mt-2 text-lg text-black uppercase   ">
                                    ตารางรายการสินค้า </b> {{-- title --}}
                            </div>
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                                                บาร์โค้ด
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                จำนวน
                                            </th>

                                            <th scope="col" class="px-6 py-3 text-center">
                                                ตำแหน่ง
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                คลังสินค้า
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                สถานะ
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                การกระทำ
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="lot_in_detail">
                                        @foreach ($product as $index => $onshelf_product)
                                            <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">
                                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                                    {{ (int) $index + 1 }}
                                                </th>

                                                <td class="px-6 py-4 flex justify-center">
                                                    <div class=" w-[3rem] h-[2rem] border">
                                                        <img class="object-cover w-full h-full"
                                                            src="{{ $onshelf_product->inbound_orders->master_products->mas_prod_image }}"
                                                            alt="">
                                                    </div>
                                                </td>


                                                <td class="px-6 py-4 text-center">
                                                    {{ $onshelf_product->inbound_orders->master_products->mas_prod_name }}
                                                </td>

                                                <td class="px-6 py-4 text-center">
                                                    {{ $onshelf_product->inbound_orders->master_products->mas_prod_barcode }}
                                                </td>

                                                <td class="px-6 py-4 text-center">
                                                    {{ $onshelf_product->inbound_orders->inbound_amount }}
                                                </td>

                                                <td class="px-6 py-4 text-center">
                                                    {{ $onshelf_product->spaces->space_name }}
                                                </td>

                                                <td class="px-6 py-4 text-center">
                                                    {{ $onshelf_product->spaces->racks->warehouses->wh_name }}
                                                </td>

                                                <td class="px-6 py-4 text-center">
                                                    @if ($onshelf_product->on_prod_status === 'Transporting')
                                                        <div>
                                                            <p
                                                                class="border text-center bg-[#AB7408] rounded-3xl py-1 text-white">
                                                                กำลังขนส่ง
                                                            </p>
                                                        </div>
                                                    @elseif ($onshelf_product->on_prod_status === 'Transfer')
                                                        <div>
                                                            <p
                                                                class="border text-center bg-[#666666] rounded-3xl py-1 text-white">
                                                                ส่งต่อ
                                                            </p>
                                                        </div>
                                                    @elseif ($onshelf_product->on_prod_status === 'Fail')
                                                        <div>
                                                            <p
                                                                class="border text-center bg-[#ab0808] rounded-3xl py-1 text-white">
                                                                ไม่สำเร็จ
                                                            </p>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <p
                                                                class="border text-center bg-green-700 rounded-3xl py-1 text-white ">
                                                                จัดเก็บ
                                                            </p>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="px-1 py-1 text-center">
                                                    <div class="flex gap-1 w-full h-full">
                                                        <button onclick="cancel_prod({{ $onshelf_product->on_prod_id }})"
                                                            class="bg-red-900 border border-red-600 text-white hover:bg-red-700 cursor-pointer hover:text-white text-sm rounded-lg focus:ring-[#5d87ff] focus:outline-none focus:border-red-100 block w-full p-2.5">
                                                            <i class="fa-regular fa-circle-xmark"></i>ไม่สำเร็จ</button>
                                                        <button onclick="confrim_prod({{ $onshelf_product->on_prod_id }})"
                                                            class=" bg-blue-600 border border-[#5d87ff] text-white hover:bg-blue-500 cursor-pointer hover:text-white text-sm rounded-lg focus:ring-[#5d87ff] focus:outline-none focus:border-blue-100 block p-2.5 w-full h-full">
                                                            <i class="fa-regular fa-circle-check"></i>
                                                            สำเร็จ</button>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="flex justify-center my-4">
                            {{ $product->links('pagination::custom-pagination') }}
                        </div>
                        <div class="card-footer pr-11">
                            @if ($lot_in->lot_in_status == 'Initialized')
                                <button class="btn btn-primary float-right h-[3rem] w-[10rem] justify-bottom"
                                    onclick="closed_lot_in({{ json_encode([$lot_in->lot_in_id, $product]) }})">ปิดล็อต</button>
                            @endif
                            <a href=""><button
                                    class="btn btn-secondary float-right mr-2 h-[3rem] w-[10rem] justify-bottom">พิมพ์ใบส่งสินค้า</button></a>

                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <script>
        const closed_lot_in = async (payload) => {
            const cluster = '{{ env('CLUSTER') }}';
            console.log(payload[0])
            console.log(payload[1]?.data[0]?.on_prod_status)
            Swal.fire({
                title: "คุณต้องการปิดล็อตใช่หรือไม่?",
                text: "โปรดเช็คสถานะสินค้าก่อนกดยืนยัน!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                cancelButtonText: "ยกเลิก",
                confirmButtonText: "ปิดล็อต"
            }).then(async (result) => {
                if (result.isConfirmed) {
                    // เช็คข้อมูลก่อนทำการ fetch

                    let hasError = false;
                    for (const key in payload[1].data) {
                        if (payload[1].data.hasOwnProperty(key)) {
                            const item = payload[1].data[key];
                            if (item.on_prod_status === 'Transporting' || item.on_prod_status ===
                                'Transfer') {
                                hasError = true;
                                break;
                            }
                        }
                    }

                    if (hasError) {
                        Swal.fire({
                            title: "ไม่สามารถปิดล็อตได้!",
                            text: "กรุณาเช็คสถานะสินค้าอีกครั้ง",
                            icon: "error"
                        });
                        return; // ออกจาก function โดยไม่ทำการ fetch
                    }

                    // ทำการ fetch ข้อมูล
                    const response = await fetch(
                        `${cluster}/product/inbounds/inbound-detail/closed_lot_in`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(payload[0])
                        });
                    if (response.status === 200) {
                        const responseData = await response.json();
                        Swal.fire({
                            title: "ปิดล็อตสำเร็จ!",
                            text: "ล็อตของคุณถูกปิดแล้ว.",
                            icon: "success"
                        });
                        window.location.reload();
                    } else if (response.status === 201) {
                        Swal.fire({
                            title: "ปิดล็อตไม่สำเร็จ!",
                            icon: "warning"
                        });
                    }
                }
            });
        }
        const onclick_inbound_lastest_deatil = (lot_in_id) => {
            const cluster = '{{ env('CLUSTER') }}';
            window.location.href = `${cluster}/product/inbounds/inbound-detail/${lot_in_id}`;
        }

        const onclick_find_lot_in_spaces = async (lot_in_id) => {
            console.log('find_lot_in_space');
            const cluster = '{{ env('CLUSTER') }}';
            const response = await fetch(`${cluster}/product/inbounds/find-lot-in-space/${lot_in_id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            console.log(response);
            if(response.ok){
                window.location.reload();
            }
        }
        const cancel_prod = async (on_prod_id) => {
            const on_id = on_prod_id;
            Swal.fire({
                title: "หมายเหตุที่ไม่สำเร็จ",
                html: '<input id="swal-input1" class="swal2-input" placeholder="กรุณากรอกข้อมูลหมายเหตุ">',
                showCancelButton: true,
                confirmButtonColor: '#2f67ff',
                confirmButtonText: "ตกลง",
                cancelButtonText: "ยกเลิก",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    // นำค่าจาก input ไปใช้งานต่อได้ตามต้องการ
                    const note = document.getElementById('swal-input1').value;
                    // ตรวจสอบว่าค่าที่ป้อนไม่ใช่ค่าว่างหรือไม่
                    if (!note) {
                        Swal.showValidationMessage('กรุณากรอกข้อมูล');
                    }
                    return note;
                }
            }).then(async (result) => {
                // ตรวจสอบผลลัพธ์หลังจากกดปุ่ม confirm
                if (result.isConfirmed) {
                    const cluster = '{{ env('CLUSTER') }}';
                    const noteValue = result.value;
                    const on_prod_id = on_id;
                    const response = await fetch(
                        `${cluster}/product/inbounds/inbound-detail/cancel_on_shelf`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify([
                                on_prod_id,
                                noteValue
                            ])
                        });
                    if (response.status === 200) {
                        Swal.fire({
                            'icon': 'success',
                            'title': 'success',
                            'text': "ยืนยันรายการรับเข้าสำเร็จ!",

                        });
                        window.location.reload()
                    } else {
                        Swal.fire({
                            'icon': 'error',
                            'title': 'error',
                            'text': "เกิดข้อผิดพลาดบางอย่าง"
                        });
                    }
                }
            });
        }
        const confrim_prod = async (on_prod_id) => {
            const on_id = on_prod_id;
            Swal.fire({
                title: "ยืนยันการจัดเก็บ",
                showCancelButton: true,
                confirmButtonColor: '#2f67ff',
                confirmButtonText: "ตกลง",
                cancelButtonText: "ยกเลิก",
                showLoaderOnConfirm: true,
            }).then(async (result) => {
                // ตรวจสอบผลลัพธ์หลังจากกดปุ่ม confirm
                if (result.isConfirmed) {
                    const cluster = '{{ env('CLUSTER') }}';

                    const on_prod_id = on_id;
                    const response = await fetch(
                        `${cluster}/product/inbounds/inbound-detail/confrim_on_shelf`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify([
                                on_prod_id
                            ])
                        });
                    if (response.status === 200) {
                        Swal.fire({
                            'icon': 'success',
                            'title': 'success',
                            'text': "ยืนยันรายการรับเข้าสำเร็จ!",

                        });
                        window.location.reload()
                    } else {
                        Swal.fire({
                            'icon': 'error',
                            'title': 'error',
                            'text': "เกิดข้อผิดพลาดบางอย่าง"
                        });
                    }
                }
            });
        }
    </script>
@endsection
