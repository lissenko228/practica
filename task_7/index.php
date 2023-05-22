<?php

// абстрактный класс самолет
abstract class Plane
{
    public $name;
    public $max_speed;
    public $fly;
    function __construct($name, $max_speed)
    {
        $this -> name = $name;
        $this -> max_speed = $max_speed;
        $this -> fly = false;
    }

    function takeOff() //метод взлет
    {
        $this -> fly = true;
        echo $this -> name . " взлет";
    }

    function landing() //метод посадка
    {
        $this -> fly = false;
        echo $this -> name . " посадка";
    }

    function getStatus()
    {
        return ($this -> fly) ? " летит" : " на земле";
    }

    function getName()
    {
        return $this -> name;
    }
}

class Mig extends Plane
{
    function attack() //метод атака для самолета Миг
    {
        echo $this -> name . " атакует";
    }
}

class Tu154 extends Plane
{

}

class Airport
{
    public $planes = array();
    public $max_capacity;

    function __construct($max_capacity)
    {
        $this -> max_capacity = $max_capacity;
    }

    function acceptPlane(Plane $plane) //метод принятия самолета в аэропорт
    {
        if(count($this -> planes) < $this -> max_capacity)
        {
            $this -> planes[] = $plane;
            echo $plane -> getStatus() . " " . $plane -> getName() . " был принят в аэропорт";
        }
        else
        {
            echo "Аэропорт заполнен";
        }
    }

    function releasePlane(Plane $plane) //метод освобождения места и отбытия самолета
    {
        $position = array_search($plane, $this -> planes);
        if($position !== false)
        {
            unset($this -> planes, $position);
            echo $plane -> getStatus() . " " . $plane -> getName() . " покинул аэропорт";
        }
        else
        {
            echo $plane -> getName() . " не находится в аэропорту";
        }
    }

    function parkPlane(Plane $plane) //метод стоянки самолета
    {
        $position = array_search($plane, $this -> planes);
        if($position !== false)
        {
            unset($this -> planes, $position);
            echo $plane -> getStatus() . " " . $plane -> getName() . " на стоянке в аэропорту";
        }
        else
        {
            echo $plane -> getName() . " не находится в аэропорту";
        }
    }

    function preparePlane(Plane $plane) //метод готов к взлету
    {
        echo $plane -> getName() . " готов к взлету";
    }

    function assignGate(Plane $plane, $gate_number) // метод номера стоянки
    {
        echo $plane -> getName() . " назначается на " . $gate_number;
    }

    function checkInPlane(Plane $plane) //метод принятия
    {
        echo $plane -> getName() . " был зарегистирован";
    }

    function clearForTakeoff(Plane $plane) //метод готов к взлету
    {
        echo $plane -> getName() . " готов к взлету";
    }
}

//ассоциация
$airport = new Airport(4);
$mig = new Mig("MIG", 2000);
$tu = new Tu154("TU-154", 1000);

// агрегация

$planes = [$mig, $tu];
$airport = new Airport(4);
foreach ($planes as $p)
{
    $airport -> acceptPlane($p);
    echo "<br>";
}

//композиция

$airport = new Airport(4);
$airport -> acceptPlane(new Mig("MIG", 2000));
echo "<br>";
$airport -> acceptPlane(new Tu154("TU-154", 1000));

// $airport -> assignGate($mig, 10);
// echo "<br>";
// $airport -> acceptPlane($tu);
// echo "<br>";

// $mig -> attack();
// echo "<br>";
// $tu -> takeoff();
// echo "<br>";
// $mig -> landing();
// echo "<br>";
// echo $mig -> getName() . $mig -> getStatus() . "<br>";
// echo $tu -> getName() . $tu -> getStatus() . "<br>";


?>