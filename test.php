<?php
// Створимо клас, який містить змінні розмірів коробки,
// та який має метод для підрахунку об'єму
class box {
    public $width;
    public $height;
    public $depth;

    public function __construct($w, $h, $d) {
        $this->width = $w;
        $this->height = $h;
        $this->depth = $d;
    }

    public function countVolume() {
        return $this->height * $this->width * $this->depth;
    }
}

// Тепер створимо підклас класу box, у якому розширимо
// його змінною ваги та функцією - гетером
class boxW extends box {
    public $weight;

    public function __construct($w, $h, $d, $weight) {
        $this->width = $w;
        $this->height = $h;
        $this->depth = $d;
        $this->weight = $weight;
    }

    public function getWeight() {
        return $this->weight;
    }
}

// Тепер створимо екземпляр батьківського класу
$box = new box(12, 13, 14);
echo "Об'єм box: ", $box->countVolume(), "\n";

// Створимо екземпляр підкласу
$boxw = new boxW(12, 13, 14, 20);
echo "Об'єм boxw: ", $boxw->countVolume(), "\n";
echo "Вага boxw: ", $boxw->getWeight();
?>



