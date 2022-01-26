<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class SendWelcomeEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:welcome';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resetiraj lozinku i posalji email dobrodošlice grupi korisnika';

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
     * @return int
     */
    public function handle()
    {
      //$userId = $this->argument('user');
      $role = $this->choice('Kome slati email?',['predavaci','studenti','ostali'],0);
      $do_resetpassword = false;

      if ($this->confirm('Automatski generirati lozinku i poslati zajedno sa emailom?', false)) {
        $do_resetpassword = true;
      }


      $this->info('Odabrali ste slanje emaila na: '.$role);
      if($do_resetpassword)
        $this->info('Lozinka će biti automatski generirana svakom korisniku i poslana zajedno sa emailom.');
      else
        $this->info('Lozinka se neće mijenjati korisnicima.');


      if (!$this->confirm('Nastaviti sa slanjem emaila?', false)) {
        $this->line('Poništena akcija, niti jedan email nije poslan.');
        return Command::SUCCESS;
      }

      $users = new User;

      if($role == 'predavaci')
        $users = $users->where('is_predavac',true);
      elseif($role == 'studenti')
        $users = $users->where('is_student',true);
      elseif($role == 'ostali')
        $users = $users->where('is_student',false)->where('is_predavac',false)/*->where('is_izvjesca',true)*/;
      else
      {
        throw new \Exception('undefined role');
        return;
      }

      # TEST
      //$user = User::find(1);
      //$user->sendWelcomeEmail($do_resetpassword,true);
      //return;
      # TEST END
      $users = $users->get();
      //$users = $users->limit(1)->get(); //test limit 1

      $bar = $this->output->createProgressBar($users->count());
      $bar->start();
      foreach($users as $user)
      {
        $user->sendWelcomeEmail($do_resetpassword,true);
        $bar->advance();
      }
      $bar->finish();
      $this->info(' ');
      $this->info('Slanje završeno, mails queued.');


      return Command::SUCCESS;
    }
}
