{{-- v_outbound_index.blade.php
    Display from lot out table
    @author : Supatsara Youraksa
    @Create Date : 2024-04-01
      --}}
@extends('layouts.default')

@section('title', 'ส่งออกด้วยใบจำหน่าย')
@section('content')

    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="">สินค้า > ส่งสินค้าออก</a>
                </div>
            </div>
            <div class="w-full p-2">
                <div style="height: calc(100vh - 7.7rem)" class="rounded-sm  overflow-y-scroll">
                    <div class="w-full p-5 bg-white rounded-md">
                        <div class=" w-full flex ">
                            {{-- search input --}}
                            <div class="w-2/4 flex gap-2 h-full">
                                <div class="w-full">
                                    <div>
                                        <p class="text-black/70 text-sm">ค้นหา</p>
                                        <input type="text" placeholder="กรอกรายละเอียดที่ต้องการค้นหา..."
                                            class="input-primary h-[3rem]" name="lot_out_keyword" id="lot_out_keyword">
                                    </div>
                                </div>
                                <div class="md:w-[32rem]">
                                    <div>
                                        <p class="text-black/70 text-sm">ค้นหาจาก</p>
                                        <select name="lot_out_attribute" id="lot_out_attribute"
                                            class="w-full h-[3rem] input-primary px-2">
                                            <option value="lot_out_number">หมายเลขรายการส่งออก</option>
                                            <option value="lot_out_creater">ผู้ที่สร้าง</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="md:w-[20rem]">
                                    <div>
                                        <p class="text-black/70 text-sm">สถานะ</p>
                                        <select name="lot_out_status" id="lot_out_status"
                                            class="w-full h-[3rem] input-primary px-2">
                                            <option value="lot_out_all_status">ทั้งหมด</option>
                                            <option value="lot_out_intialize">รอดำเนินการ</option>
                                            <option value="lot_out_closed">ปิดล็อต</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="md:w-[10rem] h-full  mt-5">
                                    <div class="w-full">
                                        <button
                                            class="w-full h-[3rem] gap-2 btn-primary flex items-center justify-center mx-2"
                                            onclick="lotout_serch()">
                                            <div>
                                                <i id="glass-find" class="fa-solid fa-magnifying-glass"></i>
                                            </div>
                                            <div>
                                                <p>ค้นหา</p>

                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- add lot_out inbound --}}
                            <div class="w-full flex justify-end gap-3 mt-3">
                                <div class=" items-center flex h-full relative">

                                    {{-- icon truck --}}
                                    <i onclick="toggle_cart_open()"
                                        class="fa-solid fa-truck lg:text-[2rem] text-sm cursor-pointer lg:mt-4"></i>
                                    <div class="absolute flex top-4 left-[-8px]">
                                        <p
                                            class="w-[1rem] h-[1rem] bg-red-500 rounded-full text-white flex items-center justify-center py-1 mb-1">
                                            1</p>
                                    </div>
                                </div>

                                <div id="cart-popup"
                                    class="w-[45rem] mb-3 hidden absolute mt-20 mr-12 rounded-md bg-white shadow-lg border right-[18.5rem] p-1 z-40 text-black">
                                    <div class="border-b-4 border-black">
                                        <b>
                                            <p class="text-center border-black">รายการล็อตสินค้าส่งออก</p>
                                        </b>
                                    </div>

                                    <div class="overflow-x-auto shadow-lg max-h-[25rem] overflow-y-scroll">
                                        <div class="flex flex-col">
                                            <table id="cart-table"
                                                class="w-full text-sm text-left rtl:text-right border-black">
                                                <thead class="text-xs text-white uppercase bg-[#212529]">
                                                    <tr>
                                                        <th scope="col" class="pr-8 pl-5 w-10 px-3 py-1 text-center">
                                                            ลำดับ
                                                        </th>

                                                        <th scope="col" class=" px-3 py-1 text-center">
                                                            หมายเลขรายการรับเข้า
                                                        </th>

                                                        <th scope="col" class="pl-5 px-3 py-1 text-center">
                                                            วันที่สร้าง
                                                        </th>

                                                        <th scope="col" class="pr-8 px-3 py-1 text-center">
                                                            ผู้สร้าง
                                                        </th>

                                                        <th scope="col" class=" px-3 py-1 text-center">
                                                            สถานะ
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-2">
                                            <table>
                                                <thead>
                                                <tbody>
                                                    @foreach ($lotouts as $index => $lot_out)
                                                        <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">
                                                            <td
                                                                class="h-[1px] w-[80px] px-6 py-4 text-[12px]  text-center ">
                                                                {{ $index + 1 }}</td>
                                                            <td
                                                                class="h-[1px] w-[500px] px-6 py-4 text-center text-[12px] ">
                                                                {{ $lot_out->lot_out_number }}</td>
                                                            <td
                                                                class="h-[1px] w-[100px] px-6 py-4 text-center text-[12px] ">
                                                                {{ date('d/m/Y', strtotime($lot_out->created_at)) }}</td>
                                                            <td class="h-[1px] w-[200px] px-6 py-4 text-center text-[12px]">
                                                                {{ $lot_out->users->fname . ' ' . $lot_out->users->lname }}
                                                            </td>
                                                            <td class="h-[1px] w-[100px] px-6 py-4 text-center text-[12px]">
                                                                @if ($lot_out->lot_out_status === 'Initialized')
                                                                    <div>
                                                                        <p
                                                                            class="border text-center bg-[#666666] rounded-3xl py-1 px-1 text-white">
                                                                            {{ $lot_out->lot_out_status }}</p>
                                                                    </div>
                                                                @else
                                                                    <div>
                                                                        <p
                                                                            class="border text-center bg-green-700 rounded-3xl py-1 px-1 text-white ">
                                                                            {{ $lot_out->lot_out_status }}</p>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>

                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3 lg:pt-0">
                                    <a class="btn-secondary px-4 flex items-center h-[3rem] gap-1"
                                        href="{{ url('product/outbounds/view-outbound-latest') }}">
                                        <div>
                                            <div class="flex items-center gap-1">
                                                <i
                                                    class="fa-solid fa-clock-rotate-left cursor-pointer text-[0.8rem] mt-[2px]"></i>
                                                <div>
                                                    <p class=" md:text-sm lg:block hidden text-[0.5]">รายการล่าสุด</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="mt-3 lg:pt-0">
                                    <a class="btn-primary px-4 flex items-center h-[3rem] gap-1"
                                        href="{{ url('product/outbounds/create-outbound-order') }}">
                                        <div>
                                            <div class="flex items-center gap-1">
                                                <i class="fa-solid fa-circle-plus text-[0.8rem] mt-[2px]"></i>
                                                <div>
                                                    <p class="lg:text-sm lg:block hidden">สร้างรายการส่งออก</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- table --}}
                    <div class="w-full bg-black/20 mt-2 rounded-md">
                        <div class="py-2 w-full bg-[#D9D9D9] sm:rounded-lg">
                            <b class=" bg mx-2  mt-2 rounded-md text-black text-lg" id="lot_out_count">
                                ตารางรายการสินค้าส่งออกรอจัดการ</b>
                        </div>
                        <div class="relative overflow-x-auto shadow-md bg-white">
                            <table class="w-full text-sm text-left rtl:text-right">
                                <thead class="text-xs text-white uppercase bg-[#212529]">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            ลำดับ
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            หมายเลขรายการส่งออก
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            วันที่สร้าง
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            ผู้ที่สร้าง
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            สถานะ
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            การกระทำ
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="lot_out_table bg-white" id="lot_out_table">
                                    @foreach ($lotouts as $index => $lot_out)
                                        <tr class="bg-white border-b w-full hover:bg-blue-100 cursor-pointer"
                                            ondblclick="onclick_outbound_details({{ $lot_out->lot_out_id }})">
                                            <td class="px-6 text-center">
                                                {{ $index + 1 }}
                                            </td>

                                            <td class="px-6 text-center">
                                                {{ $lot_out->lot_out_number }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ date('d/m/Y', strtotime($lot_out->created_at)) }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $lot_out->users->fname . ' ' . $lot_out->users->lname }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                @if ($lot_out->lot_out_status === 'Initialized')
                                                    <div>
                                                        <p
                                                            class="border text-center bg-[#666666] rounded-3xl py-1 text-white">
                                                            รอดำเนินการ
                                                        </p>
                                                    </div>
                                                @else
                                                    <div>
                                                        <p
                                                            class="border text-center bg-green-700 rounded-3xl py-1 text-white">
                                                            ปิดล็อต
                                                        </p>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 flex gap-5 text-gray-500 justify-center">
                                                <div>
                                                    <a
                                                        href="{{ url("product/outbounds/edit-outbound-order/$lot_out->lot_out_id") }}">
                                                        <i
                                                            class="fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105">
                                                        </i>
                                                    </a>
                                                    </>
                                                    |
                                                    <i onclick="delete_lot_out({{ $lot_out->lot_out_id }})"
                                                        class="fa-solid fa-trash-can text-[1.5rem] hover:text-red-500 hover:scale-105"></i>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="flex justify-center my-4">
                        {{ $lotouts->links('pagination::custom-pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const lotout_serch = async () => {
            try {

                //ดึงค่า
                const lot_out_search = document.getElementById("lot_out_keyword").value;
                const lot_out_type = document.getElementById("lot_out_attribute").value;
                const lot_out_status = document.getElementById("lot_out_status").value;
                const cluster = '{{ env('CLUSTER') }}'
                //ส่ง req
                const response = await fetch(`${cluster}/product/outbounds/search-lot-out`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        lot_out_search,
                        lot_out_type,
                        lot_out_status
                    })
                });

                if (response.ok) {

                    const responseData = await response.json();
                    const lots = responseData.data;
                    const lotTableBody = document.getElementById("lot_out_table");
                    lotTableBody.innerHTML = ""; // Clear previous results
                    if (lots?.length === 0) {
                        document.getElementById('lot_out_count').innerText =
                            `ตารางรายการสินค้าส่งออกรอจัดการ`;
                        // Display message when no results are found
                        lotTableBody.innerHTML =
                            `<tr class="bg-white text-center"><td colspan="5" class="w-full pl-[5.1rem] h-[3rem]">ไม่พบรายการค้นหา</td></tr>`;

                    } else {

                        const initializedLots = lots.filter(search => search.lot_out_status ===
                            'Initialized'); // เช็ค index ที่มี status Initialized

                        console.log(initializedLots);
                        initializedLots?.map((search, index) => {

                            const status_color = search.lot_out_status === 'Initialized' ? '[#666666]' :
                                'green-700';

                            // สร้าง element ของแต่ละ row ในตาราง
                            const row = `
                                <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">
                                    <td class="px-6 py-4 text-center">${index + 1}</td>
                                    <td class="px-6 py-4 text-center">${search.lot_out_number}</td>
                                    <td class="px-6 py-4 text-center" id="dateCell_${index}"></td> <!-- เพิ่ม id ให้กับ cell เพื่อแทนที่วันที่ในภายหลัง -->
                                    <td class="px-6 py-4 text-center">${search.user_id}</td> <!-- อาจจะต้องแก้ไขเป็นรหัสผู้ใช้หรือข้อมูลที่เหมาะสม -->
                                    <td class="px-6 py-4 text-center">
                                        ${
                                            search.lot_out_status === 'Initialized' ?
                                            `<div>
                                                                                                    <p class="border text-center bg-${status_color} rounded-3xl py-1 text-white">
                                                                                                        รอดำเนินการ
                                                                                                    </p>
                                                                                                </div>` :
                                            `<div>
                                                                                                    <p class="border text-center bg-${status_color} rounded-3xl py-1 text-white">
                                                                                                        ปิดล็อต
                                                                                                    </p>
                                                                                                </div>`
                                        }

                                    </td>
                                    <td class="px-6 py-4 flex gap-5 text-gray-500 justify-center">

                                        <a href="{{ url('/product/outbounds/edit-outbound-order') }}/${search.lot_out_id}" class="">
                                            <i class="fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105"></i>
                                        </a>
                                        |
                                        <i class="fa-solid fa-trash-can text-[1.5rem] hover:text-red-500 hover:scale-105"></i>
                                    </td>
                                </tr>
                            `;
                            // เพิ่ม row ลงในตาราง
                            lot_out_table.innerHTML += row;

                            // สร้างวัตถุ Date จากค่า timestamp ที่ได้รับมา
                            const timestamp = new Date(search.created_at)
                                .getTime(); // แปลงจากประเภท string ให้เป็น Date object และดึง timestamp ออกมา
                            const date = new Date(timestamp);

                            // กำหนดรูปแบบของวันที่และเวลา
                            const formattedDate = ("0" + date.getDate()).slice(-2) + "/" + ("0" + (date
                                .getMonth() + 1)).slice(-2) + "/" + date.getFullYear();

                            // แสดงผลลัพธ์ใน cell ที่มี id เรากำหนดไว้
                            document.getElementById(`dateCell_${index}`).innerText = formattedDate;
                            document.getElementById('lot_out_count').innerText =
                                `ผลการค้นหาจำนวน ${initializedLots.length} รายการ`;
                        });
                    }
                } else {
                    throw new Error('Failed to fetch data');
                }
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: "error",
                    title: `เกิดข้อผิดพลาด`,
                });
            }
        }
        const delete_lot_out = async (lot_out_id) => {
            const cluster = '{{ env('CLUSTER') }}'
            Swal.fire({
                title: "คุณต้องการลบใช่หรือไม่?",
                text: "คุณจะไม่สามารถเรียกข้อมูลได้อีก!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                cancelButtonText: "ยกเลิก",
                confirmButtonText: "ลบ!"

            }).then(async (result) => {
                if (result.isConfirmed) {
                    const response = await fetch(
                        `${cluster}/product/outbounds/delete-outbound-product/${lot_out_id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                        });
                    if (response.status === 200) {
                        Swal.fire({
                            title: "ลบข้อมูลสำเร็จ!",
                            text: "ข้อมูลของคุณถูกลบแล้ว.",
                            icon: "success"
                        });
                        window.location.reload();
                    } else if (response.status === 201) {
                        Swal.fire({
                            title: "ลบข้อมูลไม่สำเร็จ!",
                            icon: "warning"
                        });
                    }
                }
            });
        }


        const onclick_outbound_details = (lot_out_id) => {
            const cluster = '{{ env('CLUSTER') }}'
            window.location.href = `${cluster}/product/outbounds/outbound-detail/${lot_out_id}`;
        }


        const refresh_cart_table = () => {

            //ดึงข้อมูลสินค้าใน localstorage
            let products_in_cart_localstorage = JSON.parse(localStorage.getItem('products_cart') || '[]');
            const cart_table = document.querySelector('#cart-table tbody');

            cart_table.innerHTML = '';

            //สร้างตารางใหม่จากข้อมูลใน localstorage
            products_in_cart_localstorage.forEach(function(product, index) {
                let new_row = '<tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">' +
                    '<td class="px-6 py-1 font-medium whitespace-nowrap text-center mr-2">' +
                    '<img class="w-[60px] object-cover" src="' + product.mas_prod_image + '">' +
                    '</td>' +
                    '<td class="px-6 py-1 text-center">' + product['mas_prod_name'] + '</td>' +
                    '<td class="px-6 py-1 text-center">' + product.categories.cat_name + '</td>' +
                    '<td class="px-6 py-1 text-center">' + product['amount'] + '</td>' +
                    '<td class="px-6 py-1 text-center">' +
                    '<button onclick="remove_product_from_cart(' + index + ')">' +
                    '<i class="fa-solid fa-trash-can text-[1rem] hover:text-red-500 hover:scale-105"></i>' +
                    '</button>' +
                    '</td>' +
                    '</tr>';
                cart_table.innerHTML += new_row;
            });

            cart_amount.textContent = products_in_cart_localstorage.length;
        }

        const toggle_cart_open = () => {
            const cart = document.querySelector('#cart-popup');
            cart.classList.toggle('md:block');
            refresh_cart_table();
        }
    </script>
@endsection
