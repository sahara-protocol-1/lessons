<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

    <div class="ho">
        <div class="lo">
            <input type="text" id="some_input">
            <button id="button_1">Push</button>
        </div>
    </div>


    <div id="some_div">

    </div>




    <script>
    let input_text = document.querySelector('#some_input');
    let button = document.querySelector('#button_1');

    button.addEventListener("click", function () {

        let xhttp = new XMLHttpRequest();

    xhttp.open("POST", "./handler.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            myFunction(this.responseText)
        }
    }

    xhttp.send('key=' + encodeURIComponent(input_text.value))
    })

    function myFunction(data) {
        let div = document.querySelector('#some_div');
        div.innerHTML  = data;
    }
    </script>

</body>
</html>