@extends('layouts.default')

@section('title', 'จัดการสินค้า')
@section('content')

    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="">สินค้า > จัดการสินค้า</a>
                </div>
            </div>
            <div class="w-full p-2">
                <div style="height: calc(100vh - 7.7rem)" class="rounded-sm overflow-y-scroll">

                    <div class="w-full p-5 bg-white rounded-md pb-8">
                        {{-- box-1 --}}
                        <div class="w-full flex">

                            {{-- search input --}}
                            <div class="w-3/4 flex gap-2 h-full">
                                <div class="w-full">
                                    <div>
                                        <p class="text-black/70 text-sm">ค้นหาสินค้า</p>
                                        <input type="text" placeholder="กรอกรายละเอียดที่ต้องการค้นหา..."
                                            class="input-primary h-[3rem]" name="search_key" id="search_key">
                                    </div>
                                </div>
                                <div class="md:w-[15rem]">
                                    <div>
                                        <p class="text-black/70 text-sm">ค้นหาด้วย</p>
                                        <select name="search_attribute" id="search_attribute"
                                            class="w-full h-[3rem] input-primary px-2 cursor-pointer">
                                            <option value="mas_prod_barcode">บาร์โค้ด</option>
                                            <option value="mas_prod_no">หมายเลขสินค้า</option>
                                            <option value="mas_prod_name">ชื่อสินค้า</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="md:w-[10rem] h-full mt-5">
                                    <div class="w-full">
                                        <button onclick="search_product()"
                                            class="w-full h-[3rem] gap-2 btn-primary flex items-center justify-center mx-2">
                                            <div>
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </div>
                                            <div>
                                                <p>ค้นหา</p>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- add product inbound --}}
                            <div class="w-full flex justify-end gap-3 mt-2">

                                <div class="mt-3 lg:pt-0">
                                    <button class="btn-primary px-4 flex items-center h-[3rem] gap-1">
                                        <a href="{{ url('/product/managements/add-new-product') }}">
                                            <div class="flex items-center gap-1">
                                                <i class="fa-solid fa-circle-plus text-[0.8rem] mt-[2px]"></i>
                                                <div>
                                                    <p class="lg:text-sm lg:block hidden">เพิ่มสินค้า</p>
                                                </div>
                                            </div>

                                        </a>

                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- end box-1 --}}
                    </div>

                    {{-- table product --}}
                    <div class="w-full bg-black/20 mt-2 rounded-md">
                        <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                            <b class="mx-2  mt-2 text-lg text-black uppercase   " id="product_count">
                                ตารางรายการสินค้าหลัก</b>
                        </div>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right ">
                                <thead class="text-xs text-white uppercase bg-[#212529]">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            ลำดับ
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            หมายเลขสินค้า
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            รูปภาพสินค้า
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            ชื่อสินค้า
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            ประเภทสินค้า
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            แท็ก
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            วันที่เพิ่ม
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            การกระทำ
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="product_table" id="product_table">
                                    @foreach ($products as $index => $product)
                                        <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer"
                                            onclick="onclick_product_details('/product/managements/detail/{{ $product->mas_prod_id }}')">
                                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                                {{ $index + 1 }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $product->mas_prod_no }}
                                            </td>
                                            <td class="px-6">
                                                <div class=" w-[3rem] h-[2rem] border">
                                                    <img class="object-cover w-full h-full"
                                                        src={{ $product->mas_prod_image }} alt="">
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $product->mas_prod_name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $product->categories->cat_name }}
                                            </td>

                                            <td class="px-6 py-4">
                                                @foreach ($product->tags as $tag)
                                                    {{ $tag['tag_name'] }}
                                                @endforeach
                                            </td>

                                            <td class="px-6 py-4">
                                                {{ date('d/m/Y', strtotime($product->created_at)) }}
                                            </td>

                                            <td class="px-6 py-4 flex gap-3 text-gray-500">
                                                <a href="{{ url('/product/managements/edit/' . $product->mas_prod_id) }}"
                                                    class="">
                                                    <i
                                                        class="fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105"></i></a>
                                                |
                                                <a
                                                    href="{{ url('/product/managements/detail/' . $product->mas_prod_id) }}">
                                                    <i
                                                        class="fa-solid fa-circle-info text-[1.5rem] hover:text-blue-700 hover:scale-105"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="flex justify-center my-4" id="paginate">
                        {{ $products->links('pagination::custom-pagination') }}
                    </div>

                </div>
            </div>
        </div>
        <script>
            /*
            * search_productn()
            * @author: Pichawat Suwan 65160346
            * @create date: 2024-04-07
            */
            const search_product = async () => {
                try {
                    //ดึงค่า
                    const search_key = document.getElementById("search_key").value;
                    const search_attribute = document.getElementById("search_attribute").value;
                    const cluster = '{{ env('CLUSTER') }}';
                    //ส่ง req
                    const response = await fetch(`${cluster}/product/managements/search-product`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            search_key,
                            search_attribute
                        })
                    });
                    console.log(response.data);

                    if (response.status == 200) {
                        const responseData = await response.json();
                        const searches = responseData.data;
                        const search_product_table = document.getElementById("product_table");
                        const search_product_paginate = document.getElementById("paginate");
                        search_product_table.innerHTML = ""; // Clear previous results
                        search_product_paginate.innerHTML = ""
                        console.log(searches);
                        if (searches?.length === 0) {
                            // Display message when no results are found
                            search_product_table.innerHTML =
                                `<tr><td colspan="5">ไม่พบรายการสินค้า</td></tr>`;
                            document.getElementById('product_count').innerText = 0;
                        } else {

                            searches?.map((search, index) => {
                                const row = `
                                <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">
                                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                                ${index + 1}
                                            </td>
                                            <td class="px-6 py-4">
                                                ${ search.mas_prod_no }
                                            </td>
                                            <td class="px-6">
                                                <div class=" w-[3rem] h-[2rem] border">
                                                    <img class="object-cover w-full h-full"
                                                        src=${ search.mas_prod_image } alt="">
                                                </div>
                                                <td class="px-6 py-4">${ search.mas_prod_name }</td>
                                                <td class="px-6 py-4">${ search.cat_name }</td>
                                                <td class="px-6 py-4">${search.tags.map(tag => tag.tag_name).join(', ')}</td>
                                                <td class="px-6 py-4" id="dateCell_${index}"></td>
                                                <td class="px-6 py-4 flex gap-3 text-gray-500">
                                                    <a href="{{ url('/product/managements/edit/') }}${ search.mas_prod_id }">
                                                        <i class="fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105"></i>
                                                    </a>
                                                        |
                                                    <a href="{{ url('/product/managements/detail/') }}${ search.mas_prod_id }">
                                                        <i class="fa-solid fa-circle-info text-[1.5rem] hover:text-blue-700 hover:scale-105"></i>
                                                    </a>
                                                </td>
                                </tr>
                            `;
                                search_product_table.innerHTML += row;

                                // สร้างวัตถุ Date จากค่า timestamp ที่ได้รับมา
                                const timestamp = new Date(search.created_at)
                                    .getTime(); // แปลงจากประเภท string ให้เป็น Date object และดึง timestamp ออกมา
                                const date = new Date(timestamp);

                                // กำหนดรูปแบบของวันที่และเวลา
                                const formattedDate = ("0" + date.getDate()).slice(-2) + "/" + ("0" + (date
                                    .getMonth() + 1)).slice(-2) + "/" + date.getFullYear();

                                // แสดงผลลัพธ์ใน cell ที่มี id เรากำหนดไว้
                                document.getElementById(`dateCell_${index}`).innerText = formattedDate;
                                document.getElementById('product_count').innerText =
                                    `รายการสินค้าที่ตรงกับคำค้นหา ${searches.length} รายการ`;

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
        </script>
    @endsection
