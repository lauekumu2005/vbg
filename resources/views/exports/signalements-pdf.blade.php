<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport des signalements VBG</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .header p {
            color: #7f8c8d;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f5f6fa;
            color: #2c3e50;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #7f8c8d;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Rapport des signalements VBG</h1>
        <p>Généré le {{ $date }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Genre</th>
                <th>Âge</th>
                <th>Localisation</th>
                <th>Type de violence</th>
                <th>Statut</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($signalements as $signalement)
            <tr>
                <td>{{ $signalement->id }}</td>
                <td>{{ $signalement->date_signalement }}</td>
                <td>{{ $signalement->genre }}</td>
                <td>{{ $signalement->age }}</td>
                <td>{{ $signalement->localisation }}</td>
                <td>{{ $signalement->type_violence }}</td>
                <td>{{ $signalement->statut }}</td>
                <td>{{ $signalement->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Ce rapport a été généré automatiquement par le système de gestion des VBG.</p>
        <p>© {{ date('Y') }} Ministère - Tous droits réservés</p>
    </div>
</body>
</html> 