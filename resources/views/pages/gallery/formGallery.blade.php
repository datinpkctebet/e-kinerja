@extends('layout.default')

@section('content')

<div class="kt-portlet">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Input Post
      </h3>
    </div>
  </div>

  <!--begin::Form-->
  <form class="kt-form" method="POST" action="{{ URL(setPostUrl()) }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="kt-portlet__body">
      <div class="form-group">
        <label>Judul</label>
        <input type="text" class="form-control" name="title" value="{{ @$list['title'] }}" placeholder="Judul">
      </div>

      <div class="form-group">
        <label for="kt_summernote_1">Deskripsi</label>
        <textarea class="summernote" id="kt_summernote_1" name="description">{!! @$list['description'] !!}</textarea>
      </div>

      <div class="form-group">
        <label>Upload Gambar</label>
        <div class="kt-dropzone dropzone m-dropzone--primary" id="myAwesomeDropzone">
          <div class="kt-dropzone__msg dz-message needsclick">
            <h3 class="kt-dropzone__msg-title">Drop files here or click to upload.</h3>
            <span class="kt-dropzone__msg-desc">Upload up to 10 files</span>
          </div>

          <div class="fallback">
            <input name="file" type="file" multiple />
          </div>
        </div>

        <input
          type="hidden"
          id="gallery_id"
          value="{{ @$list['id'] }}">

        <input
          type="hidden"
          id="image"
          name="image"
          value="{{ $list['image'] ? $list['image'] : @$input['image'] }}">

        <input
          type="hidden"
          id="primary_image"
          name="primary_image"
          value="{{ $list['primary_image'] ? $list['primary_image'] : @$input['primary_image'] }}">
      </div>
    </div>

    <div class="kt-portlet__foot">
      <div class="kt-form__actions">
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ URL('/gallery') }}">
          <button type="button" class="btn btn-secondary">Cancel</button>
        </a>
      </div>
    </div>
  </form>
</div>

@endsection

@push('js')
<script>
Dropzone.options.myAwesomeDropzone = {
  url: '/gallery/image/add',
  parallelUploads: 10,
  acceptedFiles: '.jpg, .jpeg, .png',
  addRemoveLinks: true,
  headers: { 'x-csrf-token': document.querySelectorAll('meta[name=csrf-token]')[0].getAttributeNode('content').value, },

  init: function()
  {
    const image_array = [];
    const id = $('#gallery_id').val();
    let image = $('#image').val();

    if (image) {
      const myDropzone = this;
      const path = (id) ? '/images/gallery/' : '/images/temp/';
      image = image.split(','); // convert to array

      for (let i = 0; i < image.length; i++) {
        let mockFile = {
          name: image[i]
        };

        image_array.push(image[i]); // insert all image to one variable

        myDropzone.emit("addedfile", mockFile);
        myDropzone.emit("thumbnail", mockFile, `${path}${image_array[i]}`);
        myDropzone.emit("complete", mockFile);
      }
    }

    // add image
    this.on("success", function(file, response)
    {
      file.image_name = response;
      image_array.push(file.image_name);

      document.getElementById("image").value = image_array;
      document.getElementById("primary_image").value = image_array[0];
    });

    // remove image
    this.on("removedfile", function(file)
    {
      // check, is file in temp folder or gallery folder
      const name = (file.image_name) ? file.image_name : file.name;

      $.ajax({
        headers: { 'x-csrf-token': document.querySelectorAll('meta[name=csrf-token]')[0].getAttributeNode('content').value, },
        url: `/gallery/image/remove/${name}`,
        type: "GET",
      });

      image_array.splice(image_array.indexOf(name), 1);
      document.getElementById("image").value = image_array;
      document.getElementById("primary_image").value = image_array[0] || '';
    });
  },
};
</script>
@endpush

@push('css')
<style>
.dropzone .dz-preview .dz-image img {
  height: 120px !important;
  width: 120px !important;
}
</style>
@endpush
