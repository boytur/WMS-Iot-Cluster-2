@extends('layouts.default')

@section('title', 'นำเข้าด้วยหมายเลขล็อต')
@section('content')

    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="">สินค้า > รับสินค้าเข้า</a>
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
                                        <p class="text-black/70 text-sm">ค้นหา</p>
                                        <input type="text" placeholder="กรอกรายละเอียดที่ต้องการค้นหา..."
                                            class="input-primary h-[3rem]" name="search_lot_in" id="search_lot_in">
                                    </div>
                                </div>
                                <div class="md:w-[23rem]">
                                    <div>
                                        <p class="text-black/70 text-sm">ค้นหาด้วย</p>
                                        <select name="search_attribute" id="search_attribute"
                                            class="w-full h-[3rem] input-primary px-2 cursor-pointer">
                                            <option value="number_lot_in">หมายเลขรายการรับเข้า</option>
                                            <option value="number_emp">รหัสพนักงาน</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="md:w-[15rem]">
                                    <div>
                                        <p class="text-black/70 text-sm">สถานะ</p>
                                        <select name="search_status" id="search_status"
                                            class="w-full h-[3rem] input-primary px-2">
                                            <option value="all">ทั้งหมด</option>
                                            <option value="Initialized">รอดำเนินการ</option>
                                            <option value="close_lot_in">ปิดล็อต</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="md:w-[10rem] h-full  mt-5">
                                    <div class="w-full">
                                        <button onclick="handle_search_inbounds()"
                                            class="w-full h-[3rem] gap-2 btn-primary flex items-center justify-center mx-2">
                                            <div>
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </div>
                                            <div type="submit">
                                                <p>ค้นหา</p>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>


                            {{-- add product inbound --}}
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
                                    <a class="btn-primary px-4 flex items-center h-[3rem] gap-1"
                                        href="{{ url('product/inbounds/create-inbound-order') }}">
                                        <div>
                                            <div class="flex items-center gap-1">
                                                <i class="fa-solid fa-circle-plus text-[0.8rem] mt-[2px]"></i>
                                                <div>
                                                    <p class="lg:text-sm lg:block hidden">เพิ่มสินค้าเข้าคลัง</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- table product --}}
                    <div class="w-full mt-2 rounded-t-md">
                        <div>ผลการค้นหาจำนวน <span id="lot_in_count">{{ $lot_in_products->count() }} </span> รายการ</div>
                        <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                            <b class="mx-2  mt-2 text-lg text-black uppercase   ">
                                ตารางรายการสินค้านำเข้ารอจัดการ</b>
                        </div>
                        <div class="relative overflow-x-auto shadow-md">
                            <table class="w-full text-sm text-left rtl:text-right ">
                                <thead class="text-xs text-white uppercase bg-[#212529]">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            ลำดับ
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            หมายเลขรายการรับเข้า
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            วันที่สร้าง
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center">
                                            ผู้สร้าง
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            สถานะ
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-center">
                                            การกระทำ
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="search_lot_in_table">
                                    @foreach ($lot_in_products as $index => $lot_in)
                                        <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">
                                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-center">
                                                {{ $index + 1 }}
                                            </th>
                                            <td class="px-6 py-4 text-center">
                                                {{ $lot_in->lot_in_number }}
                                            </td>

                                            <td class="px-6 py-4 text-center">
                                                {{ date('d/m/Y', strtotime($lot_in->created_at)) }}
                                            </td>

                                            <td class="px-6 py-4 text-center">
                                                {{ $lot_in->users->fname . ' ' . $lot_in->users->lname }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                @if ($lot_in->lot_in_status === 'Initialized')
                                                    <div>
                                                        <p
                                                            class="border text-center bg-[#666666] rounded-3xl py-1 text-white">
                                                            {{ $lot_in->lot_in_status }}</p>
                                                    </div>
                                                @else
                                                    <div>
                                                        <p
                                                            class="border text-center bg-green-700 rounded-3xl py-1 text-white ">
                                                            {{ $lot_in->lot_in_status }}</p>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 flex gap-3 text-gray-500 justify-center">
                                                <a href="{{ url('/product/inbounds/edit-inbound-order' . '/' . $lot_in->lot_in_id) }}"
                                                    class="">
                                                    <i
                                                        class="fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105"></i></a>
                                                |
                                                {{-- <a href="{{ url('/product/managements/detail/' . $lot_in->lot_in_id) }}">
                                            --}}
                                                <i onclick="delete_lot_inbound({{ $lot_in->lot_in_id }})"
                                                    class="fa-solid fa-trash-can text-[1.5rem] hover:text-red-500 hover:scale-105"></i></a>
                                            </td>
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="flex justify-center my-4">
                        {{ $lot_in_products->links('pagination::custom-pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const handle_search_inbounds = async () => {
            try {
                //ดึงค่า
                const search_lot_in = document.getElementById("search_lot_in").value;
                const search_attribute = document.getElementById("search_attribute").value;
                const search_status = document.getElementById("search_status").value;
                const cluster = '{{ env('CLUSTER') }}';
                //ส่ง req
                const response = await fetch(`${cluster}/product/inbounds/search-lot-in`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        search_lot_in,
                        search_attribute,
                        search_status
                    })
                });
                console.log(response.data);

                if (response.ok) {
                    const responseData = await response.json();
                    const searches = responseData.data;
                    const search_lot_in_table = document.getElementById("search_lot_in_table");
                    search_lot_in_table.innerHTML = ""; // Clear previous results

                    console.log(searches);
                    if (searches?.length === 0) {
                        // Display message when no results are found
                        search_lot_in_table.innerHTML =
                            `<tr><td colspan="5">ไม่พบรายการล็อตสินค้าเข้า</td></tr>`;
                        document.getElementById('lot_in_count').innerText = 0;
                    } else {

                        searches?.map((search, index) => {
                            // สร้าง element ของแต่ละ row ในตาราง
                            const row = `
                                <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer">
                                    <td class="px-6 py-4 text-center">${index + 1}</td>
                                    <td class="px-6 py-4 text-center">${search.lot_in_number}</td>
                                    <td class="px-6 py-4 text-center" id="dateCell_${index}"></td> <!-- เพิ่ม id ให้กับ cell เพื่อแทนที่วันที่ในภายหลัง -->
                                    <td class="px-6 py-4 text-center">${search.user_id}</td> <!-- อาจจะต้องแก้ไขเป็นรหัสผู้ใช้หรือข้อมูลที่เหมาะสม -->
                                    <td class="px-6 py-4 text-center">
                                        <div>
                                            <p class="border text-center rounded-3xl py-1 text-white ${
                                                search.lot_in_status === 'Initialized' ? 'bg-[#666666]' : 'bg-green-700'
                                            }">${search.lot_in_status} </p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 flex gap-3 text-gray-500 justify-center">
                                        <a href="{{ url('/product/inbounds/edit-inbound-order') }}/${search.lot_in_id}" class="">
                                            <i class="fa-regular fa-pen-to-square text-[1.5rem] hover:text-blue-700 hover:scale-105"></i>
                                        </a>
                                        |
                                        <i class="fa-solid fa-trash-can text-[1.5rem] hover:text-red-500 hover:scale-105"></i>
                                    </td>
                                </tr>
                            `;
                            // เพิ่ม row ลงในตาราง
                            search_lot_in_table.innerHTML += row;

                            // สร้างวัตถุ Date จากค่า timestamp ที่ได้รับมา
                            const timestamp = new Date(search.created_at)
                                .getTime(); // แปลงจากประเภท string ให้เป็น Date object และดึง timestamp ออกมา
                            const date = new Date(timestamp);

                            // กำหนดรูปแบบของวันที่และเวลา
                            const formattedDate = ("0" + date.getDate()).slice(-2) + "/" + ("0" + (date
                                .getMonth() + 1)).slice(-2) + "/" + date.getFullYear();

                            // แสดงผลลัพธ์ใน cell ที่มี id เรากำหนดไว้
                            document.getElementById(`dateCell_${index}`).innerText = formattedDate;
                            document.getElementById('lot_in_count').innerText = searches.length;
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

        const delete_lot_inbound = (lot_in_id) => {
            const cluster = '{{ env('CLUSTER') }}'
            Swal.fire({
                title: "คุณต้องการลบใช่หรือไม่?" ,
                text: "คุณจะไม่สามารถเรียกข้อมูลได้อีก!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                confirmButtonText: "ลบ!",
                cancelButtonColor: "#3085d6",
                cancelButtonText: "ยกเลิก",
            });
        }
    </script>




@endsection
