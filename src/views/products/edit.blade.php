<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>
<body>
<div class="breadcrumb">
    <div class="breadcrumb-item">
        <a href="{{route('product.index')}}">Products</a>
        <a>Create Product</a>
    </div>
</div>
<div class="container">
    <form method="post" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h2>Product Details</h2>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="productName">Product name</label>
                <input type="text" class="form-control" name="name" value="{{$product->name}}" id="productName"
                       placeholder="Enter product name">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <label for="productDescription">Product description</label>
                <textarea class="form-control" name="description" id="productDescription"
                          rows="3">{{$product->description}}</textarea>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <label for="productImages">Product Images</label>
                <input class="form-control" name="images[]" multiple="" type="file" id="productImages">
            </div>
        </div>

        <div id="output">
            @foreach($product->attachments as $image)
                <img src="{{asset('public/'.$image->path)}}" width="150px" height="150px"
                     style="margin: 8px;" alt="image">
            @endforeach
        </div>
        <h2>Stock</h2>
        <div id="stock">
            <input type="hidden" name="deletedStock" id="deletedStock">
            @forelse($product->productStock as $k=> $productStock)
                <div class="row">
                    <input type="hidden" name="stock[{{$k}}][id]" value="{{$productStock->id}}">
                    <div class="form-group col-1">
                        <label for="productQuantity">color</label>
                        <input type="color" value="{{$productStock->color}}" class="form-control"
                               name="stock[{{$k}}][color]">
                    </div>
                    <div class="form-group col-4">
                        <label for="productQuantity">size</label>
                        <input class="form-control" value="{{$productStock->size}}" type="text"
                               name="stock[{{$k}}][size]">
                    </div>
                    <div class="form-group col-3">
                        <label for="productQuantity">price</label>
                        <input class="form-control" type="text" value="{{$productStock->price}}"
                               name="stock[{{$k}}][price]">
                    </div>
                    <div class="form-group col-3">
                        <label for="productQuantity">quantity</label>
                        <input class="form-control" type="text" value="{{$productStock->quantity}}"
                               name="stock[{{$k}}][quantity]">
                    </div>
                    @if($k==0)
                        <div class="form-group" id="addStock"
                             style="display: flex;align-items: end;">
                            <button class="btn btn-secondary"><i class="fa fa-plus"></i></button>
                        </div>
                    @else

                        <div class="form-group" id="deleteStock" onclick="deleteStock(event)"
                             style="display: flex;align-items: end;">
                            <button class="btn btn-secondary"><i class="fa fa-minus"></i></button>
                        </div>
                    @endif
                </div>

            @empty
                <div class="row">
                    <div class="form-group col-1">
                        <label for="productQuantity">color</label>
                        <input type="color" class="form-control" name="stock[0][color]">
                    </div>
                    <div class="form-group col-4">
                        <label for="productQuantity">size</label>
                        <input class="form-control" type="text" name="stock[0][size]">
                    </div>
                    <div class="form-group col-3">
                        <label for="productQuantity">price</label>
                        <input class="form-control" type="text" name="stock[0][price]">
                    </div>
                    <div class="form-group col-3">
                        <label for="productQuantity">quantity</label>
                        <input class="form-control" type="text" name="stock[0][quantity]">
                    </div>
                    <div class="form-group" id="addStock" style="display: flex;align-items: end;">
                        <button class="btn btn-secondary"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            @endforelse

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
            $('#output').html('');
        });

        // JavaScript
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

    function deleteStock(e) {
        e.preventDefault();
        let btn = $(e.target);
        let deletedStock = $('#deletedStock').val();

        if (btn.hasClass('btn-secondary')) {
            let div = btn.parent().parent();
            let id = div.find('input[type=hidden]').val();
            deletedStock += id + ',';
            btn.parent().parent().remove();
        } else {
            let div = btn.parent().parent().parent();
            let id = div.find('input[type=hidden]').val();
            deletedStock += id + ',';
            btn.parent().parent().parent().remove();
        }
        $('#deletedStock').val(deletedStock);
    }
</script>
</body>
</html>
