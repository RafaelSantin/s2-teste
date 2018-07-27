<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
       <script src="{{asset('js/dropzone.js')}}"></script>
       <link rel="stylesheet" href="{{asset('css/dropzone.css')}}"></link>
    </head>
    <body>
        <form action="{{URL('upload-file')}}" class="dropzone"  method="post" enctype="multipart/form-data">
          <div class="fallback">
            <input name="file" type="file" multiple />
          </div>
        </form>
        
    </body>
</html>
