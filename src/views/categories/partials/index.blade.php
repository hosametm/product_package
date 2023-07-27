<div class="breadcrumb">
    <div class="breadcrumb-item">
        <a href="{{route('category.index')}}">category</a>
        <a>category</a>
    </div>
</div>
<div class="container">
    <table class="table">
        <thead>
        <tr>
            <td colspan="5">
                <div class="justify-content-between d-flex">
                    <h2 class="d-inline">Categories</h2>
                    <a href="{{route('category.create')}}" class="btn btn-primary">Add Category</a>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Actions</th>

        </tr>
        </thead>
        <tbody>
        @foreach($categories as $x => $category)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$category->name}}</td>
                <td>
                    <a href="{{route('category.edit',$category->id)}}" title="Edit" class="btn btn-sm btn-secondary"><i class="fa fa-pencil"></i>
                    </a>

                    <form style="display: unset" action="{{ route('category.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5">
                <div class="pagination justify-content-center">
                    {{$categories->links()}}
                </div>
            </td>
        </tr>

        </tfoot>
    </table>
</div>
