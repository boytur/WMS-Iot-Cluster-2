@extends('layouts.default')
@section('title', 'เพิ่มสินค้า')

@section('content')


    <form class="form-horizontal" action="{{ url('product/managements/add-new-product') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div style="height: calc(100vh - 4rem)" class="bg-[#F6F9FC] border w-full flex flex-col h-full">
            <div class="mt-[5rem] md:mt-0">
                <div class=" w-full h-[3rem] ">
                    <div class="h-full flex items-center bg-white p-3 border-b-2 shadow-sm text-blue-800">
                        <a href="{{ url('/product/managements') }}">สินค้า > จัดการสินค้า > </a>
                        <a href="">&nbsp;เพิ่มสินค้า</a>
                    </div>
                </div>
                <div class="w-full p-2 my-3">
                    <h1> เพิ่มรายการสินค้า</h1>
                    <div class="w-full p-2 flex gap-5 my-2">
                        <div class="w-full ">
                            <div class="my-4">
                                <p class="text-black/70 text-sm my-2">บาร์โค้ด</p>
                                <input type="text" placeholder="กรอกหรือสแกนบาร์โค้ด..." class="input-primary h-[3rem]"
                                    name="mas_prod_barcode" id="mas_prod_barcode">
                            </div>
                            <div class="my-4">
                                <p class="text-black/70 text-sm my-2">ชื่อสินค้า</p>
                                <input type="text" placeholder="กรอกชื่อสินค้า..." class="input-primary h-[3rem]"
                                    name="mas_prod_name" id="mas_prod_name">
                            </div>

                            <div class="my-4 flex gap-10 w-full">
                                <div class="w-full">
                                    <p class="text-black/70 text-sm my-2">ประเภท</p>
                                    <select name="cat_id" id="cat_id" class="w-full h-[3rem] input-primary px-2">
                                        <option value="" selected disabled>เลือก</option>

                                        @foreach ($categories as $index => $category)
                                            <option value="{{ $category->cat_id }}">
                                                {{ $category->cat_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="w-full">
                                    <p class="text-black/70 text-sm my-2">จำนวนที่สามารถวางได้เต็มช่อง</p>
                                    <input type="text" placeholder="กรอกจำนวนชิ้น..." class="input-primary h-[3rem]"
                                        name="mas_prod_size" id="mas_prod_size">
                                </div>
                            </div>

                            <div class="my-4">
                                <p class="text-black/70 text-sm my-2">แท็ค</p>

                                <select name="mas_prod_tags" id="mas_prod_tags" class="w-full h-[3rem] input-primary px-2"
                                    onchange="addToTagsArray(this)">
                                    <option value="" selected disabled>เลือก</option>
                                    @foreach ($tags as $index => $tag)
                                        <option value="{{ $tag->tag_id }}">{{ $tag->tag_name }}</option>
                                    @endforeach
                                </select>

                                <div id="tags-container"></div>
                            </div>



                            <div class="my-6 w-full flex items-center justify-center ">
                                <button type="submit" class="btn-primary px-4 flex items-center h-[3rem] gap-1">
                                    <a href="{{ url('product/managements/add-new-product') }}"
                                        class="flex items-center gap-1">
                                        <div>
                                            <p class="lg:text-sm lg:block hidden">เพิ่มสินค้า</p>
                                        </div>
                                    </a>
                                </button>
                            </div>


                        </div>

                        <div class="border-solid border-2 border-indigo-600 w-full flex flex-col items-center ">
                            <div class="items-center ">
                                <label class="custom-file-label mt-2 items-center  w-full"
                                    for="avatar">คลิกเพื่ออัปโหลดรูปภาพ</label>
                                <input type="file" class="bg-white rounded-lg p-6 shadow-xl items-center w-full"
                                    id="mas_prod_image" name="mas_prod_image" onchange="previewImage(this)">
                            </div>

                            <div>
                                <img id="image-preview" src="#" alt="Preview"
                                    style="display: none; width: 100rem; height: auto;">
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </form>


    <script>
        let selectedTags = []; // เริ่มต้นอาเรย์ว่างเพื่อเก็บค่าที่เลือก

        function addToTagsArray(selectElement) {
            const selectedTagId = selectElement.value;
            const selectedTagName = selectElement.options[selectElement.selectedIndex].text;

            // เพิ่มค่าที่เลือกลงในอาเรย์
            selectedTags.push({
                id: selectedTagId,
                name: selectedTagName
            });

            // แสดงรายการที่เลือกอยู่ในอาเรย์
            displaySelectedTags();
        }

        function displaySelectedTags() {
            const tagsContainer = document.getElementById('tags-container');
            tagsContainer.innerHTML = ''; // เคลียร์รายการเดิมก่อนที่จะแสดงใหม่

            // วนลูปเพื่อแสดงรายการที่เลือกในอาเรย์
            selectedTags.forEach(tag => {
                const tagElement = document.createElement('span');
                tagElement.textContent = tag.name;
                tagsContainer.appendChild(tagElement);
            });
        }
    </script>


    <script>
        function previewImage(input) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('image-preview').style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }
    </script>

@endsection
