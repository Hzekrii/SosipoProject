<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            color: #333;
            background-color: #f9f9f9;
            line-height: 1.6;
            text-align: center;
            /* Center-align all text */
        }

        .report-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 4px;
        }

        .report-title {
            font-size: 24px;
            margin-bottom: 40px;
            color: #555;
        }

        h1,
        h2,
        h6 {
            text-align: center;
            /* Center-align headings */
        }

        h2 {
            margin-top: 40px;
            margin-bottom: 20px;
            font-size: 18px;
            background-color: yellow;
            /* Highlight "Recettes" and "Dépenses" sections with yellow background */
            padding: 8px;
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
            font-weight: bold;
        }

        .total-row {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="report-container">
        <span class="report-title">Association des œuvres sociales pour les employés et utilisateurs du port du
            Safi</span>
        <h1>Rapport Financier pour {{ $year }}</h1>
        <p>Conformément aux dispositions de la loi intérieure de l'Association et en coordination avec les membres du
            bureau, le comité spécial et le contrôleur des finances du ministère compétent, l'administration générale de
            la SOSIPO présente le rapport financier de l'année {{ $year }}, couvrant la période du 1er janvier
            {{ $year }} au 31 décembre {{ $year }}. Le nombre de bénéficiaires dans la ville d'Asfi
            s'élève à
            {{ $numberOfAdherents }}, sans compter les retraités.
        </p>

        <h2>Recettes</h2>
        <table>
            <thead>
                <tr>
                    <th>Rubrique</th>
                    <th>Montant</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $recetteTotal = 0;
                @endphp
                @foreach ($recetteData as $recette)
                    <tr>
                        <td>{{ $recette['label'] }}</td>
                        <td>{{ $recette['amount'] }} </td>
                    </tr>
                    @php
                        $recetteTotal += $recette['amount'];
                    @endphp
                @endforeach
                <tr class="total-row">
                    <td><strong>Total</strong></td>
                    <td><strong>{{ $recetteTotal }} DH </strong></td>
                </tr>
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
                @php
                    $depenseTotal = 0;
                @endphp
                @foreach ($depenseData as $depense)
                    <tr>
                        <td>{{ $depense['label'] }}</td>
                        <td>{{ $depense['amount'] }} </td>
                    </tr>
                    @php
                        $depenseTotal += $depense['amount'];
                    @endphp
                @endforeach
                <tr class="total-row">
                    <td><strong>Total</strong></td>
                    <td><strong>{{ $depenseTotal }} DH </strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
