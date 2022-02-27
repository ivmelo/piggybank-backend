<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <title>{{ config('app.name', 'Laravel') }}</title>    
        <style>
            .container-form {
                max-width: 600px;
            }
        </style>
    </head>
    <body>
        @include('partials.navbar')

        {{ $slot }}

        @if (session()->has('success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div class="alert alert-success alert-dismissible fade show mb-0" role="alert" id="success-alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <script>
            // Automatically closes alerts.
            var alertList = document.querySelectorAll('.alert')
            var alerts =  [].slice.call(alertList).map(function (element) {
                return new bootstrap.Alert(element)
            })

            var alertNode = document.querySelector('.alert');

            if (alertNode) {
                window.setTimeout(() => {
                    var alert = bootstrap.Alert.getInstance(alertNode);
                    alert.close();
                }, 3000);
            }

            $(function() {
                $('#sortable').sortable({
                    stop: function(event, ui) {
                        var fieldIdsInOrder = $('#sortable').sortable('toArray', {attribute: 'data-id'});
                        console.log(fieldIdsInOrder);

                        $.post('fields/sort', {
                            field_ids: fieldIdsInOrder,
                            _token: '{{ csrf_token() }}'
                        }).done(function(data) {
                            console.log(data);
                        });
                    }
                });
            });

            
        </script>
    </body>
</html>
