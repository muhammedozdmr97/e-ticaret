<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Edit') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-center p-12">
                        <div class="mx-auto w-full max-w-[550px] bg-white">
                            <form id="update_product" action="" method="POST" > 
                                @csrf
                                @method('PUT')
                                <div class="mb-5">
                                    <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                                        Product Name
                                    </label>
                                    <input type="text" name="name" value="{{ $product->name }}" id="name" placeholder="Product Name"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                </div>
                                <div class="mb-5">
                                    <label for="desc" class="mb-3 block text-base font-medium text-[#07074D]">
                                        Product Description
                                    </label>
                                    <textarea rows="4" name="desc" id="desc" placeholder="Product description"
                                        class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">  {{ $product->desc }}</textarea>
                                </div>
                                <div class="mb-5">
                                    <label for="product_category_id" class="mb-3 block text-base font-medium text-[#07074D]">
                                        Product Category
                                    </label>
                                    <select class="block appearance-none w-full  border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="product_category_id" id="product_category_id">
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $product->product_category_id ? 'selected' : ""}}>{{ $category->name }}</option>                                            
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button
                                        class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $("#update_product").submit(function(e) {
    e.preventDefault();
    const fd = new FormData(this);
    $.ajax({
        url: "{{ route('product.update', $product) }}",
        method: 'post',
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(r) {
        if (r.success == true) {
                Swal.fire(
                'Added!',
                r.message,
                'success'
                ).then((result) => {
                    setTimeout(function() {
                    location.href = "{{ route('product.index')}}"; 
                    }, 200); 
                    $("#create_product")[0].reset();
                });
            }
        }
    });
    });
</script>

