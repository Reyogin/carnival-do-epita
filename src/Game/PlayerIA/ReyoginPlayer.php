<?php


namespace Hackathon\PlayerIA;
use Hackathon\Game\Result;


class ReyoginPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------

        // Lose = 0 ; Draw = 1; Win = 3

        $this->prettyDisplay();

        $mylastmove = $this->result->getLastChoiceFor($this->mySide);
        $enemylastmove = $this->result->getLastChoiceFor($this->opponentSide);

        $mylastresult = $this->result->getLastScoreFor($this->mySide);
        $enemylastresult = $this->result->getLastScoreFor($this->opponentSide);

        if ($mylastmove == '0')
            return parent::scissorsChoice();

        // Cases if I won
        if ($mylastresult == '5'){
            // Case if opponent lost ==> Play what he did last
            if ($enemylastresult == '0')
                return $enemylastmove;

            // opponent drew ==> random
            if ($enemylastresult == '1'){
                $value = rand(1,3);
                if ($value == 1)
                    return parent::paperChoice();
                elseif ($value == 2)
                    return parent::rockChoice();
                return parent::scissorsChoice();
            }

            // Opponent won ==> play what beat his last
            if ($enemylastmove == 'paper')
                return parent::scissorsChoice();
            if ($enemylastmove == 'scissors')
                return parent::rockChoice();
            return parent::paperChoice();
        }
        // Cases if I lost
        elseif ($mylastresult == '0'){
            //Opponent won ==> play what beat his last
            if ($enemylastresult == '5') {
                if ($enemylastmove == 'paper')
                    return parent::scissorsChoice();
                if ($enemylastmove == 'scissors')
                    return parent::rockChoice();
                return parent::paperChoice();
            }

            //Opponent drew ==> random
            if ($enemylastresult == '1'){
                $value = rand(1,3);
                if ($value == 1)
                    return parent::paperChoice();
                elseif ($value == 2)
                    return parent::rockChoice();
                return parent::scissorsChoice();
            }

            //Opponent lost ==> play his last
            return $enemylastmove;
        }

        $value = rand(1,3);
        if ($value == 1)
            return parent::paperChoice();
        elseif ($value == 2)
            return parent::rockChoice();
        return parent::scissorsChoice();

    }
}