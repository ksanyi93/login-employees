<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees list</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th {
            cursor: pointer;
        }

        tr:nth-child(odd) {
            background-color: #cecece;
        }

        .ordered {
            background-color: #cecece;
        }

        #top {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;

        }
        .delete-btn{
            background-color: transparent;
            border: none;
            color: red;
        }

        .text-center{
            text-align: center;
        }
    </style>
    <script>
        const from = <?php print $_GET['from'] ?? 0; ?>;
    </script>
</head>

<body>

    <h2>Employees list</h2>

    <input type="text" id="search">
    <button id="btn_search">Keresés</button>

    <div id="paginate"></div>
    <hr>
    <table width="100%">

        <thead>
            <tr>
                <th id="th_name">Név</th>
                <th id="th_dept">Beosztás</th>
                <th id="th_class">Osztály</th>
                <th id="th_date">Dátum</th>
                <th>Törlés</th>
            </tr>
        </thead>

        <tbody></tbody>

    </table>

    <div id="top"><i class="fa-solid fa-spinner fa-spin fa-2x"></i></div>

    <script src="scripts.js" type="module"></script>
</body>

</html>