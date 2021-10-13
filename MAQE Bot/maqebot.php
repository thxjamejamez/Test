<?php
$MaqeBot = new MaqeBot();
$MaqeBot->start($argv[1]);

class MaqeBot
{

    public function __construct()
    {
        $this->directions = ['North', 'East', 'South', 'West'];
    }

    /**
     * @param $command
     */
    public function start($command)
    {
        $current_direction = 'North';
        $x = 0;
        $y = 0;

        preg_match_all('/R|L|W\d+/', $command, $dictations, PREG_UNMATCHED_AS_NULL);
        foreach ($dictations[0] as $dictation) {
            try {
                switch ($dictation) {
                    case 'R':
                        $this->changeRightDirection($current_direction);
                        break;
                    case 'L':
                        $this->changeLeftDirection($current_direction);
                        break;
                    default:
                        $this->changePointer($current_direction, $x, $y, $dictation);
                        break;
                }
            } catch (\Exception $e) {
                print($e->getMessage());
            }
        }
        print("X: {$x} Y: {$y} Direction: {$current_direction}");
    }

    /**
     * @param $current_direction
     */
    private function changeLeftDirection(&$current_direction)
    {
        $index = array_search($current_direction, $this->directions);
        $index--;
        if ($index < 0) {
            $index = count($this->directions);
        }

        $current_direction = $this->directions[$index];
    }

    /**
     * @param $current_direction
     */
    private function changeRightDirection(&$current_direction)
    {
        $index = array_search($current_direction, $this->directions);
        $index++;
        if ($index > (count($this->directions) - 1)) {
            $index = 0;
        }

        $current_direction = $this->directions[$index];
    }

    /**
     * @param $current_direction
     * @param $x
     * @param $y
     * @param $dictation
     */
    private function changePointer($current_direction, &$x, &$y, $dictation)
    {
        $walk_position = (int) filter_var($dictation, FILTER_SANITIZE_NUMBER_INT);
        switch ($current_direction) {
            case 'North':
                $y += $walk_position;
                break;
            case 'East':
                $x += $walk_position;
                break;
            case 'South':
                $y -= $walk_position;
                break;
            default:
                $x -= $walk_position;
                break;
        }
    }
}
