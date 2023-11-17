<?php

class Game
{
    // gerer les rencontres
    // lance les combat
    // rejouer une partie (si c'est possible)
    // choix du héro
    // choix de la difficulés
    private $listPerso; //création de la variable listPerso
    private function CreeHero() //création de la méthode CreeHero qui permet de créer les héros
    {
        $Seong = new Hero("Seong", 15, 2, 1);//création des différents héros
        $Kang = new Hero("Kang", 25, 1, 2);
        $Cho = new Hero("Cho", 35, 0, 3);

        $this->listPerso = array($Seong, $Kang, $Cho); //création d'un tableau qui contient les différents héros
    }

    private $listeEnemy; //création de la variable listeEnemy
    public function CreeEnnemy() //création de la méthode CreeEnnemy qui permet de créer les ennemis
    {
        for ($i = 1; $i < 20; $i++) { //création d'une boucle qui permet de créer 20 ennemis
            $enemy = new Ennemy("enemy n°$i", rand(1, 20), rand(15, 100));  //création des ennemis avec des valeurs aléatoires selon Ennemy
            $this->listeEnemy[] = $enemy; // ajout des ennemis dans la listeEnemy à chaque tour de boucle
        }
    }

    private $listeLevels; //création de la variable listeLevels
    public function selectLevel (){ //création de la méthode selectLevel qui permet de choisir le niveau de difficulté
        $facile = 5; //création des différents niveaux de difficulté avec le nombre de manches
        $Difficile = 10;
        $Impossible = 20;
        $this->listeLevels = array($facile, $Difficile, $Impossible); //création d'un tableau qui contient les différents niveaux de difficulté
    }


    private function gererCombat()
    {




    }
    private $selectedHero; //création de la variable selectedHero

    public function startGame() //création de la méthode startGame qui permet de lancer le jeu
    {
        $this->CreeEnnemy(); //appel la méthode CreeEnnemy
        $this->CreeHero(); //appel la méthode CreeHero
        $this->selectLevel();//appel la méthode selectLevel
        $this->selectedHero = $this->listPerso[array_rand($this->listPerso)]; //choix aléatoire du héro
        $this->selectedLevels = $this->listeLevels[array_rand($this->listeLevels)]; //choix aléatoire du niveau de difficulté



        
        echo "Votre personnage est : " . $this->selectedHero->getName() . "<br>"; //affiche le nom du héro
        echo "Votre bonus est de :" . $this->selectedHero->getBonusHero() . "<br>";//affiche le bonus du héro
        echo "Votre malus est de :" . $this->selectedHero->getMalusHero() . "<br>";//affiche le malus du héro
        echo "Vous avez " . $this->selectedHero->getMarbles() . " billes <br>";//affiche le nombre de billes du héro
        echo "Vous avez choisi le niveau de difficulté avec " . $this->selectedLevels . " manches<br>";//affiche le niveau de difficulté choisi aléatoirement
        echo"-----------------------------------------<br>";


        $this->lancerCombats(); //appel la méthode lancerCombats afin de lancer les combats
    }



    public function lancerCombats() //création de la méthode lancerCombats qui permet de lancer les combats
    {
        $manche = 0; //création de la variable manche qui permet de compter le nombre de manches
        while ($this->selectedHero->getMarbles() > 0) {//création d'une boucle qui permet de lancer les combats tant que le héro a des billes
            
            if (empty($this->listeEnemy && $this->selectedLevels >= $manche)) { //création d'une condition qui permet de vérifier si le héro a gagné en fonction du nombre de manches et du nombre d'ennemis restants
                echo "Vous avez gagné contre tout vos adversaires!";
                echo "A vous gagner 45,6 milliards de Won sud-coréen.";     
                break; //si la condition est remplie, la boucle s'arrête
            }
            
            
            $randEnemy = $this->listeEnemy[array_rand($this->listeEnemy)]; //choix aléatoire de l'ennemi
            echo "Vous avez " . $this->selectedHero->getMarbles() . " billes <br>"; //affiche le nombre de billes du héro
            echo "Votre adversaire est : " . $randEnemy->getName() . "<br>"; //affiche le nom de l'ennemi
            echo "Il a " . $randEnemy->getMarbles() . " billes <br>"; //affiche le nombre de billes de l'ennemi

            $this->selectedHero->pairImpair(); //appel la méthode pairImpair pour permettre au héro de choisir entre pair ou impair
            $this->selectedHero->checkPairImpair($randEnemy->getMarbles()); //appel la méthode checkPairImpair pour vérifier si le héro a gagné ou perdu avec le nombre de billes de l'ennemi

            if ($this->selectedHero->getMarbles() > 0) {
                echo "Vous avez " . $this->selectedHero->getMarbles() . " billes <br>";
                echo "Fin de la manche $manche<br>";
                echo "----------------------------------------- <br>";
            } else {
                echo "Game over!<br>";
                break;
            }

            // Verifie si le hero a gagné
            if ($this->selectedHero->getMarbles() > 0) {
                // Trouver l'emplacement de l'ennemie dans la liste
                $index = array_search($randEnemy, $this->listeEnemy);
                unset($this->listeEnemy[$index]);
                //
                $this->listeEnemy = array_values($this->listeEnemy);
            }
            $manche += 1;

        }
    }
}