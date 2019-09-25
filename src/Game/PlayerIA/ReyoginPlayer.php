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
        //$this->prettyDisplay();

        // Init and getting last results to build stats
        $roundNb = $this->result->getNbRound();
        $mylastmove = $this->result->getLastChoiceFor($this->mySide);
        $enemylastmove = $this->result->getLastChoiceFor($this->opponentSide);

        $mylastresult = $this->result->getLastScoreFor($this->mySide);
        $enemylastresult = $this->result->getLastScoreFor($this->opponentSide);

        $allmymoves = $this->result->getChoicesFor($this->mySide);
        $allopponentmoves = $this->result->getChoicesFor($this->opponentSide);

        $last10 = array();
        $opplast10 = array();

        $startIndex = ($roundNb < 10 ) ? 0 : $roundNb - 10;
        for ($i = $startIndex; $i < $roundNb; $i++){
            array_push($last10, $allmymoves[$i]);
            array_push($opplast10, $allopponentmoves[$i]);
        }

        // Play scissors first
        if ($mylastmove == '0')
            return parent::paperChoice();

        // coinflip to decide whether or not I should go for normal or reverse psychology
        $coinflip = rand(0,1);

        if ($coinflip == "0") {
            // Reverse psychology : they are looking for my last moves to check against them, I'll pull one under their feet :p
            switch ($mylastmove) {
                case 'scissors':
                    return $this->paperChoice();
                case 'paper':
                    return $this->rockChoice();
                case 'rock':
                    return $this->scissorsChoice();
            }
        }
        else {
            // Normal psychology : Play the moves that would win against their last
            switch ($enemylastmove) {
                case 'scissors':
                    return $this->rockChoice();
                case 'paper':
                    return $this->scissorsChoice();
                case 'rock':
                    return $this->paperChoice();
            }
        }
    }
}