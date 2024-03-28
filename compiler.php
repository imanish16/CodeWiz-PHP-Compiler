<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Compiler</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .compiler-box {
        width: 600px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .input-section textarea {
        width: 100%;
        height: 200px;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
    }

    .output-section {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 10px;
        background-color: #f9f9f9;
        overflow: auto;
        height: 200px;
    }

    .output-section pre {
        margin: 0;
        white-space: pre-wrap;
    }

    .btn-run {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-run:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="compiler-box">
            <div class="input-section">
                <h2>Enter your PHP code:</h2>
                <textarea id="php-code" placeholder="Enter your PHP code here..." spellcheck="false"></textarea>
                <button class="btn-run" onclick="runPHP()">Run PHP Code</button>
            </div>
            <div class="output-section" id="output">
                <h2>Output:</h2>
                <pre id="output-text"></pre>
            </div>
        </div>
    </div>
    <script>
    function runPHP() {
        var phpCode = document.getElementById('php-code').value;

        // Make an AJAX request to execute PHP code
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('output-text').innerText = xhr.responseText;
            }
        };
        xhr.open('POST', 'execute.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('code=' + encodeURIComponent(phpCode));
    }
    </script>
</body>

</html>