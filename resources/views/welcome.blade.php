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
            success: function (data) {
                var allWords=[] ;
                $("#words").empty();
                for(var i = 0 ; i < data.length; ++i) {
                    allWords.push(data[i].name);
                    $("#words").append('<li>'+data[i].id+': '+data[i].name+'</li>');
                }
                $("#words").val(allWords.join(', '));
            },
            error: ajaxError,
        });
    }

    function addWord() {
        $.ajax({
            url: '/api/words',
            type: 'POST',
            data: {
                name: $("#post-name").val(),
            },
            success: function (data) {
                getWords();
            },
            error: ajaxError,
        });
        $("#post-name").val('' );
    }

    function changeWord() {
        $.ajax({
            url: '/api/words/'+$("#put-id").val(),
            type: 'PUT',
            data: {
                name: $("#put-name").val(),
            },
            success: function (data) {
                getWords();
            },
            error: ajaxError,
        });
        $("#put-name").val('' );
    }

    function deleteWord() {
        $.ajax({
            url: '/api/words/'+$("#delete-id").val(),
            type: 'DELETE',
            success: function (data) {
                getWords();
            },
            error: ajaxError,
        });
        $("#delete-id").val('' );
    }

    $(document).ready(function() {
        getWords();
    });

</script>
<h1>Wordweb API test</h1>
<div>
    <h2>GET</h2>
    <ul id="words" style="height:100px; width: 200px; overflow-y: scroll;">
    </ul>
    <h2>POST</h2>
    <p><input type="text" id="post-name" placeholder="name"></p>
    <p><button type="button" onclick="addWord()">POST</button></p>
    <h2>PUT</h2>
    <p><input type="text" id="put-id" placeholder="id"></p>
    <p><input type="text" id="put-name" placeholder="name"></p>
    <p><button type="button" onclick="changeWord()">PUT</button></p>
    <h2>DELETE</h2>
    <p><input type="text" id="delete-id" placeholder="id"></p>
    <p><button type="button" onclick="deleteWord()">DELETE</button></p>
</div>
</body>
</html>
