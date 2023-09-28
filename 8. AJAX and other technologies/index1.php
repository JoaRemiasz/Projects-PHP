<!DOCTYPE html>
<head>
    <meta charset="UTF-8" />
</head>
<body>
<p>Informacja: <span class="status"></span></p>
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    (function()
    {
        var status = $('.status'),
            poll = function()
            {
                $.ajax(
                    {
                        url: 'my_file.json',
                        dataType: 'json',
                        type: 'get',
                        success: function(data) { status.text(data.imie); },
                        error: function() { console.log('Error!'); }
                    });
            },
            pollInterval = setInterval(function() {poll();}, 2000);
        poll(); // init
    })();
</script>
</body>
</html>