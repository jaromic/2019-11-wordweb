<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Wordweb API Test</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<script>
    function ajaxError (jqXHR, textStatus, errorThrown) {
        console.log('error: ' + textStatus);
        return;
    }

    function getWords() {
        $.ajax({
            url: '/api/words',
            type: 'GET',
            success: function(data) {
                $("#words").empty();
                for (var i=0; i < data.length; ++i) {
                    $("#words").append('<li>' + data[i].id + ': ' + data[i].name + '</li>');
                }
            },
            error: ajaxError
        });
    }

    function addWord() {
        $.ajax({
            url: '/api/words',
            type: 'POST',
            data: {
                'name': $("#post-name").val(),
            },
            success: function(data) {
                getWords();
            },
            error: ajaxError
        });
    }

    $(document).ready(function () {
        getWords();
    });
</script>
<main>
    <h1>Wordweb API Test</h1>
    <h2>GET</h2>
    <ul id="words" style="height: 100px; width: 200px; overflow-y: scroll;">
    </ul>
    <h2>POST</h2>
    <p><input type="text" id="post-name" placeholder="name"></p>
    <p><button type="button" onclick="addWord()">Hinzufügen</button></p>
    <h2>PUT</h2>
    <h2>DELETE</h2>
</main>
</body>
</html>
