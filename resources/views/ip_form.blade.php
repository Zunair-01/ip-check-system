<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>IP Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center text-primary mb-4">IP Addresses Management</h2>
        <form id="ipForm" action="{{ route('ip.store') }}" method="POST"
            class="mb-4 p-4 border rounded shadow-sm bg-white">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="ip">IP Address:</label>
                    <input type="text" class="form-control form-control-sm" id="ip" name="ip" required
                        placeholder="Enter IP Address">
                </div>
                <div class="form-group col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="is_used" name="is_used" value="1">
                <label class="form-check-label" for="is_used">Is Used</label>
            </div>
        </form>

        <h2 class="text-center">IP Addresses</h2>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>IP Address</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody id="ipTableBody">

            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <h3>Total IPs: <span id="totalCount">0</span></h3>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Function to fetch and display IP data
            function fetchData() {
                $.ajax({
                    url: "{{ route('ip.data') }}",
                    method: 'GET',
                    success: function(response) {
                        var ips = response.ips;
                        var totalCount = response.totalCount;

                        var tbody = $('#ipTableBody');
                        tbody.empty();

                        $.each(ips, function(index, ip) {
                            const createdAt = new Date(ip.created_at);
                            const formattedDate = createdAt.toLocaleString();
                            tbody.append(`
                                <tr class="${ip.is_used ? 'table-success' : 'table-danger'}">
                                    <td>${ip.id}</td>
                                    <td>${ip.ip}</td>
                                    <td>${ip.is_used ? 'Correct' : 'Error'}</td>
                                    <td>${formattedDate}</td>
                                </tr>
                            `);
                        });

                        $('#totalCount').text(totalCount);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseJSON.errors);
                    }
                });
            }

            // Fetch data initially
            fetchData();

            $('#ipForm').on('submit', function(e) {
                e.preventDefault();

                var form = $(this);
                var actionUrl = form.attr('action');

                $('<input>').attr({
                    type: 'hidden',
                    name: 'is_used',
                    value: $('#is_used').is(':checked') ? '1' : '0'
                }).appendTo(form);

                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        $('#ipForm')[0].reset();
                        fetchData();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseJSON.errors);
                    }
                });
            });

            // Delete all IPs
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('ip.deleteAll') }}",
                method: 'DELETE',
                success: function(response) {
                    fetchData();
                },
                error: function(xhr) {
                    console.log(xhr.responseJSON.errors);
                }
            });
        });
    </script>
</body>

</html>
