<?php

namespace App\Console\Commands;

use App\Parser\WebParser;
use Illuminate\Console\Command;

class ParseJArchiveGame extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse-j-archive-game {gameId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parses a single j-archive game and stores the result in the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $game = (new WebParser($this->argument('gameId')))->parse();

        $this->output->writeln("Imported game {$game->id} which aired on {$game->date->toDateString()}");
    }
}
