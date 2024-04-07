{{-- v_edit_inbound_order.blade.php
    Display from inbound order when press edit
    @author : Thanawan Kongchok
    @Create 1.0.0 Date : 2024-04-02
      --}}

@extends('layouts.default')
@section('title', 'แก้ไขรายการสินค้าเข้า')

@section('content')

    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="{{ url('/product/inbounds') }}">สินค้า > รับเข้า > </a>
                    <a href="">&nbsp;แก้ไขรายการสินค้าเข้า</a>
                </div>
            </div>
            <div class="flex justify-end">
                <div class=" lg:pt-0 mr-2 mt-2 mb-1">
                    <a onclick="onclick_add_inbound()" class="btn-primary px-4 flex items-center h-[3rem] gap-1">
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

            <div style="height: calc(100vh - 7rem)" class="w-full flex flex-col h-full overflow-y-scroll mt-2 px-2">
                <div class="w-full bg-white">
                    <div class="w-full bg-black/20  rounded-t-lg">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-t-lg">
                            <table class="w-full text-sm text-left rtl:text-right ">
                                <thead class="text-xs text-black uppercase bg-[#D9D9D9]">
                                    <tr>
                                        <b class="mx-5  mt-2 text-lg text-black uppercase ">
                                            รายละเอียด</b>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="form-group row mx-5 my-3">
                        <b>วันที่เพิ่ม: </b>
                        {{ date('d/m/Y', strtotime($lot_in->creat_at)) }}
                    </div>
                    <div class="form-group row mx-5 my-3">
                        <b>เพิ่มโดย:</b>
                        {{ $lot_in->users->fname . ' ' . $lot_in->users->lname }}
                    </div>
                    <div class="form-group row mx-5 my-3">
                        <b>หมายเลขล็อต: </b>
                        {{ $lot_in->lot_in_number }}
                    </div>
                </div>
                </style=>
                {{-- table product --}}
                <div class="w-full mt-2 rounded-t-md">
                    <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                        <b class="mx-2  mt-2 text-lg text-black uppercase   ">
                            ตารางรายการสินค้านำเข้ารอจัดการ</b>
                    </div>
                    <div class="relative overflow-x-auto shadow-md ">
                        <table class="w-full text-sm text-left rtl:text-right ">
                            <thead class="text-xs text-white uppercase bg-[#273B4A] ">
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
                                        วันหมดอายุ
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
                                @foreach ($lot_in_products as $index => $lot_in_product)
                                    <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">
                                        <td class="px-6 py-4 font-medium whitespace-nowrap">
                                            {{ $index + 1 }}
                                        </td>

                                        <td class="px-6 py-4 text-center w-20">
                                            <img src=" {{ $lot_in_product->master_products->mas_prod_image }} ">

                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            {{ $lot_in_product->master_products->mas_prod_name }}
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            {{ $lot_in_product->master_products->mas_prod_barcode }}
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            {{ $lot_in_product->master_products->categories->cat_name }}
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            {{ $lot_in_product->inbound_exp }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ $lot_in_product->inbound_amount }}
                                        </td>


                                        <td class="px-6 py-4 flex gap-3 text-gray-500 justify-center">
                                            <a>
                                                <i onclick="onclick_edit_inbound({{ $lot_in_product }})" class=" fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105">
                                                </i>
                                            </a>
                                            |
                                            <a>
                                                <i class="fa-solid fa-trash-can text-[1.5rem] hover:text-red-500 hover:scale-105"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex justify-center my-4 ">
                    {{ $lot_in_products->links('pagination::custom-pagination') }}
                </div>
            </div>
        </div>
    </div>
    <script>
        const onclick_edit_inbound = (lot_in_product) => {
            Swal.fire({
                title: "เพิ่มสินค้าในล็อต",
                html: `<div class="w-full">
                    <div class="w-full gap-1">
                        <label class="block text-sm font-medium text-gray-700 text-left">ชื่อสินค้า :</label>
                        <input type="text" value="${lot_in_product.master_products.mas_prod_name}" class="swal2-input w-full cursor-pointer border input-primary py-2 px-2 bg-slate-200" disabled>
                    </div>
                    <div class="w-full gap-1">
                        <label class="block text-sm font-medium text-gray-700 text-left">บาร์โค้ด :</label>
                        <input type="text" value="${lot_in_product.master_products.mas_prod_barcode }" class="swal2-input w-full cursor-pointer border input-primary py-2 px-2 bg-slate-200" disabled>
                    </div>
                    <div class="w-full gap-1">
                        <label class="block text-sm font-medium text-gray-700 text-left">ประเภท :</label>
                        <input type="text" value="${lot_in_product.master_products.categories.cat_name }" class="swal2-input w-full cursor-pointer border input-primary py-2 px-2 bg-slate-200" disabled>
                    </div>
                    <div class="gap-1">
                        <label class="block text-sm font-medium text-gray-700 text-left">วันหมดอายุ :</label>
                        <input type="date" class="swal2-input w-full cursor-pointer border input-primary py-2 px-2">
                    </div>
                    <div class="w-full gap-1">
                        <label class="block text-sm font-medium text-gray-700 text-left">จำนวนสินค้า :</label>
                        <input type="number" class="swal2-input w-full cursor-pointer border input-primary py-2 px-2">
                    </div>

                  </div>`,
                showCancelButton: true,
                confirmButtonColor: '#2f67ff',
                confirmButtonText: "ยืนยัน",
                cancelButtonText: "ยกเลิก",
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    // if confirm ยังไม่ทำนะ
                    if (!isNaN(quantity) && !parseInt(quantity) >= 0) {
                        localStorage.setItem('products_cart', JSON.stringify(products_in_cart_localstorage));
                        product['exp'] = document.querySelector(`#date`).value;
                        refresh_cart_table();
                    }
                }
            });
        }
        const onclick_add_inbound = () => {
            Swal.fire({
                title: "แก้ไขรายการสินค้ารับเข้า",
                html: `
                <div class="line"></div>
                    <div class="flex gap-2">
                        <div class="mb-3">
                            <div>
                                <p class="text-black/70 text-sm">ค้นหา</p>
                                <input type="text" placeholder="กรอกรายละเอียดที่ต้องการค้นหา..." class="input-primary h-[3rem]" name="" id="">
                            </div>
                        </div>
                        <div class="md:w-[15rem]">
                            <div>
                                <p class="text-black/70 text-sm">ค้นหาด้วย</p>
                                <select name="" id="" class="w-full h-[3rem] input-primary px-2">
                                        <option value="">ทั้งหมด</option>
                                        <option value="">บาร์โคด</option>
                                        <option value="">หมายเลขล็อต</option>
                                </select>
                            </div>
                        </div>
                        <div class="md:w-[10rem] h-full mt-5">
                                <div class="w-full">
                                    <button class="w-full h-[3rem] gap-2 btn-primary flex items-center justify-center mx-2">
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

                        <div class="w-full mt-2 rounded-t-md">
                            <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                                <b class="mx-2 mt-2 text-lg text-black uppercase">ตารางสินค้า</b>

                            </div>
                        <div class="relative overflow-x-auto shadow-md">
                            <table class="w-full text-sm text-left rtl:text-right">
                                <thead class="text-xs text-white uppercase bg-[#212529]">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center">ลำดับ</th>
                                        <th scope="col" class="px-6 py-3 text-center">รูปภาพ</th>
                                        <th scope="col" class="px-6 py-3 text-center">ชื่อ</th>
                                        <th scope="col" class="px-6 py-3 text-center">บาร์โค้ด</th>
                                        <th scope="col" class="px-6 py-3 text-center">ประเภท</th>
                                        <th scope="col" class="px-6 py-3 text-center">เพิ่มจำนวน</th>
                                        <th scope="col" class="px-6 py-3 text-center">เพิ่มเข้าตระกร้า</th>
                                    </tr>
                                </thead>
                            <tbody>
                                @foreach ($master_products as $index => $master_product)
                                    <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">
                                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-center">{{ $index + 1 }}</th>
                                    <td class="px-6">
                                    <div class="w-[3rem] h-[2rem] border">
                                        <img class="object-cover w-full h-full" src={{ $master_product->mas_prod_image }} alt="">
                                    </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">{{ $master_product->mas_prod_name }}</td>
                                    <td class="px-6 py-4 text-center">{{ $master_product->mas_prod_barcode }}</td>
                                    <td class="px-6 py-4 text-center">{{ $master_product->categories->cat_name }}</td>

                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center items-center">
                                            <a href="javascript:void(0)" class="bg-slate-400 rounded-l-lg hover:bg-slate-500 w-8 h-10 items-center flex border-none" onclick="decreaseQuantity(this)">
                                                <i class="fa-solid fa-minus p-1.5"></i>
                                            </a>
                                            <div class="pl-2 pr-2 pt-[2px] pb-[2.5px] bg-white bg-transparent ">
                                                <input class="w-6 h-8 text-center quantity focus:outline-none bg-transparent" type="number" id="quantity{{ $master_product->mas_prod_id }}" value="1">
                                            </div>
                                            <a href="javascript:void(0)" class="bg-slate-400 rounded-r-lg hover:bg-slate-500 w-8 h-10 items-center flex" onclick="increaseQuantity(this)">
                                                <i class="fa-solid fa-plus p-1.5 text-lg"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <div>
                                            <i onclick="onclick_add({{ $master_product }})" class="fa-solid fa-circle-plus text-green-500 text-[1.5rem] hover:text-green-600 hover:text-[1.8rem]"></i>
                                        </div>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonColor: '#2f67ff',
                confirmButtonText: "ตกลง",
                cancelButtonText: "ยกเลิก",
                showLoaderOnConfirm: true,
                width: '80%',
                heightAuto: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    // if confirm ยังไม่ทำนะ
                    if (!isNaN(quantity) && !parseInt(quantity) >= 0) {
                        localStorage.setItem('products_cart', JSON.stringify(products_in_cart_localstorage));
                        product['exp'] = document.querySelector(`#date`).value;
                        refresh_cart_table();
                    }
                }
            });
        }

        const onclick_add = (master_product) => {
            console.log(master_product.mas_prod_id);
            const amount = document.getElementById(`quantity${master_product.mas_prod_id}`).value;
            console.log(amount)
            Swal.fire({
                title: "รายละเอียดสินค้า",
                html: `<div class="w-full ">
                    <div class="w-full gap-1 mb-1 flex ]">
                        <label class="block font-bold text-gray-700 text-left">ชื่อสินค้า : </label>
                        <label class="block font-medium text-gray-700 text-left">${master_product.mas_prod_name}</label>
                    </div>
                    <div class="w-full gap-1 mb-1 flex">
                        <label class="block font-bold text-gray-700 text-left">บาร์โค้ด : </label>
                        <label class="block font-medium text-gray-700 text-left">${master_product.mas_prod_barcode }</label>
                    </div>
                    <div class="w-full gap-1 mb-1 flex">
                        <label class="block font-bold text-gray-700 text-left">ประเภท : </label>
                        <label class="block font-medium text-gray-700 text-left">${master_product.categories.cat_name}</label>
                    </div>
                    <div class="w-full gap-1 mb-1 flex">
                        <label class="block font-bold text-gray-700 text-left">จำนวน : </label>
                        <label class="block font-medium text-gray-700 text-left"> ${amount} </label>
                    </div>
                    <div class="w-full gap-1 mb-1 flex">
                        <label class="block font-bold text-gray-700 text-left">แท็ก : </label>
                        <label class="block font-medium text-gray-700 text-left">

                        </label>
                    </div>
                    <div class="gap-1 mb-1">
                        <label class="block font-bold text-gray-700 text-left">วันหมดอายุ :</label>
                        <input type="date" class="swal2-input w-full cursor-pointer border input-primary py-2 px-2">
                    </div>


                  </div>`,
                showCancelButton: true,
                confirmButtonColor: '#2f67ff',
                confirmButtonText: "เพิ่มเข้าล็อต",
                cancelButtonText: "ยกเลิก",
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    // if confirm ยังไม่ทำนะ
                    if (!isNaN(quantity) && !parseInt(quantity) >= 0) {
                        localStorage.setItem('products_cart', JSON.stringify(products_in_cart_localstorage));
                        product['exp'] = document.querySelector(`#date`).value;
                        refresh_cart_table();
                    }
                }
            });
        }

        function decreaseQuantity(element) {
            let quantityElement = element.parentNode.parentNode.querySelector('.quantity');
            let quantity = parseInt(quantityElement.value);
            if (quantity > 0) {
                quantity--;
                quantityElement.value = quantity;
            }
        }

        function increaseQuantity(element) {
            let quantityElement = element.parentNode.parentNode.querySelector('.quantity');
            let quantity = parseInt(quantityElement.value);
            quantity++;
            quantityElement.value = quantity;
        }
    </script>
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .line {
            height: 2px;
            /* ความหนาของเส้น */
            background-color: rgb(82, 82, 82);
            /* สีของเส้น */
            width: 100%;
            /* ความยาวของเส้น ใช้ 100% เพื่อยืดเส้นให้เต็มความกว้างของหน้าจอ */
            margin: 20px 0;
            /* ระยะห่างจากองค์ประกอบอื่นๆ */
        }
    </style>
@endsection
