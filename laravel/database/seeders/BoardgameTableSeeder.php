<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardgameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('boardgames')->insert([
            [
                'title' => 'Catan',
                'publisher' => 'Devir Brasil',
                'players' => '2 a 4 Jogadores (6 com expansões)',
                'playtime' => '90 min',
                'age_range' => 'A partir de 12 anos',
                'description' => 'Em Catan os jogadores tentam ser a força dominante na ilha de Catan, construindo estradas, vilas e cidades. Em cada turno, 
                    os dados são rolados para determinar quais recursos a ilha produz. Os jogadores coletam esses recursos - madeira, trigo, tijolo, ovelha ou pedra
                    - para construir suas civilizações, chegar a 10 pontos de vitória e ganhar o jogo.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Carcassone',
                'publisher' => 'Devir Brasil',
                'players' => '2 a 5 Jogadores',
                'playtime' => '45 min',
                'age_range' => 'A partir de 8 anos',
                'description' => 'Carcassonne é um jogo de colocação de peças modulares, onde cada ladrilho representam um pedaço do sul da França. Cada jogada 
                    consiste em compra e colocar uma nova peça, que precisa ser encaixada preservando as formas topológicas dos desenhos. Cada peça irá expandir o 
                    tabuleiro e você deve tentar controlar áreas como uma cidade (Cavaleiro), uma estrada (Ladrão), um mosteiro (Monge) ou dos campos (Fazendeiros) 
                    para ganhar pontos. Carcassonne além de ser o jogo que inventou o marcador do Meeple (my+people) se tornou um novo clássico moderno dos jogos de
                    tabuleiro, altamente acessível à iniciantes, mas com camadas estratégicas tão fortes que se tornou um jogo com diversos torneios e competições 
                    mundiais.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Munchkin',
                'publisher' => 'Devir Brasil',
                'players' => '2 a 6Jogadores',
                'playtime' => '90 min',
                'age_range' => 'A partir de 10 anos',
                'description' => 'Entre na Dungeon e explore seus mistérios! Abra portas secretas e mate todos os monstros que cruzarem seu caminho. Trapaceie seus
                    colegas. Pegue todo o tesouro para você e saia correndo. Seja sincero: Você adora isso!
                    Este jogo contém a essência da Experiência Dungeon… sem toda a complexidade do RPG. Tudo que você precisa é juntar alguns amigos,
                    matar uns monstros e pegar seus valiosos tesouros. Itens poderosíssimos como uma “Bandana de Machão” ou as famosas “Joelheiras da Sedução”.
                    Calçe as “Botas de Chutar a Bunda” ou talvez use sua “Serra Elétrica de Mutilação Sangrenta”.
                    Dê início à sua saga massacrando “Rãs Voadoras” ou um “Troll da Internet”, para quem sabe um dia ter o prazer de matar o temível
                    “Dragão de Plutônio”.
                    Rápido e leve, Munchkin vai levar qualquer grupo de jogadores de RPG à loucura! E, enquanto todos estiverem rindo, você pode roubar suas coisas.',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
