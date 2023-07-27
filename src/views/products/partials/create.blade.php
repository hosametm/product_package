<div class="breadcrumb">
    <div class="breadcrumb-item">
        <a href="{{route('product.index')}}">Products</a>
        <a>Create Product</a>
    </div>
</div>
<div class="container">
    <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
        @csrf
        <h2>Product Details</h2>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="productName">Product name</label>
                <input type="text" class="form-control" name="name" id="productName"
                       placeholder="Enter product name">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <label for="productDescription">Product description</label>
                <textarea class="form-control" name="description" id="productDescription" rows="3"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <label for="category_id">Category</label>
                <select name="category_id" class="form-control form-select" aria-label="Default select example">
                    <option selected>Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{(int)$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="productImages">Product Images</label>
                <input class="form-control" name="images[]" multiple="" type="file" id="productImages">
            </div>
        </div>
        <div id="output"></div>
        <h2>Stock</h2>
        <div id="stock">
            <div class="row">
                <div class="form-group col-1">
                    <label for="productQuantity">color</label>
                    <input type="color" class="form-control" name="stock[0][color]">
                </div>
                <div class="form-group col-4">
                    <label for="productQuantity">size</label>
                    <input class="form-control" value="0" type="text" name="stock[0][size]">
                </div>
                <div class="form-group col-3">
                    <label for="productQuantity">price</label>
                    <input class="form-control" value="0" type="text" name="stock[0][price]">
                </div>
                <div class="form-group col-3">
                    <label for="productQuantity">quantity</label>
                    <input class="form-control" value="0" type="text" name="stock[0][quantity]">
                </div>
                <div class="form-group" id="addStock" style="display: flex;align-items: end;">
                    <button class="btn btn-secondary"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <input type="submit" class="form-control" value="Save">
            </div>
        </div>


    </form>
</div>

<script>
    $(document).ready(function () {
        let i = 1;
        $("#addStock").click(function (e) {
            e.preventDefault();
            i++;
            $("#stock").append('<div class="row" id="row' + i + '"><div class="form-group col-1"><label for="productQuantity">color</label><input type="color" class="form-control" name="stock[' + i + '][color]"></div><div class="form-group col-4"><label for="productQuantity">size</label><input class="form-control" type="text" name="stock[' + i + '][size]"></div><div class="form-group col-3"><label for="productQuantity">price</label><input class="form-control" type="text" name="stock[' + i + '][price]"></div><div class="form-group col-3"><label for="productQuantity">quantity</label><input class="form-control" type="text" name="stock[' + i + '][quantity]"></div><div class="form-group" id="addStock" style="display: flex;align-items: end;" ><button class="btn btn-secondary" id="' + i + '"><i class="fa fa-minus" ></i></button></div></div>');
        });
        $(document).on('click', '.btn-secondary', function () {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

        $("#productImages").change(function (e) {
            loadImages(e);
        });


        function loadImages(e) {
            let files = e.target.files;
            for (let i = 0; i < files.length; i++) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    let output = document.getElementById('output');
                    output.innerHTML += '<img src="' + event.target.result + '" width="150px" height="150px" style="margin: 8px;" alt="image">';
                };
                reader.readAsDataURL(files[i]);
            }
        }
    });
</script>
