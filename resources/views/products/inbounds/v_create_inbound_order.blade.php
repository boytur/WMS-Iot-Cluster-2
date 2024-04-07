{{--

*v_create_inbound_order.php

*Display detail create inbound order

*@auther : Phuriphat Khumsuan 65160096

*@Create Date : 2024-04-02

*version : 1.0.1

--}}
@extends('layouts.default')
@section('title', 'เพิ่มสินค้าเข้าคลัง')

@section('content')

<div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
    <div class="mt-[5rem] md:mt-0">
        <div class=" w-full h-[3rem] ">
            <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                <a href="{{ url('/product/outbounds') }}">สินค้า > รับเข้า > </a>
                <a href="">&nbsp;เพิ่มสินค้าเข้าคลัง</a>
            </div>
        </div>

        <div class="w-full p-2">
            <div style="height: calc(100vh - 7.7rem)" class="rounded-sm  overflow-y-scroll">

                <div class="w-full p-5 bg-white rounded-md">
                    <div class=" w-full flex">

                        {{-- search input --}}
                        <div class="w-3/4 flex gap-2 h-full">
                            <div class="w-full">
                                <div>
                                    <p class="text-black/70 text-sm">ค้นหาสินค้า</p>
                                    <input type="text" placeholder="กรอกรายละเอียดที่ต้องการค้นหา..."
                                        class="input-primary h-[3rem]" name="" id="">
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
                            <div class="md:w-[10rem] h-full  mt-5">
                                <div class="w-full">
                                    <button
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

                        {{-- cart product inbound --}}
                        <div class="w-full flex justify-end gap-3 mt-3">
                            <div class=" items-center flex h-full relative">
                                <i class="fa-solid fa-truck lg:text-[2rem] text-sm cursor-pointer lg:mt-4"></i>
                                <div class="absolute flex top-4 left-[-8px]">
                                    <p
                                        class="w-[1rem] h-[1rem] bg-red-500 rounded-full text-white flex items-center justify-center py-1 mb-1">
                                        1</p>
                                </div>
                            </div>
                            <div class="mt-3 lg:pt-0">
                                <a class="btn-secondary px-4 flex items-center h-[3rem] gap-1"
                                    href="{{ url('/product/inbounds/view-inbound-latest') }}">
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
                                <div onclick="toggle_cart_open()"
                                    class="btn-primary px-8 flex items-center h-[3rem] gap-1">
                                    <div class="relative">
                                        <div class="flex items-center gap-1 relative">
                                            <i class="fa-solid fa-cart-shopping text-[0.8rem] mt-[2px]"></i>
                                            <p id="cart-amount"
                                                class="w-full h-full p-2 bg-red-500 rounded-full text-white flex items-center justify-center right-[-1rem] top-[-8px] py-1 mb-1 absolute">
                                                0</p>
                                        </div>
                                        <div id="cart-popup"
                                            class="w-[45rem] mb-3 absolute hidden mt-10 mr-12 rounded-md bg-white shadow-lg border  left-[-42rem]   p-1 z-50 text-black">
                                            <p class="text-center">ตระกร้าสินค้า</p>

                                            <div class="overflow-x-auto shadow-md max-h-[25rem] overflow-y-scroll">
                                                <table id="cart-table" class="w-full text-sm text-left rtl:text-right">
                                                    <thead class="text-xs text-white uppercase bg-[#212529]">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3 text-center">รูปภาพ</th>
                                                            <th scope="col" class="px-6 py-3 text-center">
                                                                ชื่อ
                                                            </th>

                                                            <th scope="col" class="px-6 py-3 text-center">
                                                                ประเภท
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 text-center">
                                                                จำนวน
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 text-center">
                                                                ลบ
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                                <div class="mt-2">
                                                    <button onclick="create_inbound_order()" id="btn-create-lot-in"
                                                        class="btn-primary w-full px-2 py-2">
                                                        เพิ่มสินค้าเข้าคลัง
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- table product --}}
                <div class="w-full mt-2 rounded-t-md">
                    <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                        <b class="mx-2  mt-2 text-lg text-black uppercase   ">
                            ตารางสินค้า</b>
                    </div>
                    <div class="relative overflow-x-auto shadow-md">
                        <table class="w-full text-sm text-left rtl:text-right">
                            <thead class="text-xs text-white uppercase bg-[#212529] ">
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
                                        ประเภท
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        แท็ก
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        เพิ่มจำนวน
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        เพิ่มเข้าตระกร้า
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($master_products as $index => $master_product)
                                <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">
                                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-center">
                                        {{ $index + 1 }}
                                    </th>
                                    <td class="px-6">
                                        <div class=" w-[3rem] h-[2rem] border">
                                            <img class="object-cover w-full h-full" src={{
                                                $master_product->mas_prod_image }}
                                            alt="">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $master_product->mas_prod_name }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $master_product->mas_prod_barcode }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $master_product->categories->cat_name }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if(count($master_product->tags) > 0)
                                        @foreach ($master_product->tags as $tag)
                                        {{ $tag['tag_name'] }}
                                        @endforeach
                                        @else
                                        <p>-</p>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center items-center">
                                            <a href="javascript:void(0)"
                                                class="bg-slate-400 rounded-l-lg hover:bg-slate-500 w-8 h-10 items-center flex border-none"
                                                onclick="decrease_quantity(this)">
                                                <i class="fa-solid fa-minus p-1.5 "></i></a>
                                            <div class="pl-2 pr-2 pt-[2px] pb-[2.5px] bg-white bg-transparent">
                                                <input
                                                    class="w-11 h-8 text-center quantity focus:outline-none bg-transparent"
                                                    type="number" id="quantity{{ $master_product->mas_prod_id }}"
                                                    value="1">
                                            </div>
                                            <a href="javascript:void(0)"
                                                class="bg-slate-400 rounded-r-lg hover:bg-slate-500 w-8 h-10 items-center flex"
                                                onclick="increase_quantity(this)">
                                                <i class="fa-solid fa-plus p-1.5 text-lg"></i></a>
                                        </div>

                                        <script>
                                            function decrease_quantity(element) {
                                                        let quantityElement = element.parentNode.parentNode.querySelector('.quantity');
                                                        let quantity = parseInt(quantityElement.value);
                                                        if (quantity > 0) {
                                                            quantity--;
                                                            quantityElement.value = quantity;
                                                        }
                                                    }

                                                    function increase_quantity(element) {
                                                        let quantityElement = element.parentNode.parentNode.querySelector('.quantity');
                                                        let quantity = parseInt(quantityElement.value);
                                                        quantity++;
                                                        quantityElement.value = quantity;
                                                    }
                                        </script>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <div onclick="add_product_cart({{ json_encode($master_product) }})">
                                            <i
                                                class="fa-solid fa-circle-plus text-green-500 text-[1.5rem] hover:text-green-600 hover:text-[1.8rem]"></i>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex justify-center my-4">
                    {{ $master_products->links('pagination::custom-pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    //เพิ่มจำนวนตัวเลขบน cart
        const cart_amount = document.querySelector('#cart-amount');
        let products_in_cart_localstorage = JSON.parse(localStorage.getItem('products_cart') || '[]');
        cart_amount.textContent = products_in_cart_localstorage.length;

        /*remove_product_from_cart()
        * @author: Piyawat Wongyat 65160340
        * @create date: 2024-04-05
        */

        const remove_product_from_cart = (index) => {
            //ดึงข้อมูลสินค้าใน localstorage มาเก็บแล้วลบ
            let products_in_cart = JSON.parse(localStorage.getItem('products_cart') || '[]');
            products_in_cart.splice(index, 1);

            //เอาข้อมูลใหม่ใส่เข้าไปใน lacalstorage
            localStorage.setItem('products_cart', JSON.stringify(products_in_cart));
            const cart = document.querySelector('#cart-popup');
            cart.classList.toggle('md:block');

            //อัพเดตข้อมูลตาราง
            refresh_cart_table();
        }

        /*refresh_cart_table()
        * @author: Piyawat Wongyat 65160340
        * @create date: 2024-04-05
        */

        const refresh_cart_table = ()=> {

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

        /*
            * add_product_cart()
            * @author: Piyawat Wongyat 65160340
            * @create date: 2024-04-05
        */

        const add_product_cart = (product) => {

            let products_in_cart_localstorage = JSON.parse(localStorage.getItem('products_cart') || '[]');
            const quantity = document.querySelector(`#quantity${product['mas_prod_id']}`).value;

            // add quantity to products
            if(!isNaN(quantity) && !parseInt(quantity) >= 0){
                product['amount'] = parseInt(quantity);
                products_in_cart_localstorage.push(product);
            }

            // add product details be before add to cart
            Swal.fire({
                title: "รายละเอียดสินค้า",
                html:
                `<div class="w-full">
                    <div calss="flex flex-row gap-1">
                       <div class="flex gap-2">
                            <p class="font-bold">ชื่อ:</p><span>${product.mas_prod_name}</span></br>
                       </div>
                        <div  class="flex gap-2">
                            <p class="font-bold">บาร์โค้ด:</p><span>${product.mas_prod_barcode}</span>
                        </div>
                        <div  class="flex gap-2">
                            <p class="font-bold">ประเภท:</p><span>${product.categories.cat_name}</span>
                        </div>
                        <div  class="flex gap-2">
                            <p class="font-bold">จำนวน:</p><span>${product.amount}</span>
                        </div>
                    </div>
                    <input id="date" type="date" class="swal2-input w-full cursor-pointer border input-primary py-2 px-2">
                </div>`,
                showCancelButton: true,
                confirmButtonColor: '#2f67ff',
                confirmButtonText: "เพิ่มเข้าตะกร้า",
                cancelButtonText: "ยกเลิก",
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    if(!isNaN(quantity) && !parseInt(quantity) >= 0){

                        if(document.getElementById('date').value === ""){
                            Swal.fire({
                                "title" : "กรุณาใส่วันหมดอายุ",
                                "icon": "warning"
                            });
                        }
                        else{
                            product['exp'] = document.querySelector(`#date`).value;
                            localStorage.setItem('products_cart', JSON.stringify(products_in_cart_localstorage));
                            refresh_cart_table();
                        }
                    }
                }
            });
        }

        /*
            * toggle_cart_open()
            * @author: Piyawat Wongyat 65160340
            * @create date: 2024-04-05
        */

        const toggle_cart_open = ()=>{
            const cart = document.querySelector('#cart-popup');
            cart.classList.toggle('md:block');
            refresh_cart_table();
        }

        /*
            * create_inbound_order()
            * @author: Piyawat Wongyat 65160340
            * @create date: 2024-04-06
        */

        const create_inbound_order = async () =>{
            const products = JSON.parse(localStorage.getItem('products_cart') || '[]');

            //ถ้าสินค้าไม่มีในตะกร้า
            if (products.length <= 0 ){
                Swal.fire({
                    'icon':'warning',
                    'title': 'กรุณาเลือกสินค้าเข้ารถเข็น',
                    confirmButtonColor: '#2f67ff',
                });

                return;
            }

            const cluster = '{{ env('CLUSTER') }}';

            //ส่งคำขอสร้างรายการสินค้าเข้า
            const response = await fetch(`${cluster}/product/inbounds/create-inbound-order`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ products })
              });
             //console.log(response);
              if(response.status === 200) {
                  Swal.fire({
                      'icon':'success',
                      'title': 'success',
                      'text': "สร้างรายการรับเข้าสำเร็จ!",

                  });
                  localStorage.setItem('products_cart',[]);
              }
              else{
                Swal.fire({
                    'icon':'error',
                    'title': 'error',
                    'text': "เกิดข้อผิดพลาดบางอย่าง"
                });
              }
        }
</script>
@endsection
