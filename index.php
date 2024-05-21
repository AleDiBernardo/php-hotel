<?php

$hotels = [
    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4,
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2,
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1,
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5,
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50,
    ],
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boolking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-success text-light">
    <div class="container d-flex align-items-center  flex-column p-5">
        <h1>Boolking</h1>
        
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <?php foreach (array_keys($hotels[0]) as $key): ?>
                        <th scope="col"><?php echo ucwords(str_replace('_', ' ', $key)); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hotels as $index => $hotel): ?>
                    <?php
                    $showHotel = true;
                    if (isset($_GET['parking']) && $_GET['parking'] == '1' && !$hotel['parking']) {
                        $showHotel = false;
                    }
                    if (isset($_GET['rating']) && intval($_GET['rating']) > $hotel['vote']) {
                        $showHotel = false;
                    }
                    ?>
                    <?php if ($showHotel): ?>
                        <tr>
                            <th scope="row"><?php echo $index + 1; ?></th>
                            <td><?php echo $hotel['name']; ?></td>
                            <td><?php echo $hotel['description']; ?></td>
                            <td><?php echo $hotel['parking'] ? 'yes' : 'no'; ?></td>
                            <td><?php echo $hotel['vote'] . "/5"; ?></td>
                            <td><?php echo $hotel['distance_to_center'] . " km"; ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <form action="" method="GET">
            <div class="mb-3">
                <label for="parkingCheckbox" class="form-label">Filter by Parking</label>
                <input type="checkbox" id="parkingCheckbox" name="parking" value="1" <?php if(isset($_GET['parking']) && $_GET['parking'] == '1'); ?>>
            </div>
            <div class="mb-3">
                <label for="ratingInput" class="form-label">Filter by Rating (vote)</label>
                <input type="number" id="ratingInput" name="rating" min="1" max="5" value="<?php if(isset($_GET['rating'])) echo $_GET['rating']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Apply Filter</button>
        </form>
    </div>
</body>
</html>
