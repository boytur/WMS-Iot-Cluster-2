{{-- v_edit_outbound_order.blade.php
    Display from outbound order when press edit
    @author : Supatsara Youraksa
    @Create Date : 2024-04-02
      --}}

@extends('layouts.default')
@section('title', 'แก้ไขรายการสินค้าออก')

@section('content')
    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full ">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="{{ url('/product/outbounds') }}">สินค้า > ส่งออก > </a>
                    <a href="">&nbsp;แก้ไขรายการสินค้าออก</a>
                </div>
            </div>
        </div>
        <div style="height: calc(100vh - 8rem)" class="bg-[#F6F9FC] overflow-y-scroll flex flex-col w-full">
            <div class="flex justify-end">
                <div class=" lg:pt-0 mr-2 mt-2 mb-1">

                    <button onclick="popup_edit_outbound_add_products()">
                        <a class="btn-primary px-4 flex items-center h-[3rem] gap-1">
                            <div>
                                <div class="flex items-center gap-1">
                                    <i class="fa-solid fa-circle-plus text-[0.8rem] "></i>
                                    <div>
                                        <p class="lg:text-sm lg:block hidden">เพิ่มสินค้า</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </button>
                </div>
            </div>

            <div class=" mt-1 rounded-t-md mx-2">
                <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                    <b class="mx-2  mt-2 text-lg text-black   ">
                        รายละเอียด</b>
                </div>
                <div class="relative overflow-x-auto shadow-md">
                    <p class="mx-2  mt-2"></p>
                    <p class="mx-2  mt-1">
                        <b>วันที่เพิ่ม: </b>
                        {{ date('d/m/Y', strtotime($lot_out->created_at)) }}
                    </p>
                    <p class="mx-2  mt-1">
                        <b>เพิ่มโดย: </b>
                        {{ $lot_out->users->fname . ' ' . $lot_out->users->lname }}

                    </p>
                    <p class="mx-2  mt-1">
                        <b>หมายเลขล็อต: </b>
                        {{ $lot_out->lot_out_number }}

                    </p>
                    <p class="mx-2  mt-2"></p>
                </div>
            </div>

            <div class=" mt-2 rounded-t-md mx-3">
                <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                    <b class="mx-2  mt-2 text-lg text-black   ">
                        ตารางรายการสินค้า</b>
                </div>
                <div class="relative overflow-x-auto shadow-md">
                    <table class="w-full text-sm text-left rtl:text-right ">
                        <thead class="text-xs text-white uppercase bg-[#000000]">
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
                                    จำนวน
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    การกระทำ
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lot_out_prod as $index => $OutBoundOrder)
                                <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">

                                    <td class="px-6 py-4 font-medium whitespace-nowrap">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-6 py-4 w-20">
                                        <img src="{{ $OutBoundOrder->master_products->mas_prod_image }}" alt="">

                                    </td>

                                    <td class="px-6 py-4">

                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $OutBoundOrder->master_products->mas_prod_barcode }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $OutBoundOrder->master_products->categories->cat_name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $OutBoundOrder->outbound_amount }}
                                    </td>

                                    <td class="px-6 py-4 flex gap-3 text-gray-500 justify-center">
                                        <a>
                                            <i
                                                class="fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105"></i></a>
                                        |

                                        <i
                                            class="fa-solid fa-trash-can text-[1.5rem] hover:text-red-500 hover:scale-105"></i></a>
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-center my-4">
                {{ $lot_out_prod->links('pagination::custom-pagination') }}
            </div>
        </div>

    </div>


    <script defer>
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

    <script>
        async function add_product_to_lot_out(selectedProduct, lot_out) {
            // here
            var quantity = $(`#quantity${selectedProduct}`).val();
            const data = {
                selectedProduct: selectedProduct,
                lot_out: lot_out,
                amount_product: quantity
            };

            console.log(data);

            const cluster = '{{ env('CLUSTER') }}';

            //ส่งคำขอสร้างรายการสินค้าเข้า
            const response = await fetch(`${cluster}/product/outbounds/edit-outbound-order/${lot_out}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data) // ไม่ต้องใช้ { data } แล้วเพราะ data อยู่แล้ว
            });
            //console.log(response);
            if (response.status === 200) {
                Swal.fire({
                    'icon': 'success',
                    'title': 'success',
                    'text': "เพิ่มรายการสินค้าเข้าสำเร็จ!",
                });
                window.location.reload();
            } else {
                Swal.fire({
                    'icon': 'error',
                    'title': 'error',
                    'text': "เกิดข้อผิดพลาดบางอย่าง"
                });
            }
        }


        const popup_edit_outbound_add_products = () => {

            Swal.fire({
                title: 'เพิ่มสินค้าในล็อต',
                text: "You won't be able to revert this!",
                html: `
                        <div class="w-full flex">
                            <div class="w-3/4 flex gap-2 h-full">
                                <div class="w-full">
                                    <div>
                                        <p class="text-black/70 text-sm">ค้นหาสินค้า</p>
                                        <input type="text" placeholder="กรอกรายละเอียดที่ต้องการค้นหา..."
                                            class="input-primary h-[3rem] w-full" name="" id="">
                                    </div>
                                </div>
                                <div class="md:w-[15rem]">
                                    <div>
                                        <p class="text-black/70 text-sm">ค้นหาด้วย</p>
                                        <select name="" id="" class="w-full h-[3rem] input-primary px-2 cursor-pointer">
                                            <option value="">บาร์โค้ด</option>
                                            <option value="">หมายเลขสินค้า</option>
                                            <option value="">ชื่อสินค้า</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="md:w-[10rem] h-full mt-5">
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
                        </div>

                        <div class="w-full bg-black/20 mt-2 rounded-md over-auto">
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
                                                บาร์โค้ด
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                ประเภทสินค้า
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
                                        @foreach ($products as $index => $product)
                                        <div class="over-flow">
                                            <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">
                                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                                {{ $index + 1 }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $product->mas_prod_no }}
                                            </td>
                                            <td class="px-6">
                                                <div class=" w-[3rem] h-[2rem] border">
                                                    <img class="object-cover w-full h-full" src={{ $product->mas_prod_image }}
                                                    alt="">
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $product->mas_prod_name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $product->mas_prod_barcode }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $product->categories->cat_name }}
                                            </td>
                                            <td>
                                                <div class="flex justify-center items-center">
                                                    <a href="javascript:void(0)"
                                                        class="bg-slate-400 rounded-l-lg hover:bg-slate-500 w-8 h-10 items-center flex border-none"
                                                        onclick="decrease_quantity(this)">
                                                        <i class="fa-solid fa-minus p-1.5 "></i></a>
                                                    <div class="pl-2 pr-2 pt-[2px] pb-[2.5px] bg-white bg-transparent">
                                                        <input
                                                            class="w-11 h-8 text-center quantity focus:outline-none bg-transparent"
                                                            type="number" id="quantity{{ $product->mas_prod_id }}"
                                                            value="1">
                                                    </div>
                                                    <a href="javascript:void(0)"
                                                        class="bg-slate-400 rounded-r-lg hover:bg-slate-500 w-8 h-10 items-center flex"
                                                        onclick="increase_quantity(this)">
                                                        <i class="fa-solid fa-plus p-1.5 text-lg"></i></a>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 text-center">

                                                    <div onclick="add_product_to_lot_out({{ $product->mas_prod_id }},{{ $lot_out->lot_out_id }})">
                                                        <i class="fa-solid fa-circle-plus text-green-500 text-[1.5rem] hover:text-green-600 hover:text-[1.8rem]"></i>
                                                    </div>

                                            </td>


                                            @endforeach
                                        </tr>
                                    </div>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    `,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                customClass: {
                    // กำหนดคลาส CSS สำหรับกล่องข้อความของ Swal.fire
                    container: 'swal-container',
                    popup: 'swal-popup',
                    header: 'swal-header',
                    title: 'swal-title',
                    closeButton: 'swal-close-button',
                    icon: 'swal-icon',
                    image: 'swal-image',
                    content: 'swal-content',
                    input: 'swal-input',
                    actions: 'swal-actions',
                    confirmButton: 'swal-confirm-button',
                    cancelButton: 'swal-cancel-button',
                    footer: 'swal-footer'
                },
            }).then((result) => {

            });

        }
    </script>




    <style>
        .swal-popup {
            width: 80%;
        }
    </style>




@endsection
