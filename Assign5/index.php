<?php
// Define abstract classes for shapes that can calculate area and volume
abstract class Shape {
    public abstract function getArea();
    public abstract function getVolume();
}

// Implement specific shape classes
class Cone extends Shape {
    private $radius;
    private $height;

    public function __construct($radius, $height) {
        $this->radius = $radius;
        $this->height = $height;
    }

    public function getArea() {
        // Surface area of a cone: πr(r + sqrt(h^2 + r^2))
        return pi() * $this->radius * ($this->radius + sqrt($this->height**2 + $this->radius**2));
    }

    public function getVolume() {
        // Volume of a cone: 1/3πr^2h
        return (1/3) * pi() * $this->radius**2 * $this->height;
    }
}

class Cylinder extends Shape {
    private $radius;
    private $height;

    public function __construct($radius, $height) {
        $this->radius = $radius;
        $this->height = $height;
    }

    public function getArea() {
        // Surface area of a cylinder: 2πrh + 2πr^2
        return 2 * pi() * $this->radius * $this->height + 2 * pi() * $this->radius**2;
    }

    public function getVolume() {
        // Volume of a cylinder: πr^2h
        return pi() * $this->radius**2 * $this->height;
    }
}


class sphere extends shape
{

    private $radius;
    public function __construct($radius) {
        $this->radius = $radius;
    }

    public function getArea(){
        return 4 * pi() * $this->radius * $this->radius;
    }

    public function getVolume(){
        return (4 / 3) * pi() * $this->radius * $this->radius * $this->radius;
    }
}

// Handle form submissions
$shapeSelected = $_POST['shape'] ?? null;
$displayForm = false;
$result = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['dimensions'])) {
    // Calculate area and volume
    $shape = null;
    switch ($shapeSelected) {
        case 'Cone':
            $shape = new Cone($_POST['radius'], $_POST['height']);
            break;
        case 'Cylinder':
            $shape = new Cylinder($_POST['radius'], $_POST['height']);
            break;
        case 'Sphere':
            $shape = new Sphere($_POST['radius']);
            break;
        // Cases for other shapes
    }

    if ($shape) {
        $result = [
            'shape' => $shapeSelected,
            'area' => $shape->getArea(),
            'volume' => $shape->getVolume()
        ];
    }
} elseif ($shapeSelected) {
    $displayForm = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shape Calculator</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php if (!$shapeSelected || $result): ?>
    <div class="shape-form">
        <h1>Select a Shape</h1>
        <form class="shape__" method="post">
            <div class="shape">
            <label><input type="radio" name="shape" value="Cone" required>Cone</label>
            <label><input type="radio" name="shape" value="Cylinder">Cylinder</label>
            <label><input type="radio" name="shape" value="Sphere">Sphere</label>
            </div>
            <!-- Add more shapes as needed -->
            <button type="submit">Next</button>
        </form>
    </div>
    <?php endif; ?>

    <?php if ($displayForm): ?>
    <div class="input-form">
        <h1>Enter Details</h1>
        <form class="dimensions" method="post">
            <input type="hidden" name="shape" value="<?php echo $shapeSelected; ?>">
            <!-- Dynamically generate form based on shape -->
            <?php if ($shapeSelected == 'Cone' || $shapeSelected == 'Cylinder'): ?>
                <label>Radius: <input type="number" name="radius" required></label>
                <label>Height: <input type="number" name="height" required></label>
            <?php endif; ?>
            <!-- Add more fields for other shapes -->
            <?php if ($shapeSelected == 'Sphere'): ?>
                <label>Radius: <input type="number" name="radius" required></label>
            <?php endif; ?>
            
            <button type="submit" name="dimensions">Calculate</button>
        </form>
    </div>
    <?php endif; ?>

    <?php if ($result): ?>
    <div class="output-section">
        <p>For <?php echo $result['shape']; ?>, </p>
        <p>Area: <?php echo number_format($result['area'], 2); ?> units²</p>
        <p>Volume: <?php echo number_format($result['volume'], 2); ?> units³</p>
    </div>
    <?php endif; ?>
</body>
</html>
