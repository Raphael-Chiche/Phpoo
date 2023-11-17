<?php

abstract class Character
{

    private $name; //création des atributs du character
    private $marbles;

    public function __construct($name, $marbles)
    {
        $this->name = $name;
        $this->marbles = $marbles;
    }

    public function getName() //création des getters 
    {
        return $this->name;
    }
    public function getMarbles() //création des getters
    {
        return $this->marbles;
    }
    public function setMarbles($marbles) //création des setters
    {
        $this->marbles = $marbles;
    }


    abstract public function gagner($enemyMarbles); //création des méthodes abstraites pour les futurs enfants
    abstract public function perdre($enemyMarbles);

}

class Hero extends Character //création de la classe Hero qui hérite de la classe Character
{
    private $bonusHero; //Variable du bonus du Hero
    private $malusHero; //Variable du malus du Hero

    public function __construct($name, $marbles, $malusHero, $bonusHero) //création du constructeur de la classe Hero qui a hérité de la classe Character
    {
        parent::__construct($name, $marbles); //appel du constructeur de la classe Character
        $this->malusHero = $malusHero;
        $this->bonusHero = $bonusHero;
    }
    public function getBonusHero()
    {
        return $this->bonusHero;
    }
    public function getMalusHero()
    {
        return $this->malusHero;
    }
    private $choixPairImpair;

    public function pairImpair() //création de la méthode pairImpair qui permet de choisir entre pair ou impair
    {
        $this->choixPairImpair = rand(0, 1);//random entre 0 et 1
        if ($this->choixPairImpair == 0) {
            echo "Vous avez dit pair. <br>";
        } else {
            echo "Vous avez dit impaire. <br>";
        }
    }
    public function checkPairImpair($enemyMarbles) //création de la méthode checkPairImpair qui permet de vérifier si le Hero a gagné ou perdu en ayant choisi pair ou impair
    {
        if ($enemyMarbles % 2 == 0 && $this->choixPairImpair == 0) { //utilisation du modulo pour vérifier si le nombre de billes de l'ennemi est pair ou impair
            echo "Vous avez gagné. <br>";
            $this->gagner($enemyMarbles);
        } elseif ($enemyMarbles % 2 == 1 && $this->choixPairImpair == 1) {
            echo "Vous avez gagné. <br>";
            $this->gagner($enemyMarbles);
        } else {
            echo "Vous avez perdu. <br>";
            $this->perdre($enemyMarbles);
        }
    }
    public function gagner($enemyMarbles) //création de la méthode gagner qui permet de gagner des billes
    {
        $this->setMarbles($this->getMarbles() + $enemyMarbles + $this->bonusHero); //utilisation des setters et getters pour modifier le nombre de billes du Hero avec le bonus et le nombre de billes de l'ennemis
    }

    public function perdre($enemyMarbles) //création de la méthode perdre qui permet de perdre des billes
    {
        $this->setMarbles($this->getMarbles() - $enemyMarbles - $this->malusHero); 
    }
}
class Ennemy extends Character //création de la classe Ennemy qui hérite de la classe Character
{
    private $age;

    public function getAgeEnemmy()
    {
        return $this->age;
    }

    public function __construct($name, $marbles, $age)
    {
        parent::__construct($name, $marbles);
        $this->age = $age;
    }

    public function gagner($enemyMarbles)
    {
    }

    public function perdre($enemyMarbles)
    {
    }

}