<div class="breadcrumb">
    <div class="breadcrumb-item">
        <a href="{{route('category.index')}}">Category</a>

    </div>
</div>
<div class="container">
    <form method="post" action="{{route('category.update',$category->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h2>Category Details</h2>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="productName">Category name</label>
                <input type="text" class="form-control" name="name" value="{{$category->name}}"
                       placeholder="Enter Category name">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <input type="submit" class="form-control" value="Save">
            </div>
        </div>
    </form>
</div>
