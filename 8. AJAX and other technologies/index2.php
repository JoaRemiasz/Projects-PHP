<html>
<head>
</head>
<body>
<div id='date'></div>
<script>
    var evtSource = new EventSource('text_from_db.php');
    var date = document.getElementById('date');
    evtSource.onmessage = function(e) { date.innerHTML = e.data; };
    evtSource.onerror = function() { evtSource.close(); console.log('Done!'); };
</script>
</body>
</html>