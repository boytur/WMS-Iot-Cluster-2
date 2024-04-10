{{-- v_create_outbound_order.blade.php
    Display create outbound order
    @author : Chaimanat Aepsuk 65160215
    @Create date : 2024-04-02
    version : 1.0.1 --}}
@extends('layouts.default')
@section('title', 'เพิ่มสินค้าส่งออก')
@section('content')

    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="{{ url('/product/outbounds') }}">สินค้า > ส่งออกเข้า > </a>
                    <a href="">&nbsp;สร้างรายการสินค้าส่งออก</a>
                </div>
            </div>
            <div class="w-full p-2">
                <div style="height: calc(100vh - 7.7rem)" class="rounded-sm  overflow-y-scroll">
                    <div class="w-full p-5 bg-white rounded-md">
                        <div class=" w-full flex ">

                            {{-- search input --}}
                            <div class="w-3/4 flex gap-2 ">
                                <div class="w-full">
                                    <div>
                                        <p class="text-black/70 text-sm">ค้นหา</p>
                                        <input type="text" placeholder="กรอกรายละเอียดที่ต้องการค้นหา..."
                                            class="input-primary h-[3rem]" name="" id="search_key">
                                    </div>
                                </div>
                                <div class="md:w-[15rem]">
                                    <div>
                                        <p class="text-black/70 text-sm">ค้นหาด้วย</p>
                                        <select name="" id="search_attribute"
                                            class="w-full h-[3rem] input-primary px-2">
                                            <option value="mas_prod_all">ทั้งหมด</option>
                                            <option value="mas_prod_barcode">บาร์โคด</option>
                                            <option value="mas_prod_no">หมายเลขล็อต</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="md:w-[15rem]">
                                    <div>
                                        <p class="text-black/70 text-sm">การส่งออก</p>
                                        <select name="" id="search_sort" class="w-full h-[3rem] input-primary px-2">
                                            <option value="FI_FO">FI/FO</option>
                                            <option value="IN_WH">สินค้าภายใน</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="md:w-[10rem] h-full  mt-5">
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
                            {{-- added LotOut inbound --}}
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
                                        href="{{ url('/product/outbounds/view-outbound-latest') }}">
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
                                                <i class="fa-regular fa-file-lines text-[1.3rem] mt-[2px]"></i>

                                                <p id="cart-amount"
                                                    class="w-[1rem] h-[1rem] bg-red-500 rounded-full text-white flex items-center justify-center right-[-1rem] top-[-8px] py-1 mb-1 absolute">
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
                                                        <button onclick="create_outbound_order()" id="btn-create-lot-out"
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

                    <div class="w-full bg-black/20 mt-2 rounded-md">
                        <div class="py-2 w-full bg-[#D9D9D9] sm:rounded-lg">
                            <b class="mx-2  mt-2 rounded-md text-black text-lg" id="product_count">
                                ตารางรายการสินค้าที่พบ
                            </b>
                        </div>
                        <div class="relative overflow-x-auto shadow-md ">
                            <table class="w-full text-sm text-left rtl:text-right bg-[#212529] ">
                                <thead class="text-xs text-white uppercase ">
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
                                            แท็ก
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            ประเภท
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            เพิ่มจำนวน
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            เพิ่มรายการเข้า
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="lot_out_product_table">
                                    @foreach ($master_products as $index => $master_product)
                                        <tr class="bg-white border-b  hover:bg-blue-100 cursor-pointer ">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium whitespace-nowrap text-center">
                                                {{ $index + 1 }}
                                            </th>
                                            <td class="flex justify-center px-6 text-center">
                                                <img src="{{ $master_product->mas_prod_image }}" class=" w-20"
                                                    alt="">
                                            </td>

                                            <td class="px-6 py-4 text-center">
                                                {{ $master_product->mas_prod_name }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $master_product->mas_prod_barcode }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                @if (count($master_product->tags) > 0)
                                                    @foreach ($master_product->tags as $tag)
                                                        {{ $tag['tag_name'] }}
                                                    @endforeach
                                                @else
                                                    <p>-</p>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $master_product->categories->cat_name }}
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
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div onclick="add_product_cart({{ json_encode($master_product) }})">
                                                    <i
                                                        class="fa-solid fa-circle-plus text-green-500 text-lg hover:text-green-600 hover:text-[1.5em]">
                                                    </i>
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

        <script>
            //เพิ่มจำนวนตัวเลขบน cart
            const cart_amount = document.querySelector('#cart-amount');
            let products_out_cart_localstorage = JSON.parse(localStorage.getItem('products_outorder_cart') || '[]');
            cart_amount.textContent = products_out_cart_localstorage.length;

            /*remove_product_from_cart()
             * @author: Piyawat Wongyat 65160340
             * @create date: 2024-04-05
             */

            const remove_product_from_cart = (index) => {
                //ดึงข้อมูลสินค้าใน localstorage มาเก็บแล้วลบ
                let products_in_cart = JSON.parse(localStorage.getItem('products_outorder_cart') || '[]');
                products_in_cart.splice(index, 1);

                //เอาข้อมูลใหม่ใส่เข้าไปใน lacalstorage
                localStorage.setItem('products_outorder_cart', JSON.stringify(products_in_cart));
                const cart = document.querySelector('#cart-popup');
                cart.classList.toggle('md:block');

                //อัพเดตข้อมูลตาราง
                refresh_cart_table();
            }

            /*refresh_cart_table()
             * @author: Piyawat Wongyat 65160340
             * @create date: 2024-04-05
             */

            const refresh_cart_table = () => {

                //ดึงข้อมูลสินค้าใน localstorage
                let products_out_cart_localstorage = JSON.parse(localStorage.getItem('products_outorder_cart') || '[]');
                const cart_table = document.querySelector('#cart-table tbody');

                cart_table.innerHTML = '';

                //สร้างตารางใหม่จากข้อมูลใน localstorage
                products_out_cart_localstorage.forEach(function(product, index) {
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

                cart_amount.textContent = products_out_cart_localstorage.length;
            }

            /*
             * add_product_cart()
             * @author: Piyawat Wongyat 65160340
             * @create date: 2024-04-05
             */

            const add_product_cart = (product) => {
                console.log(product);

                let products_out_cart_localstorage = JSON.parse(localStorage.getItem('products_outorder_cart') || '[]');
                const quantity = document.querySelector(`#quantity${product['mas_prod_id']}`).value;

                // add quantity to products
                if (!isNaN(quantity) && !parseInt(quantity) >= 0) {
                    product['amount'] = parseInt(quantity);
                    products_out_cart_localstorage.push(product);
                }

                // add product details be before add to cart
                Swal.fire({
                    title: "รายละเอียดสินค้า",
                    html: `<div class="w-full">
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

                            </div>`,
                    showCancelButton: true,
                    confirmButtonColor: '#2f67ff',
                    confirmButtonText: "เพิ่มเข้าตะกร้า",
                    cancelButtonText: "ยกเลิก",
                    showLoaderOnConfirm: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        localStorage.setItem('products_outorder_cart', JSON.stringify(
                            products_out_cart_localstorage));
                        refresh_cart_table();
                    }
                });
            }

            /*
             * toggle_cart_open()
             * @author: Piyawat Wongyat 65160340
             * @create date: 2024-04-05
             */

            const toggle_cart_open = () => {
                const cart = document.querySelector('#cart-popup');
                cart.classList.toggle('md:block');
                refresh_cart_table();
            }

            /*
             * create_inbound_order()
             * @author: Piyawat Wongyat 65160340
             * @create date: 2024-04-06
             */

            const create_outbound_order = async () => {
                const products = JSON.parse(localStorage.getItem('products_outorder_cart') || '[]');

                const selected_value = search_sort.value;
                const sort_selects = JSON.stringify(selected_value);

                const payload = {
                    products,
                    sort_selects
                };

                if (products.length <= 0) {
                    Swal.fire({
                        'icon': 'warning',
                        'title': 'กรุณาเลือกสินค้าเข้ารถเข็น',
                        confirmButtonColor: '#2f67ff',
                    });

                    return;
                }

                const cluster = '{{ env('CLUSTER') }}';

                //ส่งคำขอสร้างรายการสินค้าเข้า
                const response = await fetch(`${cluster}/product/outbounds/create-outbound-order`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        payload
                    })
                });
                //console.log(response);
                if (response.status === 200) {
                    Swal.fire({
                        'icon': 'success',
                        'title': 'success',
                        'text': "สร้างรายการส่งออกสำเร็จ!",

                    });
                    localStorage.setItem('products_outorder_cart', []);
                } else {
                    Swal.fire({
                        'icon': 'error',
                        'title': 'error',
                        'text': "เกิดข้อผิดพลาดบางอย่าง"
                    });
                }
            }
            /*
             * search_productn()
             * @author: Pichawat Suwan 65160346
             * @create date: 2024-04-07
             */
            let searches;
            let categories;
            let sort_value;
            const search_product = async () => {
                try {
                    //ดึงค่า
                    const search_key = document.getElementById("search_key").value;
                    const search_attribute = document.getElementById("search_attribute").value;
                    const search_sort = document.getElementById("search_sort").value
                    const cluster = '{{ env('CLUSTER') }}';
                    //ส่ง req
                    const response = await fetch(`${cluster}/product/outbounds/create-outbound-order`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            search_key,
                            search_attribute,
                            search_sort
                        })
                    });


                    if (response.ok) {
                        const responseData = await response.json();
                        searches = responseData.data;
                        categories = responseData.cats;
                        sort_value = responseData.sort;
                        const search_product_table = document.getElementById("lot_out_product_table");
                        search_product_table.innerHTML = ""; // Clear previous results
                        if (searches?.length === 0) {
                            // Display message when no results are found
                            search_product_table.innerHTML =
                                `<tr><td colspan="5">ไม่พบรายการสินค้า</td></tr>`;
                            document.getElementById('product_count').innerText = 0;
                        } else {
                            searches?.map((search, index) => {

                                const row = `
                                    <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer" >
                                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-center">
                                            ${ index + 1 }
                                        </th>
                                        <td class="px-6">
                                            <div class=" w-[3rem] h-[2rem] border">
                                                <img class="object-cover w-full h-full" src=${
                                                    search.mas_prod_image }
                                                alt="">
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            ${ search.mas_prod_name }
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            ${ search.mas_prod_barcode }
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            ${categories.map((cats, index) => {return search.cat_id === cats.cat_id ? cats.cat_name : ''}).join('')}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            ${search.tags.map(tag => tag.tag_name).join(' ')}
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
                                                        type="number" id="quantity_search${search.mas_prod_id}"
                                                        value="1">
                                                </div>
                                                <a href="javascript:void(0)"
                                                    class="bg-slate-400 rounded-r-lg hover:bg-slate-500 w-8 h-10 items-center flex"
                                                    onclick="increase_quantity(this)">
                                                    <i class="fa-solid fa-plus p-1.5 text-lg"></i></a>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            <div onclick="add_product_cart_search(${search.mas_prod_id},${categories.map((cats, index) => {return search.cat_id === cats.cat_id ? cats.cat_id : ''}).join('')})">
                                                <i
                                                    class="fa-solid fa-circle-plus text-green-500 text-[1.5rem] hover:text-green-600 hover:text-[1.8rem]"></i>
                                            </div>
                                        </td>
                                    </tr>
                                    </tr>
                                `;
                                search_product_table.innerHTML += row;


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
            const add_product_cart_search = (mas_prod_id, cat_id) => {
                try {
                    // Filter products by mas_prod_id
                    let master_prod = searches.filter((prod) => prod.mas_prod_id === mas_prod_id);
                    let cat_prod = categories.find((cats) => cats.cat_id === cat_id);

                    // Check if product exists
                    if (master_prod.length > 0) {
                        const quantity = document.getElementById(`quantity_search${master_prod[0].mas_prod_id}`).value;

                        let newProduct = {
                            ...master_prod[0],
                            amount: quantity,
                            categories: cat_prod
                        };
                        let product = newProduct
                        console.log(product)
                        // add quantity to products
                        if (!isNaN(quantity) && !parseInt(quantity) >= 0) {
                            product['amount'] = parseInt(quantity);
                            products_out_cart_localstorage.push(product);
                        }

                        // add product details be before add to cart
                        Swal.fire({
                            title: "รายละเอียดสินค้า",
                            html: `<div class="w-full">
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

                            </div>`,
                            showCancelButton: true,
                            confirmButtonColor: '#2f67ff',
                            confirmButtonText: "เพิ่มเข้าตะกร้า",
                            cancelButtonText: "ยกเลิก",
                            showLoaderOnConfirm: true,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                localStorage.setItem('products_outorder_cart', JSON.stringify(
                                    products_out_cart_localstorage));
                                refresh_cart_table();
                            }
                        });
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
