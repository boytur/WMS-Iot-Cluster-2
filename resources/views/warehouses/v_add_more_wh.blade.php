{{-- v_another_wh.blade.php --}}
{{-- Display from view another wh --}}
{{-- @author: Tanapat Supapon --}}
{{-- @Create Date: 2024-04-05 --}}
{{-- @version 1.0.1 --}}

@extends('layouts.default')
@section('title', 'เพิ่มคลังสินค้า')

@section('content')

<div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
    <div class="mt-[5rem] md:mt-0">
        <div class=" w-full h-[3rem] ">
            <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                <a href="">คลังสินค้า > เพิ่มคลังสินค้า</a>
            </div>
        </div>
        <div class="w-full p-2">
            {{-- add wh --}}
            <div class="w-full flex justify-end gap-3 mt-2">
                <div class="mt-3 lg:pt-0">
                    <button onclick="onclick_wh_add()" class="btn-primary px-4 flex items-center h-[3rem] gap-1">
                        <div class="flex items-center gap-1">
                            <i class="fa-solid fa-circle-plus text-[0.8rem] mt-[2px]"></i>
                            <div>
                                <p class="lg:text-sm lg:block hidden">เพิ่มคลังสินค้า</p>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        {{-- table product --}}
        <div class="w-full mt-2 rounded-t-md">
            <div class="py-2 w-full bg-[#D9D9D9] rounded-t-md">
                <b class="mx-2  mt-2 text-lg text-black uppercase   ">
                    ตารางรายการคลังสินค้าในระบบ</b>
            </div>
            <table class="w-full text-sm text-left rtl:text-right ">
                <thead class="text-xs text-white uppercase bg-[#212529]">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ลำดับ
                        </th>
                        <th scope="col" class="px-6 py-3">
                            ชื่อคลังสินค้า
                        </th>
                        <th scope="col" class="px-6 py-3">
                            ตำแหน่ง
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($warehouses as $index => $warehouse)
                    <tr class="bg-white border-b hover:bg-blue-100 cursor-pointer"
                        onclick="onclick_product_details('/product/managements/detail/{{ $warehouse->wh_id }}')">
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                            {{ $index + 1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $warehouse->wh_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $warehouse->wh_location }}
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex justify-center my-4">
            {{ $warehouses->links('pagination::custom-pagination') }}
        </div>
    </div>
</div>

@endsection

{{-- Add New Warehouse Popup --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const onclick_wh_details = (wh_id) => {
        const cluster = '{{ env('CLUSTER') }}'
        window.location.href = `${cluster}/dashboard/view-another/detail/${wh_id}`;
    }

    const onclick_wh_add = () => {
        Swal.fire({
            title: "เพิ่มคลังสินค้าใหม่",
            html: `
         <div>
            <div class="flex flex-wrap ">
    <div class="mb-4 px-1 w-full">
        <label for="name" class="block mb-2 text-left text-sm font-medium">ชื่อคลังสินค้า<span class="text-sm text-red-500"> * </span></label>
        <input type="text" id="name" name="name" placeholder="กรอกชื่อตรงนี้..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5" required>
    </div>
    <div class="mb-4 px-1 w-1/2">
        <label for="subdistrict" class="block mb-2 text-left text-sm font-medium">ตำบล/แขวง<span class="text-sm text-red-500"> * </span></label>
        <input type="text" id="subdistrict" name="subdistrict" placeholder="กรอกตำบล/แขวงตรงนี้..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5">
    </div>
    <div class="mb-4 px-1 w-1/2">
        <label for="district" class="block mb-2 text-left text-sm font-medium">อำเภอ/เขต<span class="text-sm text-red-500"> * </span></label>
        <input type="text" id="district" name="district" placeholder="กรอกอำเภอ/เขตตรงนี้..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5" required>
    </div>
    <div class="mb-4 px-1 w-1/2">
        <label for="province" class="block mb-2 text-left text-sm font-medium">จังหวัด<span class="text-sm text-red-500"> * </span></label>
        <input type="text" id="province" name="province" placeholder="กรอกจังหวัดตรงนี้..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5">
    </div>
    <div class="mb-4 px-1 w-1/2">
        <label for="postal_code" class="block mb-2 text-left text-sm font-medium">รหัสไปรษณีย์<span class="text-sm text-red-500"> * </span></label>
        <input type="text" id="postal_code" name="postal_code" placeholder="กรอกรหัสไปรษณีย์ตรงนี้..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5" required>
    </div>
</div>
         </div>`,
            showCancelButton: true,
            confirmButtonColor: '#2f67ff',
            cancelButtonText: "ยกเลิก",
            confirmButtonText: "ยืนยัน",
            showLoaderOnConfirm: true,
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const name = document.getElementById('name').value;
                const subdistrict = document.getElementById('subdistrict').value;
                const district = document.getElementById('district').value;
                const province = document.getElementById('province').value;
                const postal_code = document.getElementById('postal_code').value;

                if (name && subdistrict && district && province && postal_code) {
                    // ส่งค่าไปยังเซิร์ฟเวอร์
                    sendDataToServer(name, subdistrict, district, province, postal_code);
                } else {
                    Swal.fire({
                        title: "ข้อมูลไม่ครบ",
                        text: "กรุณากรอกข้อมูลให้ครบถ้วน",
                        icon: "error",
                        confirmButtonColor: '#2f67ff',
                        confirmButtonText: "ตกลง"
                    });
                }
            }
        });
    }

    // Function to send data to the server
    const sendDataToServer = (name, subdistrict, district, province, postal_code) => {
        // ในที่นี้คุณสามารถใช้ Fetch API หรือ XMLHttpRequest ได้
        // ตัวอย่างนี้ใช้ Fetch API

        const cluster = '{{ env('CLUSTER') }}';
        fetch(`${cluster}/warehouse/add-wh`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                name: name,
                subdistrict: subdistrict,
                district: district,
                province: province,
                postal_code: postal_code
            }),
        })
        .then(response => response.json())
        .then(data => {
            // ทำสิ่งที่คุณต้องการกับข้อมูลที่ได้จากเซิร์ฟเวอร์
            console.log('Success:', data);
            Swal.fire({
                title: "สำเร็จ",
                text: "บันทึกข้อมูลสำเร็จ",
                icon: "success",
                confirmButtonColor: '#2f67ff',
                confirmButtonText: "ตกลง"
            });
        })
        .catch((error) => {
            console.error('Error:', error);
            Swal.fire({
                title: "เกิดข้อผิดพลาด",
                text: "ไม่สามารถบันทึกข้อมูลได้",
                icon: "error",
                confirmButtonColor: '#2f67ff',
                confirmButtonText: "ตกลง"
            });
        });
    }
</script>
