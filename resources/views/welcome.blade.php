<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>

    <style type="text/tailwindcss">
    @layer utilities {
      .container{
        @apply px-10 mx-auto;
      }
      .btn{
        @apply bg-blue-600 text-white rounded py-2 px-4;
      }
      .btnDel{
        @apply bg-red-600 text-white rounded py-2 px-4;
      }
    }
  </style>
    <title>CRUD Test</title>
</head>
<body>
    <div class = "container">
        <div class = "flex justify-between my-5">
        <h2 class = "text-red-500 text-xl">Home Page</h2>
        <a href="/create" class = "bg-green-600 text-white rounded py-2 px-4">Add New Post</a>
        </div>
        @if (session('success'))
        <h2 class = "text-green-600 py-5 mx-auto">{{session('success')}}</h2>
        @endif

        <div class = "">
          <div class="flex flex-col">
              <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                  <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700 border border-green-800 my-5">
                      <thead class="bg-green-600">
                        <tr>
                          <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-white uppercase">ID</th>
                          <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-white uppercase">Name</th>
                          <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-white uppercase">Description</th>
                          <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-white uppercase">Image</th>
                          <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-white uppercase">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($posts as $post)
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{$post-> id}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{$post-> name}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{$post-> description}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"><img src="images/{{$post-> image}}" width = "60px" alt=""></td>
                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                              <a href="{{route('edit',$post->id)}}" class = "btn">Edit</a>
                              <form method="POST" action="{{route('delete',$post->id) }}" class="inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btnDel">Delete</button>
                              </form>
                            </td>
                        </tr>    
                        @endforeach
                      </tbody>
                    </table>
                    {{$posts-> links()}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
</body>
</html>