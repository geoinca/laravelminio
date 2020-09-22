<form class="m-2" method="post" action="{{ route('store_fileupload_path') }}" enctype="multipart/form-data">

    {{ csrf_field() }}

    <!-- Title Field -->
    <div class="form-group">
        {{--<label for="name">File Name</label>--}}
        <input type="text" class="form-control" id="name" placeholder="Enter file Name" name="name">
    </div>
    <div class="form-group">
        <label for="objectup">Choose Object</label>
        <input type="file"  id="objectup" name="objectup">
    </div>
    <button type="submit" class="btn btn-dark d-block w-75 mx-auto">Upload</button>
</form>
