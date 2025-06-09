<?php
/** Simple data object for one student */
class Student {
    private string $name   = '';
    private int    $age    = 0;
    private string $gender = '';
    private string $status = '';

    public function __construct(
        string $name   = '',
        int    $age    = 0,
        string $gender = '',
        string $status = ''
    ) {
        $this->name   = $name;
        $this->age    = $age;
        $this->gender = $gender;
        $this->status = $status;
    }

    /* getters */
    public function getName()   : string { return $this->name;   }
    public function getAge()    : int    { return $this->age;    }
    public function getGender() : string { return $this->gender; }
    public function getStatus() : string { return $this->status; }

    /* setters */
    public function setName(string $v)   : void { $this->name   = $v; }
    public function setAge(int $v)       : void { $this->age    = $v; }
    public function setGender(string $v) : void { $this->gender = $v; }
    public function setStatus(string $v) : void { $this->status = $v; }
}

