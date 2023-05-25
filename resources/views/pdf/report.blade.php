<!DOCTYPE html>
<html>

<head>
    <style>
        <style>body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            margin-top: 40px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        table th {
            background-color: #f2f2f2;
            text-align: left;
        }

        p.note {
            margin-top: 40px;
            font-style: italic;
        }
    </style>
    </style>
</head>

<body>
    <h2>Recettes</h2>
    <table>
        <thead>
            <tr>
                <th>Rubrique</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recetteData as $recette)
                <tr>
                    <td>{{ $recette['label'] }}</td>
                    <td>{{ $recette['amount'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Dépenses</h2>
    <table>
        <thead>
            <tr>
                <th>Rubrique</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($depenseData as $depense)
                <tr>
                    <td>{{ $depense['label'] }}</td>
                    <td>{{ $depense['amount'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
