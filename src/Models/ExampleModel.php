<?php
class ExampleModel
{
    use Database;
    public function getData()
    {
        $rs = $this->table("example")
            ->get();
        return $rs;
    }
}
