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
                                    <div class="md:w-[15rem]">
                                        <div>
                                            <p class="text-black/70 text-sm">การส่งออก</p>
                                            <select name="" id="" class="w-full h-[3rem] input-primary px-2">
                                                <option value="">FI/FO</option>
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
                                {{-- added LotOut inbound --}}
                                <div class="w-full flex justify-end gap-3 mt-3">
                                    <div class=" items-center flex h-full relative">
                                        <i class="fa-solid fa-truck lg:text-[2rem] text-sm cursor-pointer lg:mt-4"></i>
                                        <div class="absolute flex top-4 left-[-8px]">
                                            <p
                                                class="w-[1rem] h-[1rem] bg-red-500 rounded-full text-white flex items-center justify-center py-1 mb-1">
                                                1
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-3 lg:pt-0">
                                        <a class="btn-secondary px-4 flex items-center h-[3rem] gap-1"
                                            href="{{ url('product/outbounds/view-outbound-latest') }}">
                                            <div>
                                                <div class="flex items-center gap-1">
                                                    <i
                                                        class="fa-solid fa-clock-rotate-left cursor-pointer text-[0.8rem] mt-[2px]">
                                                    </i>
                                                    <div>
                                                        <p class=" md:text-sm lg:block hidden text-[0.5]">รายการล่าสุด</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="mt-3 lg:pt-0">
                                        <a class="btn-primary px-4 flex items-center h-[3rem] gap-1"
                                            href="{{ url('product/outbounds/added-outbound-order') }}">
                                            <div>
                                                <div class="flex items-center gap-1 m-[42px]">
                                                    <div class="flex top-4 left-[-8px]">
                                                        <div class=" relative">
                                                            <p
                                                                class=" absolute left-2 top-[-0.5em]  w-[1rem] h-[1rem] bg-red-500 rounded-full text-white flex items-center justify-center py-1 mb-1">
                                                                1
                                                            </p>
                                                        </div>
                                                        <i class="fa-regular fa-file-lines text-[1.3rem] mt-[2px]"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full bg-black/20 mt-2 rounded-md">
                            <div class="py-2 w-full bg-[#D9D9D9] sm:rounded-lg">
                                <b class="mx-2  mt-2 rounded-md text-black text-lg">
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
                                    <tbody>
                                        @foreach ($master_products as $index => $master_product)

                                            <tr class="bg-white border-b  hover:bg-blue-100 cursor-pointer ">
                                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-center">
                                                    {{ $index + 1 }}
                                                </th>
                                                <td class="flex justify-center px-6 text-center">
                                                    <img src="{{$master_product->mas_prod_image }}" class=" w-20" alt="">
                                                </td>

                                                <td class="px-6 py-4 text-center">
                                                    {{ $master_product->mas_prod_name }}
                                                </td>
                                                <td class="px-6 py-4 text-center">
                                                    {{ $master_product->mas_prod_barcode }}
                                                </td>
                                                <td class="px-6 py-4 text-center">
                                                    รอมีแท็กน้าาาา
                                                </td>
                                                <td class="px-6 py-4 text-center">
                                                    {{ $master_product->categories->cat_name }}
                                                </td>
                                                <td class="px-6 py-4 text-center">

                                                    <div class="flex justify-center items-center">
                                                        <a href="javascript:void(0)" class="bg-slate-400 rounded-l-lg hover:bg-slate-500" onclick="decreaseQuantity(this)"><i class="fa-solid fa-minus p-1.5"></i></a>
                                                        <div class="pl-2 pr-2 pt-[2px] pb-[2.5px] bg-white border border-slate-400">
                                                            <p class="quantity"> 0 </p>
                                                        </div>
                                                        <a href="javascript:void(0)" class="bg-slate-400 rounded-r-lg hover:bg-slate-500" onclick="increaseQuantity(this)"><i class="fa-solid fa-plus p-1.5"></i></a>
                                                    </div>
                                                </td>
                                                <script>
                                                    function decreaseQuantity(element) {
                                                        var quantityElement = element.parentNode.parentNode.querySelector('.quantity');
                                                        var quantity = parseInt(quantityElement.textContent);
                                                        if (quantity > 0) {
                                                            quantity--;
                                                            quantityElement.textContent = quantity;
                                                        }
                                                    }

                                                    function increaseQuantity(element) {
                                                        var quantityElement = element.parentNode.parentNode.querySelector('.quantity');
                                                        var quantity = parseInt(quantityElement.textContent);
                                                        quantity++;
                                                        quantityElement.textContent = quantity;
                                                    }
                                                </script>
                                                </td>
                                                <td class="px-6 py-4 text-center">
                                                    <a><i class="fa-solid fa-circle-plus text-green-500 text-lg hover:text-green-600 hover:text-[1.5em]"></i></a>
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

        @endsection
