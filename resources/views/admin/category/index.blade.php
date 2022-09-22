<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col mt-8">
                        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                            <a href="{{ route('category.create') }}" class="bg-blue-600 hover:bg-blue-500 float-right text-white font-bold mb-5 py-2 px-4 mr-3 rounded">
                                Create Category
                            </a>
                            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                                <table class="min-w-full mb-2">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Name
                                            </th>
                                        </tr>
                                    </thead>
                    
                                    <tbody class="bg-white">
                                        @if($categories->count() < 1)
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    <div for="" class="my-5 font-bold">There Is No Any Categories</div>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($categories as $category)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 w-10 h-10">
                                                            <img class="w-10 h-10 rounded-full" src="https://source.unsplash.com/user/erondu"
                                                                alt="admin dashboard ui">
                                                        </div>
                        
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                                {{ $category->name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                        
                                                {{-- <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-500">{{ $product->desc }}</div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-500">{{ $product->product_category->name}}</div>
                                                </td> --}}
                        
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <span
                                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Active</span>
                                                </td>
                        
                                                <td
                                                    class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                                    <a href="{{ route('category.edit',$category->id) }}"><svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg></a>
                                                </td>
                                                {{-- <td
                                                    class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                                    <form action="{{ route('product.destroy', $product->id) }}" method="post" name="delete_form">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" class="delete_button"><svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg></button>
                                                    </form>
                                                    
                                                </td> --}}
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                {{ $categories->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
{{-- @if (session()->has('success'))
    <script>
        Swal.fire(
            'Added!',
            '{{ session()->get("success") }}',
            'success'
        );
    </script>
@elseif (session()->has('error'))
    <script>
        Swal.fire(
            'Added!',
            '{{ session()->get("error") }}',
            'success'
        );
    </script>
@endif
<script type="text/javascript">

    $(".delete_button").click(function(e) {
        e.preventDefault();
        Swal.fire({
          title: 'Do You Want to Delete the Product?',
          text: "Deleted Product Cannot Be Restored Again",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            setTimeout(function() {
                document.forms["delete_form"].submit();
            }, 200);
          }
        })
      });
</script> --}}
