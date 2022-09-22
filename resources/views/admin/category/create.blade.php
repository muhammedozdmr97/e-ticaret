<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Create') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-center p-12">
                        <div class="mx-auto w-full max-w-[550px] bg-white">
                            <form id="create_category" action="{{ route('category.store') }}" method="POST">
                                @csrf
                                <div class="mb-5">
                                    <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                                        Category Name
                                    </label>
                                    <input type="text" name="name" id="name" placeholder="Product Name"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                </div>
                                <div class="mb-5" id="categories">
                                    <label for="product_category_id"
                                        class="mb-3 block text-base font-medium text-[#07074D]">
                                        Parent Category
                                    </label>
                                    <select
                                        class="block appearance-none w-full  border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        name="main_category" id="main_category">
                                        <option selected value="0">Main Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <select class="hidden remove append block appearance-none w-full mt-3 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="sub_category" id="sub_category"></select>
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#create_category").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $.ajax({
            url: "{{ route('category.store') }}",
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
                            location.href = "{{ route('category.index') }}";
                        }, 200);
                        $("#create_category")[0].reset();
                    });
                }else{
                    Swal.fire(
                        'Failed!',
                        r.message,
                        'error'
                    );
                }
            }
        });
    });
    $("#main_category").on('change', function(e) {
        e.preventDefault();
        var mainCategory = $("#main_category").val();
        if(mainCategory == 0){
            $('#sub_category').css('display', 'none');
        }
        $('.options').remove();
        $(".subremove").remove();
        $(".subOptions").remove();
        if(mainCategory != 0){
            $('.append').show();
            $.ajax({
                url: "{{ route('category.onChange') }}",
                method: 'post',
                data: {id: mainCategory}, 
                success: function(r) {
                        $('.append').append('<option class="options" value="">Sub Category</option>');
                        $.each( r.success, function( index, value ){
                            $('.append').append(`
                            <option class="options" value="${value.id}">${value.name}</option>`);
                        });
                }
            });
        }
    });
    $("#sub_category").on('change', function(e) {
        e.preventDefault();
        var subCategory = $("#sub_category").val();
        $(".subremove").remove();
        $(".subOptions").remove();
        if(subCategory != 0){
            $.ajax({
                url: "{{ route('category.onChange') }}",
                method: 'post',
                data: {id: subCategory}, 
                success: function(r) {
                        $('#categories').append(`<select class="subest subremove block appearance-none w-full mt-3 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="subest_category" id="subest_category">
                            <option class="subOptions" value="">Subest Category</option>`);
                        $.each( r.success, function( index, value ){
                            $('.subest').append(`<option class="subOptions" value="${value.id}">${value.name}</option>`);
                        });
                        $('#categories').append(`</select>`);
                }
            });
        }
    });
</script>
