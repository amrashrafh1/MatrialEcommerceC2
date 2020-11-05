@extends('Admin.layouts.app', ['activePage' => 'product-management', 'titlePage' => trans('admin.products')])
@section('content')
<div class="container-fluid pt-8">
    <div class="col-md-12">
        @if($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-danger"> {{$error}}</div>
        @endforeach
        @endif
        <div class="widget-extra body-req card light bordered">
            <div class="card-header">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                </div>
                <div class="actions">
                    <a href="{{aurl('/products')}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form" id="element">
                @livewire('create-product')
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! $Validator->selector('#create-product') !!}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="{{url('/')}}/css/bootstrap-tagsinput.css">
<script src="{{url('/')}}/js/bootstrap-tagsinput.min.js"></script>
<script>
    $('.delete').on('click', function(e) {
        e.preventDefault();
    });
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
    <script>
        <?php foreach(\LaravelLocalization::getSupportedLocales() as $locale => $props) { ?>

            CKEDITOR.replace('short_description_{{$locale}}');
            CKEDITOR.replace('description_{{$locale}}');
        <?php } ?>

    /* var uploadedDocumentMap = {}
  Dropzone.options.documentDropzone = {
    url: '',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
      uploadedDocumentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentMap[file.name]
      }
      $('form').find('input[name="document[]"][value="' + name + '"]').remove()
    },
    init: function () {
      @if(isset($project) && $project->document)
        var files =
          {!! json_encode($project->document) !!}
        for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
        }
      @endif
    }
  } */
  $('form').keypress(function(e){
      if(e.keyCode==13)
      //$('#linkadd').click();
      e.preventDefault();
    });
        </script>
@endpush
@stop
