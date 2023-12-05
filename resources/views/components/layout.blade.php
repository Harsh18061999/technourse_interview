<!DOCTYPE html>
<html lang="en">

<head>
    <title>Booking Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <style>
        body {
            background-image: linear-gradient(to right, rgb(189 200 215), #89f9c0);
        }
    </style>
</head>

<body class="container">
    {{ $slot }}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    @stack('scripts')
    <script>
        $(function() {
            $("body").on("click", ".delete", function() {
                let text = "Are you sure you want to delete this record?";
                if (confirm(text) == true) {
                    text = "You pressed OK!";
                    deleteRecord($(this).attr("data-url"))
                } else {
                    text = "You canceled!";
                }
            });
        });

        function deleteRecord(url) {
            $.ajax({
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                success: function(response) {
                    if (response.status) {
                        location.reload(true);
                    } else {
                        alert("Something Wrong")
                    }
                }
            });
        }
    </script>
</body>

</html>
