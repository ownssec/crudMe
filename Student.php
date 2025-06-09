<?php
class Student {
    private $name;
    private $age;
    private $gender;
    private $status;

    // Setters
    public function setName($name) {
        $this->name = $name;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    // Getters
    public function getName() {
        return $this->name;
    }

    public function getAge() {
        return $this->age;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getStatus() {
        return $this->status;
    }
}
?>

