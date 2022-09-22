<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Edit') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-center p-12">
                        <div class="mx-auto w-full max-w-[550px] bg-white">
                            <form id="update_category" action="" data-category="{{ $category->id }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="mb-5">
                                    <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                                        Category Name
                                    </label>
                                    <input type="text" name="name" value="{{ $category->name }}" id="name" placeholder="Product Name"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                </div>
                                <div class="mb-5" id="category">
                                    <label for="product_category_id"
                                        class="mb-3 block text-base font-medium text-[#07074D]">
                                        Parent Category
                                    </label>
                                    <select
                                        class="block appearance-none w-full  border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        name="main_category" id="main_category">
                                        {{ $categoryParent }}
                                        <option value="">Main Category</option>
                                        @if($categoryParent)
                                            @foreach ($maincategories as $key => $maincategory)
                                                <option value="{{ $maincategory->id }}" {{ $maincategory->id == $categoryParent ? "selected" : ""}}>{{ $maincategory->name }}</option>
                                            @endforeach
                                        @else
                                            @foreach ($maincategories as $maincategory)
                                                <option value="{{ $maincategory->id }}" {{ $maincategory->id == $category->parent_id ? "selected" : ""}}>{{ $maincategory->name }}</option>
                                            @endforeach
                                        @endif
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

    $("#update_category").submit(function(e) {
        e.preventDefault();
        var id = $(this).data("category");
        const fd = new FormData(this);
        $.ajax({
            url: "{{ route('category.update', $category->id) }}",
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
                        $("#update_category")[0].reset();
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
                data: {id: mainCategory, parent_id: "{{ $category->parent_id }}"}, 
                success: function(r) {
                        $('.append').append('<option class="options" value="">Sub Category</option>');
                        $.each( r.success, function( index, value ){
                            if(value.id == "{{ $category->parent_id }}")
                                $('.append').append(`<option class="options" value="${value.id}" selected>${value.name}</option>`);
                            else
                                $('.append').append(`<option class="options" value="${value.id}">${value.name}</option>`);
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
                        $('#category').append(`<select class="subest subremove block appearance-none w-full mt-3 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="subest_category" id="subest_category">
                            <option class="subOptions" value="">Subest Category</option>`);
                        $.each( r.success, function( index, value ){
                            $('.subest').append(`<option class="subOptions" value="${value.id}">${value.name}</option>`);
                        });
                        $('#category').append(`</select>`);
                }
            });
        }
    });
    
    $("#main_category").trigger("change");
    $("#sub_category").trigger("change");
</script>
