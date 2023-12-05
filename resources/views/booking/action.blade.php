<td>
    <div class="d-flex">
        <a href="{{route("bookings.show",$query->id)}}" class="mx-2">View</a>
        <a href="{{route("bookings.edit",$query->id)}}"  class="mx-2">Edit</a>
        <a class="text-danger delete" data-url="{{route('bookings.destroy',$query->id)}}"  class="mx-2" style="cursor: pointer;">Delete</a>
    </div>
</td>