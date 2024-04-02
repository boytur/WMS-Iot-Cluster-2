@extends('layouts.default')
@section('title', 'เพิ่มพื้นที่จัดเก็บ')

@section('content')

    <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
        <div class="mt-[5rem] md:mt-0">
            <div class=" w-full h-[3rem] ">
                <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                    <a href="">คลังสินค้า > เพิ่มพื้นที่จัดเก็บ</a>
                </div>
            </div>
            <div class="w-full p-2">

                <div style="height: calc(100vh - 7.7rem)" class="rounded-sm  overflow-y-scroll">

                    <div class="w-full p-5 bg-white rounded-md border">
                        <div class=" w-full flex">

                            {{-- rack,shelf,floor,tag input --}}
                            <div class="w-full flex gap-2 h-full">
                                <div class="w-full">
                                    <div>
                                        <p class="text-black/70 text-sm">Rack<span class="text-red-500">*</span></p>
                                        <input type="text" placeholder="กรุณากรอกชื่อแร็ค" required
                                            class="input-primary h-[3rem] w-[15rem]" name="" id="rack">
                                    </div>
                                </div>
                                <div class="w-full">
                                    <div>
                                        <p class="text-black/70 text-sm">Shelf<span class="text-red-500">*</span></p>
                                        <input type="text" placeholder="กรุณากรอกเชลฟ์" required
                                            class="input-primary h-[3rem] w-[15rem]" name="" id="shelf">
                                    </div>
                                </div>
                                <div class="w-full">
                                    <div>
                                        <p class="text-black/70 text-sm">Floor<span class="text-red-500">*</span></p>
                                        <input type="text" placeholder="กรุณากรอกชั้น" required
                                            class="input-primary h-[3rem] w-[15rem]" name="" id="floor">
                                    </div>
                                </div>
                                <div class="w-full">
                                    <div>
                                        <p class="text-black/70 text-sm">Tag</p>
                                        <input type="text" placeholder="#เลือกแท็ก"
                                            class="input-primary h-[3rem] w-[15rem]" name="" id="">
                                    </div>
                                </div>
                                <div class="text-white">
                                    <p class="text-white text-sm">.</p>
                                    <div onclick="generateTable()"
                                        class="flex h-[3rem] w-[7rem] btn-primary justify-center items-center">
                                        <div class="flex items-center gap-1 w-full h-full justify-center">
                                            <i class="fa-solid fa-circle-plus text-[0.8rem] mt-[2px]"></i>
                                            <p class="text-white text-sm ">สร้าง</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- table space --}}
                    <div class="w-full" id="tableContainer">
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary float-right h-[3rem] w-[7rem] justify-bottom">บันทึก</button>
                        <button class="btn btn-secondary float-right mr-2 h-[3rem] w-[7rem] justify-bottom">ยกเลิก</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- js --}}
    <script>
        function generateNumbers(Shelf, RackFloor, RackName) {
            var numbers = [];

            // วนลูปเพื่อสร้างตัวเลข
            for (var i = Shelf; i >= 1; i--) {
                for (var j = RackFloor; j >= 1; j--) {
                    numbers.push(RackName + i + "-" + j);
                }
            }

            return numbers;
        }

        const names = ['A10-3', 'A10-2', 'A10-1', 'A9-1', 'A9-2', 'A9-3', 'A8-1', 'A8-2', 'A8-3', 'A7-1', 'A7-2', 'A7-3',
            'A6-1', 'A6-2', 'A6-3', 'A5-1', 'A5-2', 'A5-3', 'A4-1', 'A4-2', 'A4-3', 'A3-1', 'A3-2', 'A3-3', 'A2-1',
            'A2-2', 'A2-3', 'A1-1', 'A1-2', 'A1-3'
        ]

        function generateTable() {
            var shelf = document.getElementById('shelf').value;
            var rackFloor = document.getElementById('floor').value;
            var rackName = document.getElementById('rack').value;

            var generatedNumbers = generateNumbers(shelf, rackFloor, rackName);

            var table = '<table class="my-2 mx-1  bg-white">';
            table += '<tr class="w-full">' + '<th class=" bg-black text-white">' + "RACK " + rackName + '</th>';
            table += '<tr class="bg-white  py-3 px-6"><th scope="col" class="px-6 py-3 text-center">RackFloor/Shelf</th>';

            // เรียงลำดับ Shelf ตามที่ต้องการ
            for (var i = 1; i <= shelf; i++) {
                table += '<th scope="col" class="px-5 py-3 text-center" >' + "Shelf " + i + '</th>';
            }

            table += '</tr>';

            for (var i = rackFloor; i >= 1; i--) {
                table += '<tr class="bg-white ">';
                table += '<td class="text-center  mx-5 my-5 h-20 ">' + "Floor " + i + '</td>';
                for (var j = 1; j <= shelf; j++) {
                    var index = (shelf - j) * rackFloor + (rackFloor - i);
                    var cellContent = generatedNumbers[index] || '';
                    var cellClass = '';
                    if (generatedNumbers[index] !== '') {
                        cellClass = names.includes(rackName + j + "-" + i) ? 'highlighted' : '';

                    }
                    table +=
                        '<td class="text-center hover:bg-blue-100 bg-green-200 p-2 cursor-pointer border border-white border-[20px]"><p class=" border mx-2 h-30 items-center"' +
                        cellClass + '>' + cellContent + '</p></td>';
                }
                table += '</tr>';
            }

            table += '</table>';

            document.getElementById('tableContainer').innerHTML = table;
        }
    </script>
@endsection
