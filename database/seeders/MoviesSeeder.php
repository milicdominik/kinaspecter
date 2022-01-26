<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $tablename = 'movies';
      $source = [
        ['naslov' => 'Ulica noćnih mora', 'redatelj' => 'Guillermo del Toro', 'genre_id' => '2', 'trajanje' => '150', 'godina_izlaska' => '2022', 'uloge' => 'Bradley Cooper, Cate Blanchett, Willem Dafoe, Toni Collette, Richard Jenkins, Ron Perlman, Rooney Mara, Holt McCallany', 'opis' => 'Mračna priča prati ambicioznog putujućeg mentalista koji ima talent manipulacije ljudima kroz nekoliko dobro odabranih riječi.
          U vjeri da će sam postići svjetski uspjeh, upušta se u vezu s dr. Lilith Ritter, psihijatricom koja je još opasnija od njega.
          Stvari tada postaju sve čudnije. '],
        ['naslov' => 'Visoka moda', 'redatelj' => 'Sylvie Ohayon', 'genre_id' => '2', 'trajanje' => '100', 'godina_izlaska' => '2021', 'uloge' => 'Nathalie Baye, Lyna Khoudri, Pascale Arbillot', 'opis' => 'Esther se nalazi na kraju svoje karijere u ateljeu kuće Dior, jedne od najznačajnijih i najutjecajnijih francuskih modnih kuća. Jednog dana joj mlada djevojka Jade u javnom prijevozu ukrade torbicu. Umjesto da pozove policiju, Esther se odluči pobrinuti za Jade jer u njoj vidi priliku da joj  prenese svoje vještine, krojački zanat i svoje bogatstvo. U frenetičnom svijetu visoke mode, Esther će Jade omogućiti da dosegne svoj puni potencijal. '],
        ['naslov' => 'Vrisak', 'redatelj' => 'Matt Bettinelli-Olpin, Tyler Gillett', 'genre_id' => '3', 'trajanje' => '114', 'godina_izlaska' => '2022', 'uloge' => 'David Arquette, Jack Quaid, Neve Campbell, Courteney Cox, Jenna Ortega, Melissa Barrera', 'opis' => 'Nakon što je niz brutalnih ubojstava šokirao mirni gradić Woodsboro, ubojica s maskom „Ghostface“ ponovno počinje terorizirati skupinu tinejdžera kako bi oživio tajne iz smrtonosne prošlosti grada.'],
        ['naslov' => 'Matrix Uskrsnuća', 'redatelj' => 'Lana Wachowski', 'genre_id' => '1', 'trajanje' => '148', 'godina_izlaska' => '2022', 'uloge' => 'Keanu Reeves, Carrie-Anne Moss, Priyanka Chopra, Yahya Abdul-Mateen II, Neil Patrick Harris, Jonathan Groff, Jada Pinkett-Smith', 'opis' => 'Kultna franšiza je napokon dobila svoj nastavak. Prikaz distopijske budućnosti u kojoj je čovječanstvo zarobljeno u simuliranoj stvarnosti, Matrici, očaralo je gledatelje daleke 1999. godine. Takva simulirana stvarnost oduševila je impresivnim vizualnim efektima, slojevitom, zahtjevnom pričom koja kombinira filozofiju,   religiju, etiku i tehnologiju.
        Matrix će svojom složenom radnjom, uvelike inspiriranom filozofijom, gledatelje prisiliti na drugačiju vrstu sudjelovanja u filmu – na promišljanje o osobnim stvarima, identitetu, postojanju i moralnim pitanjima koja nikada nisu bila toliko aktualna kao danas, u vremenu u kojem živimo. '],
        ['naslov' => 'Igra ljubavi i mržnje', 'redatelj' => 'Peter Hutchings', 'genre_id' => '7', 'trajanje' => '102', 'godina_izlaska' => '2021', 'uloge' => 'Lucy Hale, Austin Stowell, Nicholas Baroudi, Gina Torres, Corbin Bernsen', 'opis' => 'Lucy Hutton oduvijek je vjerovala da srdačna djevojčica može steći menadžersku poziciju. Ponosi se time što je na poslu svi vole - osim dojmljivog i savršeno odjevenog Joshue Templemana. Kada zaglave u istom uredu, upletu se u neodoljivu igru nadmetanja. Igraju igru pogleda, igru zrcala, igru poslovnog pravilnika, a Lucy ne može dopustiti da je Joshua i u jednoj pobijedi - a pogotovo kada im se oboma ponudi važno promaknuće. Ako Lucy pobijedi, postat će Joshui šefica. Ako izgubi, dat će ostavku. Zašto se onda preispituje?'],

      ];

      //dodaj kratki_naziv  = naziv svima
      /*foreach($source as $k => $v)
      {
        $source[$k]['kratki_naziv'] = $v['naziv'];
      }*/

      $data = [];
      foreach ($source as $s) {
        $check = DB::table($tablename)->where('naslov', $s['naslov'])->where('redatelj', $s['redatelj'])->where('godina_izlaska', $s['godina_izlaska'])->first();
        if ($check) continue;
        $data[] = $s;
      }
      DB::table($tablename)->insert($data);
    }
}
