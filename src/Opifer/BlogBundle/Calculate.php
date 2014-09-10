<?php namespace Opifer\BlogBundle;
class Calculate {
    public function add($numbers) {
        $answer = 0;
        foreach ($numbers as $number)
        {
            if(is_numeric($number))
                $answer += $number;
        }

        return $answer;
    }

    public function multiply($numbers) {
        $answer = 1;
        foreach ($numbers as $number)
        {
            if(is_numeric($number))
                $answer *= $number;

        }

        return $answer;
    }
} 